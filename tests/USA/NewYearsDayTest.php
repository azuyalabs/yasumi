<?php
/*
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <stelgenhof@gmail.com>
 */
namespace Yasumi\Tests\USA;

use DateTime;
use DateTimeZone;

/**
 * Class for testing New Years Day in the USA.
 *
 * New Year's Day is observed on January 1, the first day of the year on the modern Gregorian calendar as well as the
 * Julian calendar. In case New Years Day falls on a Sunday, a substituted holiday is observed the following Monday. If
 * it falls on a Saturday, a substituted holiday is observed the previous Friday.
 *
 * @link http://en.wikipedia.org/wiki/New_Year%27s_Day Source: Wikipedia.
 */
class NewYearsDayTest extends USABaseTestCase
{
    /**
     * The name of the holiday
     */
    const HOLIDAY = 'newYearsDay';

    /**
     * Tests New Years Day.
     */
    public function testNewYearsDay()
    {
        $year = 1997;
        $this->assertHoliday(self::COUNTRY, self::HOLIDAY, $year,
            new DateTime("$year-1-1", new DateTimeZone(self::TIMEZONE)));

        // Substituted Holiday on Monday (New Years Day falls on Sunday)
        $year = 2445;
        $this->assertHoliday(self::COUNTRY, 'substituteHoliday:newYearsDay', $year,
            new DateTime("$year-1-2", new DateTimeZone(self::TIMEZONE)));

        // Substituted Holiday on Friday (New Years Day falls on Saturday)
        $year    = 1938;
        $subYear = $year - 1;
        $this->assertHoliday(self::COUNTRY, 'substituteHoliday:newYearsDay', $year,
            new DateTime("$subYear-12-31", new DateTimeZone(self::TIMEZONE)));
    }
}
