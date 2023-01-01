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
use Yasumi\Exception\UnknownLocaleException;
use Yasumi\Holiday;
use Yasumi\SubstituteHoliday;
use Yasumi\tests\YasumiBase;
use Yasumi\TranslationsInterface;

class SubstituteHolidayTest extends TestCase
{
    use YasumiBase;

    /** @throws \Exception */
    public function testCreateSubstituteHolidayUnknownLocaleException(): void
    {
        $holiday = new Holiday('testHoliday', [], new \DateTime());

        $this->expectException(UnknownLocaleException::class);

        new SubstituteHoliday($holiday, [], new \DateTime(), 'wx-YZ');
    }

    /**
     * Tests that an InvalidArgumentException is thrown in case the substitute is on the same date as the substituted.
     *
     * @throws \Exception
     */
    public function testCreateSubstituteHolidaySameDate(): void
    {
        $holiday = new Holiday('testHoliday', [], new \DateTime('2019-01-01'));

        $this->expectException(\InvalidArgumentException::class);

        new SubstituteHoliday($holiday, [], new \DateTime('2019-01-01'));
    }

    /** @throws \Exception */
    public function testConstructor(): void
    {
        $holiday = new Holiday('testHoliday', [], new \DateTime('2019-01-01'), 'en_US', Holiday::TYPE_BANK);
        $substitute = new SubstituteHoliday($holiday, [], new \DateTime('2019-01-02'), 'en_US', Holiday::TYPE_SEASON);

        self::assertSame($holiday, $substitute->getSubstitutedHoliday());
        self::assertEquals('substituteHoliday:testHoliday', $substitute->getKey());
        self::assertEquals(Holiday::TYPE_SEASON, $substitute->getType());
        self::assertEquals(new \DateTime('2019-01-02'), $substitute);
    }

    /** @throws \Exception */
    public function testSubstituteHolidayIsJsonSerializable(): void
    {
        $holiday = new Holiday('testHoliday', [], new \DateTime('2019-01-01'), 'en_US');
        $substitute = new SubstituteHoliday($holiday, [], new \DateTime('2019-01-02'), 'en_US');
        $json = json_encode($substitute, JSON_THROW_ON_ERROR);
        $instance = json_decode($json, true, 512, JSON_THROW_ON_ERROR);

        self::assertIsArray($instance);
        self::assertNotNull($instance);
        self::assertArrayHasKey('shortName', $instance);
        self::assertArrayHasKey('substitutedHoliday', $instance);
    }

    /** @throws \Exception */
    public function testSubstituteHolidayWithDateTimeInterface(): void
    {
        // Assert with DateTime instance
        $holiday = new Holiday('testHoliday', [], new \DateTime('2019-01-01'), 'en_US');
        $substitute = new SubstituteHoliday($holiday, [], new \DateTime('2019-01-02'), 'en_US');
        self::assertNotNull($holiday);
        self::assertInstanceOf(SubstituteHoliday::class, $substitute);

        // Assert with DateTimeImmutable instance
        $substitute = new SubstituteHoliday($holiday, [], new \DateTimeImmutable(), 'en_US');
        self::assertNotNull($holiday);
        self::assertInstanceOf(SubstituteHoliday::class, $substitute);
    }

    /** @throws \Exception */
    public function testSubstituteHolidayGetNameWithNoTranslations(): void
    {
        $name = 'testHoliday';
        $holiday = new Holiday($name, [], new \DateTime('2019-01-01'));
        $substitute = new SubstituteHoliday($holiday, [], new \DateTime('2019-01-02'), 'en_US');

        self::assertIsString($substitute->getName());
        self::assertEquals('substituteHoliday:'.$name, $substitute->getName());
    }

    /** @throws \Exception */
    public function testSubstituteHolidayGetNameWithCustomSubstituteTranslation(): void
    {
        $name = 'testHoliday';
        $translation = 'My Holiday';
        $locale = 'en_US';
        $holiday = new Holiday($name, [$locale => 'foo'], new \DateTime('2019-01-01'), $locale);
        $substitute = new SubstituteHoliday($holiday, [$locale => $translation], new \DateTime('2019-01-02'), $locale);

        $translationsStub = $this->getMockBuilder(TranslationsInterface::class)->getMock();
        $translationsStub
            ->expects(self::exactly(3))
            ->method('getTranslations')
            ->withConsecutive([self::equalTo('substituteHoliday')], [self::equalTo('substituteHoliday:testHoliday')], [self::equalTo('testHoliday')])
            ->willReturnOnConsecutiveCalls(
                [$locale => 'foo'],
                [$locale => 'foo'],
                ['en' => 'foo']
            );

        $substitute->mergeGlobalTranslations($translationsStub);

        self::assertIsString($substitute->getName());
        self::assertEquals($translation, $substitute->getName());
    }

    /** @throws \Exception */
    public function testSubstituteHolidayGetNameWithPatternFallback(): void
    {
        $name = 'testHoliday';
        $translation = 'My Holiday';
        $locale = 'en_US';
        $holiday = new Holiday($name, [], new \DateTime('2019-01-01'), $locale);
        $substitute = new SubstituteHoliday($holiday, [], new \DateTime('2019-01-02'), $locale);

        $translationsStub = $this->getMockBuilder(TranslationsInterface::class)->getMock();
        $translationsStub
            ->expects(self::exactly(3))
            ->method('getTranslations')
            ->withConsecutive([self::equalTo('substituteHoliday')], [self::equalTo('substituteHoliday:testHoliday')], [self::equalTo('testHoliday')])
            ->willReturnOnConsecutiveCalls(
                ['en' => '{0} obs'],
                [],
                [$locale => $translation]
            );

        $substitute->mergeGlobalTranslations($translationsStub);

        self::assertIsString($substitute->getName());
        self::assertEquals('My Holiday obs', $substitute->getName());
    }

    /** @throws \Exception */
    public function testSubstituteHolidayGetNameWithGlobalSubstituteTranslation(): void
    {
        $name = 'testHoliday';
        $translation = 'My Substitute';
        $locale = 'en_US';
        $holiday = new Holiday($name, [$locale => 'foo'], new \DateTime('2019-01-01'), $locale);
        $substitute = new SubstituteHoliday($holiday, [$locale => $translation], new \DateTime('2019-01-02'), $locale);

        $translationsStub = $this->getMockBuilder(TranslationsInterface::class)->getMock();
        $translationsStub
            ->expects(self::exactly(3))
            ->method('getTranslations')
            ->withConsecutive([self::equalTo('substituteHoliday')], [self::equalTo('substituteHoliday:testHoliday')], [self::equalTo('testHoliday')])
            ->willReturnOnConsecutiveCalls(
                [$locale => '{0} observed'],
                [$locale => $translation],
                [$locale => 'foo'],
            );

        $substitute->mergeGlobalTranslations($translationsStub);

        self::assertIsString($substitute->getName());
        self::assertEquals($translation, $substitute->getName());
    }

    /** @throws \Exception */
    public function testSubstituteHolidayGetNameWithSubstitutedTranslation(): void
    {
        $name = 'testHoliday';
        $translation = 'My Holiday';
        $locale = 'en_US';
        $holiday = new Holiday($name, [$locale => $translation], new \DateTime('2019-01-01'), $locale);
        $substitute = new SubstituteHoliday($holiday, [], new \DateTime('2019-01-02'), $locale);

        $translationsStub = $this->getMockBuilder(TranslationsInterface::class)->getMock();
        $translationsStub
            ->expects(self::exactly(3))
            ->method('getTranslations')
            ->withConsecutive([self::equalTo('substituteHoliday')], [self::equalTo('substituteHoliday:testHoliday')], [self::equalTo('testHoliday')])
            ->willReturnOnConsecutiveCalls(
                [$locale => '{0} observed'],
                [],
                [$locale => $translation],
            );

        $substitute->mergeGlobalTranslations($translationsStub);

        self::assertIsString($substitute->getName());
        self::assertEquals('My Holiday observed', $substitute->getName());
    }
}
