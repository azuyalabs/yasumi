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

namespace Yasumi\tests\Slovakia;

use Yasumi\Holiday;
use Yasumi\tests\HolidayTestCase;

/**
 * Class for testing the Our Lady of Sorrows holiday in Slovakia.
 *
 * @author  Andrej Rypak (dakujem) <xrypak@gmail.com>
 */
class OurLadyOfSorrowsDayTest extends SlovakiaBaseTestCase implements HolidayTestCase
{
    public const HOLIDAY = 'ourLadyOfSorrowsDay';

    /**
     * Tests the holiday defined in this test.
     *
     * @dataProvider HolidayDataProvider
     *
     * @param int    $year     the year for which this holiday needs to be tested
     * @param string $expected the expected date
     */
    public function testHoliday(int $year, $expected): void
    {
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new \DateTime($expected, new \DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Returns a list of random test dates used for assertion of the holiday defined in this test.
     *
     * @return array<array> list of test dates for the holiday defined in this test
     *
     * @throws \Exception
     */
    public function HolidayDataProvider(): array
    {
        return $this->generateRandomDatesWithModifier(9, 15, function ($year, \DateTime $date): void {
            // Our Lady of Sorrows Day is not observed in 2025 and 2026
            if (in_array($year, [2025, 2026])) {
                return;
            }
        }, 5, 1000, self::TIMEZONE);
    }

    /**
     * Tests the translated name of the holiday defined in this test.
     *
     * @throws \Exception
     */
    public function testTranslation(): void
    {
        // Our Lady of Sorrows Day is not observed in 2025 and 2026
        $validYears = array_merge(range(1993, 2024), range(2027, 2100));
        $year = $this->randomYearFromArray($validYears);

        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            $year,
            [self::LOCALE => 'Sviatok Sedembolestnej Panny Márie']
        );
    }

    /**
     * Tests type of the holiday defined in this test.
     *
     * @throws \Exception
     */
    public function testHolidayType(): void
    {
        // Our Lady of Sorrows Day is not observed in 2025 and 2026
        $validYears = array_merge(range(1993, 2024), range(2027, 2100));
        $year = $this->randomYearFromArray($validYears);

        $this->assertHolidayType(self::REGION, self::HOLIDAY, $year, Holiday::TYPE_BANK);
    }
}
