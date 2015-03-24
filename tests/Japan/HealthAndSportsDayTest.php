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
 * Class HealthAndSportsDayTest.
 */
class HealthAndSportsDayTest extends JapanBaseTestCase
{
    /**
     * The name of the holiday
     */
    const HOLIDAY = 'healthandSportsDay';

    /**
     * Tests Health And Sports Day after 2000. Health And Sports Day was established since 1996 on October 10th. After
     * 2000 it was changed to be the second monday of October.
     */
    public function testHealthAndSportsDayOnAfter2000()
    {
        $year = 2209;
        $this->assertHoliday(self::COUNTRY, self::HOLIDAY, $year, new Carbon('second monday of october ' . $year));
    }

    /**
     * Tests Health And Sports Day between 1996 and 2000. Health And Sports Day was established since 1996 on October
     * 10th. After 2000 it was changed to be the second monday of October.
     */
    public function testHealthAndSportsDayBetween1996And2000()
    {
        $year = 1997;
        $this->assertHoliday(self::COUNTRY, self::HOLIDAY, $year, Carbon::createFromDate($year, 10, 10));
        $year = 1999;
        $this->assertHoliday(self::COUNTRY, self::HOLIDAY, $year,
            Carbon::createFromDate($year, 10, 11)); // Substituted day
    }

    /**
     * Tests Health And Sports Day before. Health And Sports Day was established since 1996 on October 10th. After
     * 2000 it was changed to be the second monday of October.
     */
    public function testHealthAndSportsDayBefore1996()
    {
        $this->assertNotHoliday(self::COUNTRY, self::HOLIDAY, 399);
    }
}
