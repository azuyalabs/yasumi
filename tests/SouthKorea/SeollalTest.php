<?php

declare(strict_types = 1);

/**
 * This file is part of the 'Yasumi' package.
 *
 * The easy PHP Library for calculating holidays.
 *
 * Copyright (c) 2015 - 2026 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <me at sachatelgenhof dot com>
 */

namespace Yasumi\tests\SouthKorea;

use PHPUnit\Framework\Attributes\DataProvider;
use Yasumi\Holiday;
use Yasumi\Provider\DateTimeZoneFactory;
use Yasumi\tests\HolidayTestCase;

/**
 * Class for testing Seollal (Korean Lunar New Year's Day).
 */
class SeollalTest extends SouthKoreaBaseTestCase implements HolidayTestCase
{
    /** @var int Upper limit year for lunar calendar test. */
    public const LUNAR_UPPER_LIMIT = 2050;

    /**
     * The year in which the holiday was first established.
     */
    public const ESTABLISHMENT_YEAR = 1985;

    /**
     * The year in which the holiday was first expanded into a multi-day holiday.
     */
    public const EXPANSION_YEAR = 1989;

    /**
     * Testing Seollal itself
     *
     * @throws \Exception
     */
    public function testSeollal(): void
    {
        // From 1985 to LUNAR_UPPER_LIMIT
        $year = static::generateRandomYear(self::ESTABLISHMENT_YEAR, self::LUNAR_UPPER_LIMIT);
        $this->assertHoliday(
            self::REGION,
            'seollal',
            $year,
            new \DateTime(self::LUNAR_HOLIDAY['seollal'][$year], DateTimeZoneFactory::getDateTimeZone(self::TIMEZONE))
        );

        // Before 1985
        $this->assertNotHoliday(
            self::REGION,
            'seollal',
            static::generateRandomYear(null, self::ESTABLISHMENT_YEAR - 1)
        );
    }

    /**
     * Testing Seollal's eve
     *
     * @throws \DateInvalidOperationException
     */
    public function testDayBeforeSeollal(): void
    {
        // From 1989 to LUNAR_UPPER_LIMIT
        $year = static::generateRandomYear(self::EXPANSION_YEAR, self::LUNAR_UPPER_LIMIT);
        $this->assertHoliday(
            self::REGION,
            'dayBeforeSeollal',
            $year,
            (new \DateTime(self::LUNAR_HOLIDAY['seollal'][$year], DateTimeZoneFactory::getDateTimeZone(self::TIMEZONE)))->sub(new \DateInterval('P1D'))
        );

        // Before 1989
        $this->assertNotHoliday(
            self::REGION,
            'dayBeforeSeollal',
            static::generateRandomYear(null, self::EXPANSION_YEAR - 1)
        );
    }

    /**
     * Testing the day after Seollal
     *
     * @throws \Exception
     */
    public function testDayAfterSeollal(): void
    {
        // From 1989 to LUNAR_UPPER_LIMIT
        $year = static::generateRandomYear(self::EXPANSION_YEAR, self::LUNAR_UPPER_LIMIT);
        $this->assertHoliday(
            self::REGION,
            'dayAfterSeollal',
            $year,
            (new \DateTime(self::LUNAR_HOLIDAY['seollal'][$year], DateTimeZoneFactory::getDateTimeZone(self::TIMEZONE)))->add(new \DateInterval('P1D'))
        );

        // Before 1989
        $this->assertNotHoliday(
            self::REGION,
            'dayAfterSeollal',
            static::generateRandomYear(null, self::EXPANSION_YEAR - 1)
        );
    }

    /**
     * Tests the substitute holiday defined in this test (conflict with Sunday).
     *
     * @throws \Exception
     */
    #[DataProvider('SubstituteHolidayDataProvider')]
    public function testSubstituteHoliday(int $year, string $key, string $expected): void
    {
        $this->assertSubstituteHoliday(
            self::REGION,
            $key,
            $year,
            new \DateTime($expected, DateTimeZoneFactory::getDateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests the translated name of the holiday defined in this test.
     *
     * @throws \Exception
     */
    public function testTranslation(): void
    {
        // From 1985 to 1988
        // Seollal itself
        $this->assertTranslatedHolidayName(
            self::REGION,
            'seollal',
            static::generateRandomYear(self::ESTABLISHMENT_YEAR, self::EXPANSION_YEAR - 1),
            [self::LOCALE => '민속의 날']
        );

        // From 1989 to LUNAR_UPPER_LIMIT
        // Seollal itself
        $this->assertTranslatedHolidayName(
            self::REGION,
            'seollal',
            static::generateRandomYear(self::EXPANSION_YEAR, self::LUNAR_UPPER_LIMIT),
            [self::LOCALE => '설날']
        );

        // From 1989 to LUNAR_UPPER_LIMIT
        // Seollal's eve
        $this->assertTranslatedHolidayName(
            self::REGION,
            'dayBeforeSeollal',
            static::generateRandomYear(self::EXPANSION_YEAR, self::LUNAR_UPPER_LIMIT),
            [self::LOCALE => '설날 연휴']
        );

        // From 1989 to LUNAR_UPPER_LIMIT
        // The day after Seollal
        $this->assertTranslatedHolidayName(
            self::REGION,
            'dayAfterSeollal',
            static::generateRandomYear(self::EXPANSION_YEAR, self::LUNAR_UPPER_LIMIT),
            [self::LOCALE => '설날 연휴']
        );
    }

    /**
     * Tests type of the holiday defined in this test.
     *
     * @throws \Exception
     */
    public function testHolidayType(): void
    {
        // From 1985 to LUNAR_UPPER_LIMIT
        $this->assertHolidayType(
            self::REGION,
            'seollal',
            static::generateRandomYear(self::ESTABLISHMENT_YEAR, self::LUNAR_UPPER_LIMIT),
            Holiday::TYPE_OFFICIAL
        );

        // From 1989 to LUNAR_UPPER_LIMIT
        $this->assertHolidayType(
            self::REGION,
            'dayBeforeSeollal',
            static::generateRandomYear(self::EXPANSION_YEAR, self::LUNAR_UPPER_LIMIT),
            Holiday::TYPE_OFFICIAL
        );

        // From 1989 to LUNAR_UPPER_LIMIT
        $this->assertHolidayType(
            self::REGION,
            'dayAfterSeollal',
            static::generateRandomYear(self::EXPANSION_YEAR, self::LUNAR_UPPER_LIMIT),
            Holiday::TYPE_OFFICIAL
        );
    }

    /**
     * Data provider for generating a precalculated list of alternative holidays
     *
     * Range: From 2010 to 2050 (LUNAR_UPPER_LIMIT)
     *
     * @return array<array<int, string>> year, date
     */
    public static function SubstituteHolidayDataProvider(): array
    {
        return [
            2016 => [2016, 'dayBeforeSeollal', '2016-02-10'],
            2017 => [2017, 'dayAfterSeollal', '2017-01-30'],
            2020 => [2020, 'dayAfterSeollal', '2020-01-27'],
            2023 => [2023, 'seollal', '2023-01-24'],
            2024 => [2024, 'dayAfterSeollal', '2024-02-12'],
            2027 => [2027, 'seollal', '2027-02-09'],
            2030 => [2030, 'seollal', '2030-02-05'],
            2033 => [2033, 'dayBeforeSeollal', '2033-02-02'],
            2034 => [2034, 'seollal', '2034-02-21'],
            2036 => [2036, 'dayBeforeSeollal', '2036-01-30'],
            2037 => [2037, 'seollal', '2037-02-17'],
            2039 => [2039, 'dayBeforeSeollal', '2039-01-26'],
            2040 => [2040, 'seollal', '2040-02-14'],
            2044 => [2044, 'dayAfterSeollal', '2044-02-01'],
            2047 => [2047, 'dayAfterSeollal', '2047-01-28'],
        ];
    }
}
