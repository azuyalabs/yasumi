<?php
/*
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Yasumi\Tests\Japan;

use Carbon\Carbon;

/**
 * Class NationalFoundationDayTest.
 */
class NationalFoundationDayTest extends JapanBaseTestCase
{
    /**
     * The name of the holiday
     */
    const HOLIDAY = 'nationalFoundationDay';

    /**
     * Tests National Foundation Day after 1966. National Foundation day was established after 1966
     */
    public function testNationalFoundationDayOnAfter1966()
    {
        $year = 1972;
        $this->assertHoliday(self::COUNTRY, self::HOLIDAY, $year, Carbon::createFromDate($year, 2, 11));
        $year = 2046;
        $this->assertHoliday(self::COUNTRY, self::HOLIDAY, $year,
            Carbon::createFromDate($year, 2, 12)); // Substituted day
    }

    /**
     * Tests National Foundation Day before 1966. National Foundation day was established after 1966
     */
    public function testNationalFoundationDayBefore1966()
    {
        $this->assertNotHoliday(self::COUNTRY, self::HOLIDAY, $this->generateRandomYear(1000, 1965));
    }
}
