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
 * Class GreeneryDayTest.
 */
class GreeneryDayTest extends JapanBaseTestCase
{
    /**
     * The name of the holiday
     */
    const HOLIDAY = 'greeneryDay';

    /**
     * Tests Greenery Day after 2007. Greenery Day was established from 1989 on April 29th. After 2007
     * it was changed to be May 4th.
     */
    public function testGreeneryDayOnAfter2007()
    {
        $year = 2112;
        $this->assertHoliday(self::COUNTRY, self::HOLIDAY, $year, Carbon::createFromDate($year, 5, 4));
        $year = 2014;
        $this->assertHoliday(self::COUNTRY, self::HOLIDAY, $year,
            Carbon::createFromDate($year, 5, 6)); // Substituted day
    }

    /**
     * Tests Greenery Day between 1989 and 2007. Greenery Day was established from 1989 on April 29th. After 2007
     * it was changed to be May 4th.
     */
    public function testGreeneryDayBetween1989And2007()
    {
        $year = 1997;
        $this->assertHoliday(self::COUNTRY, self::HOLIDAY, $year, Carbon::createFromDate($year, 4, 29));
        $year = 2001;
        $this->assertHoliday(self::COUNTRY, self::HOLIDAY, $year,
            Carbon::createFromDate($year, 4, 30)); // Substituted day
    }

    /**
     * Tests Greenery Day before 1989. Greenery Day was established from 1989 on April 29th. After 2007
     * it was changed to be May 4th.
     */
    public function testGreeneryDayBefore1989()
    {
        $this->assertNotHoliday(self::COUNTRY, self::HOLIDAY, 1614);
    }
}
