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

use Yasumi\Holiday;
use Yasumi\Provider\DateTimeZoneFactory;
use Yasumi\tests\HolidayTestCase;

/**
 * Class for testing Buddha's Birthday.
 */
class BuddhasBirthdayTest extends SouthKoreaBaseTestCase implements HolidayTestCase
{
    /**
     * The name of the holiday.
     */
    public const HOLIDAY = 'buddhasBirthday';

    /**
     * The year in which the holiday was first established.
     */
    public const ESTABLISHMENT_YEAR = 1975;

    /** @var int Upper limit year for lunar calendar test. */
    public const LUNAR_UPPER_LIMIT = 2050;

    /**
     * Tests the holiday defined in this test.
     *
     * @throws \Exception
     */
    public function testHoliday(): void
    {
        // From 1975 to LUNAR_UPPER_LIMIT
        $year = static::generateRandomYear(self::ESTABLISHMENT_YEAR, self::LUNAR_UPPER_LIMIT);
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new \DateTime(self::LUNAR_HOLIDAY[self::HOLIDAY][$year], DateTimeZoneFactory::getDateTimeZone(self::TIMEZONE))
        );

        // Before 1975
        $this->assertNotHoliday(
            self::REGION,
            self::HOLIDAY,
            static::generateRandomYear(null, self::ESTABLISHMENT_YEAR - 1)
        );
    }

    /**
     * Tests substitute holidays.
     *
     * @param int     $year     the year for which the holiday defined in this test needs to be tested
     * @param ?string $expected the expected date
     *
     * @throws \Exception
     */
    #[\PHPUnit\Framework\Attributes\DataProvider('SubstituteHolidayDataProvider')]
    public function testSubstituteHoliday(int $year, ?string $expected): void
    {
        if ($expected) {
            $this->assertSubstituteHoliday(
                self::REGION,
                self::HOLIDAY,
                $year,
                new \DateTime($expected, DateTimeZoneFactory::getDateTimeZone(self::TIMEZONE))
            );
        } else {
            $this->assertNotSubstituteHoliday(
                self::REGION,
                self::HOLIDAY,
                $year
            );
        }
    }

    /**
     * Tests the translated name of the holiday defined in this test.
     *
     * @throws \Exception
     */
    public function testTranslation(): void
    {
        // Initial official name (Until 2017)
        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            static::generateRandomYear(self::ESTABLISHMENT_YEAR, 2017),
            ['ko' => '석가탄신일']
        );

        // Revised official name (From 2018)
        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            static::generateRandomYear(2018, self::LUNAR_UPPER_LIMIT),
            ['ko' => '부처님오신날']
        );
    }

    /**
     * Tests type of the holiday defined in this test.
     *
     * @throws \Exception
     */
    public function testHolidayType(): void
    {
        $this->assertHolidayType(
            self::REGION,
            self::HOLIDAY,
            static::generateRandomYear(self::ESTABLISHMENT_YEAR, self::LUNAR_UPPER_LIMIT),
            Holiday::TYPE_OFFICIAL
        );
    }

    /**
     * Data provider for generating a precalculated list of alternative holidays
     *
     * Range: From 2020 to 2050 (LUNAR_UPPER_LIMIT)
     * Alternative holidays applied from 2023 onwards.
     *
     * @return \Generator<array<int, string>> year, date
     */
    public static function SubstituteHolidayDataProvider(): \Generator
    {
        $data = [
            2023 => '2023-05-29',
            2025 => '2025-05-06',
            2026 => '2026-05-25',
            2029 => '2029-05-21',
            2032 => '2032-05-17',
            2036 => '2036-05-06',
            2039 => '2039-05-02',
            2043 => '2043-05-18',
            2044 => '2044-05-06',
            2046 => '2046-05-14',
            2049 => '2049-05-10',
            2050 => '2050-05-30',
        ];

        foreach (range(2020, 2050) as $year) {
            yield [$year, $data[$year] ?? null];
        }
    }
}
