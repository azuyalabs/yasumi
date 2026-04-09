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

namespace Yasumi\tests\Australia\NorthernTerritory;

use Yasumi\Holiday;
use Yasumi\tests\HolidayTestCase;

/**
 * Class for testing ANZAC Day Monday substitute in Northern Territory (Australia).
 */
class AnzacDayMondayTest extends NorthernTerritoryBaseTestCase implements HolidayTestCase
{
    /**
     * The name of the holiday.
     */
    public const HOLIDAY = 'anzacDayMonday';

    /**
     * Tests ANZAC Day Monday.
     *
     * @param int    $year     the year for which the holiday defined in this test needs to be tested
     * @param string $expected the expected date
     *
     * @throws \Exception
     */
    #[\PHPUnit\Framework\Attributes\DataProvider('HolidayDataProvider')]
    public function testHoliday(int $year, string $expected): void
    {
        $this->assertHoliday(
            $this->region,
            self::HOLIDAY,
            $year,
            new \DateTime($expected, new \DateTimeZone($this->timezone))
        );
    }

    /**
     * Returns a list of test dates.
     *
     * @return array<array> list of test dates for the holiday defined in this test
     */
    public static function HolidayDataProvider(): array
    {
        return [
            [2027, '2027-04-26'],
            [2032, '2032-04-26'],
        ];
    }

    /**
     * Tests that ANZAC Day Monday is not defined when April 25 is not a Sunday.
     *
     * @throws \Exception
     */
    public function testNotHoliday(): void
    {
        $this->assertNotHoliday($this->region, self::HOLIDAY, 2026);
        $this->assertNotHoliday($this->region, self::HOLIDAY, 2028);
    }

    /**
     * Tests the translated name of the holiday defined in this test.
     *
     * @throws \Exception
     */
    public function testTranslation(): void
    {
        $this->assertTranslatedHolidayName(
            $this->region,
            self::HOLIDAY,
            2027,
            [self::LOCALE => 'ANZAC Day']
        );
    }

    /**
     * Tests type of the holiday defined in this test.
     *
     * @throws \Exception
     */
    public function testHolidayType(): void
    {
        $this->assertHolidayType($this->region, self::HOLIDAY, 2027, Holiday::TYPE_OFFICIAL);
    }
}
