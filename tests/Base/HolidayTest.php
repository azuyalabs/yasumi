<?php declare(strict_types=1);
/**
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 - 2020 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <me@sachatelgenhof.com>
 */

namespace Yasumi\tests\Base;

use DateTime;
use DateTimeImmutable;
use Exception;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Yasumi\Exception\MissingTranslationException;
use Yasumi\Exception\UnknownLocaleException;
use Yasumi\Holiday;
use Yasumi\tests\YasumiBase;
use Yasumi\TranslationsInterface;

/**
 * Class HolidayTest.
 *
 * Contains tests for testing the Holiday class
 */
class HolidayTest extends TestCase
{
    use YasumiBase;

    /**
     * Tests that an InvalidArgumentException is thrown in case a blank key is given.
     *
     * @throws Exception
     */
    public function testHolidayBlankKeyInvalidArgumentException(): void
    {
        $this->expectException(InvalidArgumentException::class);

        new Holiday('', [], new DateTime());
    }

    /**
     * Tests that an Yasumi\Exception\UnknownLocaleException is thrown in case an invalid locale is given.
     *
     * @throws Exception
     */
    public function testCreateHolidayUnknownLocaleException(): void
    {
        $this->expectException(UnknownLocaleException::class);

        new Holiday('testHoliday', [], new DateTime(), 'wx-YZ');
    }

    /**
     * Tests that a Yasumi holiday instance can be serialized to a JSON object.
     * @throws Exception
     */
    public function testHolidayIsJsonSerializable(): void
    {
        $holiday = new Holiday('testHoliday', [], new DateTime(), 'en_US');
        $json = \json_encode($holiday);
        $instance = \json_decode($json, true);

        $this->assertIsArray($instance);
        $this->assertNotNull($instance);
        $this->assertArrayHasKey('shortName', $instance);
    }

    /**
     * Tests that a Yasumi holiday instance can be created using an object that implements the DateTimeInterface (e.g.
     * DateTime or DateTimeImmutable)
     * @throws Exception
     */
    public function testHolidayWithDateTimeInterface(): void
    {
        // Assert with DateTime instance
        $holiday = new Holiday('testHoliday', [], new DateTime(), 'en_US');
        $this->assertNotNull($holiday);
        $this->assertInstanceOf(Holiday::class, $holiday);

        // Assert with DateTimeImmutable instance
        $holiday = new Holiday('testHoliday', [], new DateTimeImmutable(), 'en_US');
        $this->assertNotNull($holiday);
        $this->assertInstanceOf(Holiday::class, $holiday);
    }

    /**
     * Tests the getLocales function of the Holiday object.
     * @throws Exception
     */
    public function testHolidayGetLocales(): void
    {
        $holiday = new Holiday('testHoliday', [], new DateTime(), 'ca_ES_VALENCIA');
        $method = new \ReflectionMethod(Holiday::class, 'getLocales');
        $method->setAccessible(true);

        $this->assertEquals(['ca_ES_VALENCIA', 'ca_ES', 'ca', 'en_US', 'en', Holiday::LOCALE_KEY], $method->invoke($holiday, null));
        $this->assertEquals(['de_DE', 'de', 'es_ES', 'es'], $method->invoke($holiday, ['de_DE', 'es_ES']));
        $this->assertEquals(['de_DE', 'de', Holiday::LOCALE_KEY], $method->invoke($holiday, ['de_DE', Holiday::LOCALE_KEY]));
    }

    /**
     * Tests the getName function of the Holiday object without any arguments provided.
     * @throws Exception
     */
    public function testHolidayGetNameWithoutArgument(): void
    {
        // 'en_US' fallback
        $translations = [
            'de' => 'Holiday DE',
            'de_AT' => 'Holiday DE-AT',
            'en' => 'Holiday EN',
            'en_US' => 'Holiday EN-US',
        ];

        $holiday = new Holiday('testHoliday', $translations, new DateTime(), 'de_AT');
        $this->assertEquals('Holiday DE-AT', $holiday->getName());

        $holiday = new Holiday('testHoliday', $translations, new DateTime(), 'de');
        $this->assertEquals('Holiday DE', $holiday->getName());

        $holiday = new Holiday('testHoliday', $translations, new DateTime(), 'de_DE');
        $this->assertEquals('Holiday DE', $holiday->getName());

        $holiday = new Holiday('testHoliday', $translations, new DateTime(), 'ja');
        $this->assertEquals('Holiday EN-US', $holiday->getName());

        // 'en' fallback
        $translations = [
            'de' => 'Holiday DE',
            'en' => 'Holiday EN',
        ];

        $holiday = new Holiday('testHoliday', $translations, new DateTime(), 'de_DE');
        $this->assertEquals('Holiday DE', $holiday->getName());

        $holiday = new Holiday('testHoliday', $translations, new DateTime(), 'ja');
        $this->assertEquals('Holiday EN', $holiday->getName());


        // No 'en' or 'en_US' fallback
        $translations = [
            'de' => 'Holiday DE',
        ];

        $holiday = new Holiday('testHoliday', $translations, new DateTime(), 'de_DE');
        $this->assertEquals('Holiday DE', $holiday->getName());

        $holiday = new Holiday('testHoliday', $translations, new DateTime(), 'ja');
        $this->assertEquals('testHoliday', $holiday->getName());
    }

    /**
     * Tests the getName function of the Holiday object with an explicit list of locales.
     * @throws MissingTranslationException
     * @throws Exception
     */
    public function testHolidayGetNameWithArgument(): void
    {
        $translations = [
            'de' => 'Holiday DE',
            'de_AT' => 'Holiday DE-AT',
            'nl' => 'Holiday NL',
            'it_IT' => 'Holiday IT-IT',
            'en_US' => 'Holiday EN-US',
        ];
        $holiday = new Holiday('testHoliday', $translations, new DateTime(), 'de_DE');

        $this->assertEquals('Holiday DE', $holiday->getName(['de']));
        $this->assertEquals('Holiday DE', $holiday->getName(['ja', 'de', 'nl', 'it_IT']));
        $this->assertEquals('Holiday DE', $holiday->getName(['de_DE']));
        $this->assertEquals('Holiday DE', $holiday->getName(['de_DE_berlin']));
        $this->assertEquals('Holiday DE', $holiday->getName(['de_DE_berlin', 'nl', 'it_IT']));
        $this->assertEquals('Holiday DE-AT', $holiday->getName(['de_AT']));
        $this->assertEquals('Holiday DE-AT', $holiday->getName(['de_AT_vienna']));
        $this->assertEquals('Holiday NL', $holiday->getName(['nl']));
        $this->assertEquals('Holiday NL', $holiday->getName(['nl_NL']));
        $this->assertEquals('Holiday IT-IT', $holiday->getName(['it_IT']));
        $this->assertEquals('Holiday IT-IT', $holiday->getName(['it_IT', Holiday::LOCALE_KEY]));
        $this->assertEquals('testHoliday', $holiday->getName([Holiday::LOCALE_KEY]));

        $holiday = new Holiday('testHoliday', $translations, new DateTime(), 'ja');
        $this->assertEquals('Holiday EN-US', $holiday->getName());

        $this->expectException(MissingTranslationException::class);
        $holiday->getName(['it']);
    }

    /**
     * Tests the getName function of the Holiday object with global translations and no custom translation.
     * @throws Exception
     */
    public function testHolidayGetNameWithGlobalTranslations(): void
    {
        /** @var TranslationsInterface|PHPUnit_Framework_MockObject_MockObject $translationsStub */
        $translationsStub = $this->getMockBuilder(TranslationsInterface::class)->getMock();

        $translations = [
            'en_US' => 'New Year’s Day',
            'pl_PL' => 'Nowy Rok',
        ];

        $translationsStub->expects($this->once())->method('getTranslations')->with($this->equalTo('newYearsDay'))->willReturn($translations);

        $locale = 'pl_PL';

        $holiday = new Holiday('newYearsDay', [], new DateTime('2015-01-01'), $locale);
        $holiday->mergeGlobalTranslations($translationsStub);

        $this->assertNotNull($holiday->getName());
        $this->assertIsString($holiday->getName());
        $this->assertEquals($translations[$locale], $holiday->getName());
    }

    /**
     * Tests the getName function of the Holiday object with global translations and no custom translation.
     * @throws Exception
     */
    public function testHolidayGetNameWithGlobalParentLocaleTranslations(): void
    {
        /** @var TranslationsInterface|PHPUnit_Framework_MockObject_MockObject $translationsStub */
        $translationsStub = $this->getMockBuilder(TranslationsInterface::class)->getMock();

        $translations = [
            'en_US' => 'New Year’s Day',
            'pl' => 'Nowy Rok',
        ];

        $translationsStub->expects($this->once())->method('getTranslations')->with($this->equalTo('newYearsDay'))->willReturn($translations);

        $locale = 'pl_PL';

        $holiday = new Holiday('newYearsDay', [], new DateTime('2015-01-01'), $locale);
        $holiday->mergeGlobalTranslations($translationsStub);

        $this->assertNotNull($holiday->getName());
        $this->assertIsString($holiday->getName());
        $this->assertEquals($translations['pl'], $holiday->getName());
    }

    /**
     * Tests the getName function of the Holiday object with global translations and a new custom translation.
     * @throws Exception
     */
    public function testHolidayGetNameWithGlobalAndCustomTranslations(): void
    {
        /** @var TranslationsInterface|PHPUnit_Framework_MockObject_MockObject $translationsStub */
        $translationsStub = $this->getMockBuilder(TranslationsInterface::class)->getMock();

        $translations = [
            'en_US' => 'New Year’s Day',
            'pl_PL' => 'Nowy Rok',
        ];

        $translationsStub->expects($this->once())->method('getTranslations')->with($this->equalTo('newYearsDay'))->willReturn($translations);

        $customLocale = 'nl_NL';
        $customTranslation = 'Nieuwjaar';

        $holiday = new Holiday(
            'newYearsDay',
            [$customLocale => $customTranslation],
            new DateTime('2015-01-01'),
            $customLocale
        );
        $holiday->mergeGlobalTranslations($translationsStub);

        $this->assertNotNull($holiday->getName());
        $this->assertIsString($holiday->getName());
        $this->assertEquals($customTranslation, $holiday->getName());
    }

    /**
     * Tests the getName function of the Holiday object with global translations and an overriding custom translation.
     * @throws Exception
     */
    public function testHolidayGetNameWithOverridenGlobalTranslations(): void
    {
        /** @var TranslationsInterface|PHPUnit_Framework_MockObject_MockObject $translationsStub */
        $translationsStub = $this->getMockBuilder(TranslationsInterface::class)->getMock();

        $translations = [
            'en_US' => 'New Year’s Day',
            'pl_PL' => 'Nowy Rok',
        ];

        $translationsStub->expects($this->once())->method('getTranslations')->with($this->equalTo('newYearsDay'))->willReturn($translations);

        $customLocale = 'pl_PL';
        $customTranslation = 'Bardzo Nowy Rok';

        $holiday = new Holiday(
            'newYearsDay',
            [$customLocale => $customTranslation],
            new DateTime('2014-01-01'),
            $customLocale
        );
        $holiday->mergeGlobalTranslations($translationsStub);

        $this->assertNotNull($holiday->getName());
        $this->assertIsString($holiday->getName());
        $this->assertEquals($customTranslation, $holiday->getName());
    }
}
