<?php

declare(strict_types=1);
/*
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 - 2023 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <me at sachatelgenhof dot com>
 */

namespace Yasumi\tests\Base;

use PHPUnit\Framework\TestCase;
use Yasumi\Exception\MissingTranslationException;
use Yasumi\Exception\UnknownLocaleException;
use Yasumi\Holiday;
use Yasumi\tests\YasumiBase;
use Yasumi\TranslationsInterface;

class HolidayTest extends TestCase
{
    use YasumiBase;

    /** @throws \Exception */
    public function testHolidayBlankKeyInvalidArgumentException(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        new Holiday('', [], new \DateTime());
    }

    /** @throws \Exception */
    public function testCreateHolidayUnknownLocaleException(): void
    {
        $this->expectException(UnknownLocaleException::class);

        new Holiday('testHoliday', [], new \DateTime(), 'wx-YZ');
    }

    /** @throws \Exception */
    public function testHolidayIsJsonSerializable(): void
    {
        $holiday = new Holiday('testHoliday', [], new \DateTime(), 'en_US');
        $json = json_encode($holiday, JSON_THROW_ON_ERROR);
        $instance = json_decode($json, true, 512, JSON_THROW_ON_ERROR);

        self::assertIsArray($instance);
        self::assertNotNull($instance);
        self::assertArrayHasKey('shortName', $instance);
    }

    /** @throws \Exception */
    public function testHolidayWithDateTimeInterface(): void
    {
        // Assert with DateTime instance
        $holiday = new Holiday('testHoliday', [], new \DateTime(), 'en_US');
        self::assertNotNull($holiday);
        self::assertInstanceOf(Holiday::class, $holiday);

        // Assert with DateTimeImmutable instance
        $holiday = new Holiday('testHoliday', [], new \DateTimeImmutable(), 'en_US');
        self::assertNotNull($holiday);
        self::assertInstanceOf(Holiday::class, $holiday);
    }

    /** @throws \Exception */
    public function testHolidayGetLocales(): void
    {
        $holiday = new Holiday('testHoliday', [], new \DateTime(), 'ca_ES_VALENCIA');
        $method = new \ReflectionMethod(Holiday::class, 'getLocales');
        $method->setAccessible(true);

        self::assertEquals(['ca_ES_VALENCIA', 'ca_ES', 'ca', 'en_US', 'en', Holiday::LOCALE_KEY], $method->invoke($holiday, null));
        self::assertEquals(['de_DE', 'de', 'es_ES', 'es'], $method->invoke($holiday, ['de_DE', 'es_ES']));
        self::assertEquals(['de_DE', 'de', Holiday::LOCALE_KEY], $method->invoke($holiday, ['de_DE', Holiday::LOCALE_KEY]));
    }

    /** @throws \Exception */
    public function testHolidayGetNameWithoutArgument(): void
    {
        // 'en_US' fallback
        $translations = [
            'de' => 'Holiday DE',
            'de_AT' => 'Holiday DE-AT',
            'en' => 'Holiday EN',
            'en_US' => 'Holiday EN-US',
        ];

        $holiday = new Holiday('testHoliday', $translations, new \DateTime(), 'de_AT');
        self::assertEquals('Holiday DE-AT', $holiday->getName());

        $holiday = new Holiday('testHoliday', $translations, new \DateTime(), 'de');
        self::assertEquals('Holiday DE', $holiday->getName());

        $holiday = new Holiday('testHoliday', $translations, new \DateTime(), 'de_DE');
        self::assertEquals('Holiday DE', $holiday->getName());

        $holiday = new Holiday('testHoliday', $translations, new \DateTime(), 'ja');
        self::assertEquals('Holiday EN-US', $holiday->getName());

        // 'en' fallback
        $translations = [
            'de' => 'Holiday DE',
            'en' => 'Holiday EN',
        ];

        $holiday = new Holiday('testHoliday', $translations, new \DateTime(), 'de_DE');
        self::assertEquals('Holiday DE', $holiday->getName());

        $holiday = new Holiday('testHoliday', $translations, new \DateTime(), 'ja');
        self::assertEquals('Holiday EN', $holiday->getName());

        // No 'en' or 'en_US' fallback
        $translations = [
            'de' => 'Holiday DE',
        ];

        $holiday = new Holiday('testHoliday', $translations, new \DateTime(), 'de_DE');
        self::assertEquals('Holiday DE', $holiday->getName());

        $holiday = new Holiday('testHoliday', $translations, new \DateTime(), 'ja');
        self::assertEquals('testHoliday', $holiday->getName());
    }

    /** @throws \Exception */
    public function testHolidayGetNameWithArgument(): void
    {
        $translations = [
            'de' => 'Holiday DE',
            'de_AT' => 'Holiday DE-AT',
            'nl' => 'Holiday NL',
            'it_IT' => 'Holiday IT-IT',
            'en_US' => 'Holiday EN-US',
        ];
        $holiday = new Holiday('testHoliday', $translations, new \DateTime(), 'de_DE');

        self::assertEquals('Holiday DE', $holiday->getName(['de']));
        self::assertEquals('Holiday DE', $holiday->getName(['ja', 'de', 'nl', 'it_IT']));
        self::assertEquals('Holiday DE', $holiday->getName(['de_DE']));
        self::assertEquals('Holiday DE', $holiday->getName(['de_DE_berlin']));
        self::assertEquals('Holiday DE', $holiday->getName(['de_DE_berlin', 'nl', 'it_IT']));
        self::assertEquals('Holiday DE-AT', $holiday->getName(['de_AT']));
        self::assertEquals('Holiday DE-AT', $holiday->getName(['de_AT_vienna']));
        self::assertEquals('Holiday NL', $holiday->getName(['nl']));
        self::assertEquals('Holiday NL', $holiday->getName(['nl_NL']));
        self::assertEquals('Holiday IT-IT', $holiday->getName(['it_IT']));
        self::assertEquals('Holiday IT-IT', $holiday->getName(['it_IT', Holiday::LOCALE_KEY]));
        self::assertEquals('testHoliday', $holiday->getName([Holiday::LOCALE_KEY]));

        $holiday = new Holiday('testHoliday', $translations, new \DateTime(), 'ja');
        self::assertEquals('Holiday EN-US', $holiday->getName());

        $this->expectException(MissingTranslationException::class);
        $holiday->getName(['it']);
    }

    /** @throws \Exception */
    public function testHolidayGetNameWithGlobalTranslations(): void
    {
        $translationsStub = $this->getMockBuilder(TranslationsInterface::class)->getMock();

        $translations = [
            'en_US' => 'New Year’s Day',
            'pl_PL' => 'Nowy Rok',
        ];

        $translationsStub->expects(self::once())->method('getTranslations')->with(self::equalTo('newYearsDay'))->willReturn($translations);

        $locale = 'pl_PL';

        $holiday = new Holiday('newYearsDay', [], new \DateTime('2015-01-01'), $locale);
        $holiday->mergeGlobalTranslations($translationsStub);

        self::assertNotNull($holiday->getName());
        self::assertIsString($holiday->getName());
        self::assertEquals($translations[$locale], $holiday->getName());
    }

    /** @throws \Exception */
    public function testHolidayGetNameWithGlobalParentLocaleTranslations(): void
    {
        $translationsStub = $this->getMockBuilder(TranslationsInterface::class)->getMock();

        $translations = [
            'en_US' => 'New Year’s Day',
            'pl' => 'Nowy Rok',
        ];

        $translationsStub->expects(self::once())->method('getTranslations')->with(self::equalTo('newYearsDay'))->willReturn($translations);

        $locale = 'pl_PL';

        $holiday = new Holiday('newYearsDay', [], new \DateTime('2015-01-01'), $locale);
        $holiday->mergeGlobalTranslations($translationsStub);

        self::assertNotNull($holiday->getName());
        self::assertIsString($holiday->getName());
        self::assertEquals($translations['pl'], $holiday->getName());
    }

    /** @throws \Exception */
    public function testHolidayGetNameWithGlobalAndCustomTranslations(): void
    {
        $translationsStub = $this->getMockBuilder(TranslationsInterface::class)->getMock();

        $translations = [
            'en_US' => 'New Year’s Day',
            'pl_PL' => 'Nowy Rok',
        ];

        $translationsStub->expects(self::once())->method('getTranslations')->with(self::equalTo('newYearsDay'))->willReturn($translations);

        $customLocale = 'nl_NL';
        $customTranslation = 'Nieuwjaar';

        $holiday = new Holiday(
            'newYearsDay',
            [$customLocale => $customTranslation],
            new \DateTime('2015-01-01'),
            $customLocale
        );
        $holiday->mergeGlobalTranslations($translationsStub);

        self::assertNotNull($holiday->getName());
        self::assertIsString($holiday->getName());
        self::assertEquals($customTranslation, $holiday->getName());
    }

    /** @throws \Exception */
    public function testHolidayGetNameWithOverridenGlobalTranslations(): void
    {
        $translationsStub = $this->getMockBuilder(TranslationsInterface::class)->getMock();

        $translations = [
            'en_US' => 'New Year’s Day',
            'pl_PL' => 'Nowy Rok',
        ];

        $translationsStub->expects(self::once())->method('getTranslations')->with(self::equalTo('newYearsDay'))->willReturn($translations);

        $customLocale = 'pl_PL';
        $customTranslation = 'Bardzo Nowy Rok';

        $holiday = new Holiday(
            'newYearsDay',
            [$customLocale => $customTranslation],
            new \DateTime('2014-01-01'),
            $customLocale
        );
        $holiday->mergeGlobalTranslations($translationsStub);

        self::assertNotNull($holiday->getName());
        self::assertIsString($holiday->getName());
        self::assertEquals($customTranslation, $holiday->getName());
    }
}
