<?php

declare(strict_types = 1);

/**
 * This file is part of the 'Yasumi' package.
 *
 * The easy PHP Library for calculating holidays.
 *
 * Copyright (c) 2015 - 2025 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <me at sachatelgenhof dot com>
 */

namespace Yasumi\tests\NewZealand;

use Yasumi\Holiday;
use Yasumi\tests\HolidayTestCase;

/**
 * Class for testing Matariki in New Zealand.
 */
class MatarikiTest extends NewZealandBaseTestCase implements HolidayTestCase
{
    /**
     * The name of the holiday.
     */
    public const HOLIDAY = 'matariki';

    /**
     * The year in which the holiday was first established.
     */
    public const ESTABLISHMENT_YEAR = 2022;

    /**
     * The year the Matariki Advisory Committee have calculated dates until
     */
    public const CALCULATED_UNTIL_YEAR = 2052;

    /**
     * Tests Matariki.
     *
     * @dataProvider HolidayDataProvider
     *
     * @param int      $year     the year for which the holiday defined in this test needs to be tested
     * @param DateTime $expected the expected date
     */
    public function testHoliday(int $year, \DateTimeInterface $expected): void
    {
        $this->assertHoliday(self::REGION, self::HOLIDAY, $year, $expected);
    }

    /**
     *  Tests that Holiday is not present before 2022.
     */
    public function testNotHoliday(): void
    {
        $this->assertNotHoliday(self::REGION, self::HOLIDAY, self::ESTABLISHMENT_YEAR - 1);
    }

    /**
     * Returns a list of test dates.
     *
     * @return array<array> list of test dates for the holiday defined in this test
     *
     * @throws Exception
     */
    public function HolidayDataProvider(): array
    {
        $data = [];

        $matarikiDates = [
            2022 => ['month' => 6, 'day' => 24],
            2023 => ['month' => 7, 'day' => 14],
            2024 => ['month' => 6, 'day' => 28],
            2025 => ['month' => 6, 'day' => 20],
            2026 => ['month' => 7, 'day' => 10],
            2027 => ['month' => 6, 'day' => 25],
            2028 => ['month' => 7, 'day' => 14],
            2029 => ['month' => 7, 'day' => 6],
            2030 => ['month' => 6, 'day' => 21],
            2031 => ['month' => 7, 'day' => 11],
            2032 => ['month' => 7, 'day' => 2],
            2033 => ['month' => 6, 'day' => 24],
            2034 => ['month' => 7, 'day' => 7],
            2035 => ['month' => 6, 'day' => 29],
            2036 => ['month' => 7, 'day' => 18],
            2037 => ['month' => 7, 'day' => 10],
            2038 => ['month' => 6, 'day' => 25],
            2039 => ['month' => 7, 'day' => 15],
            2040 => ['month' => 7, 'day' => 6],
            2041 => ['month' => 7, 'day' => 19],
            2042 => ['month' => 7, 'day' => 11],
            2043 => ['month' => 7, 'day' => 3],
            2044 => ['month' => 6, 'day' => 24],
            2045 => ['month' => 7, 'day' => 7],
            2046 => ['month' => 6, 'day' => 29],
            2047 => ['month' => 7, 'day' => 19],
            2048 => ['month' => 7, 'day' => 3],
            2049 => ['month' => 6, 'day' => 25],
            2050 => ['month' => 7, 'day' => 15],
            2051 => ['month' => 6, 'day' => 30],
            2052 => ['month' => 6, 'day' => 21],
        ];

        for ($y = 1; $y <= 100; ++$y) {
            $year = $this->generateRandomYear(self::ESTABLISHMENT_YEAR, self::CALCULATED_UNTIL_YEAR);
            $expected = new \DateTime(
                sprintf('%04d-%02d-%02d', $year, $matarikiDates[$year]['month'], $matarikiDates[$year]['day']),
                new \DateTimeZone(self::TIMEZONE)
            );
            $data[] = [$year, $expected];
        }

        return $data;
    }

    /**
     * Tests the translated name of the holiday defined in this test.
     *
     * @throws Exception
     */
    public function testTranslation(): void
    {
        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(self::ESTABLISHMENT_YEAR, self::CALCULATED_UNTIL_YEAR),
            [self::LOCALE => 'Matariki']
        );
    }

    /**
     * Tests type of the holiday defined in this test.
     *
     * @throws Exception
     */
    public function testHolidayType(): void
    {
        $this->assertHolidayType(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(self::ESTABLISHMENT_YEAR, self::CALCULATED_UNTIL_YEAR),
            Holiday::TYPE_OFFICIAL
        );
    }
}
