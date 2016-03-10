<?php
/**
 *  This file is part of the Yasumi package.
 *
 *  Copyright (c) 2015 - 2016 AzuyaLabs
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 *
 *  @author Sacha Telgenhof <stelgenhof@gmail.com>
 */

namespace Yasumi\Tests\Japan;

use DateTime;
use DateTimeZone;

/**
 * Class for testing Labor Thanksgiving Day in Japan.
 */
class LabourThanksgivingDayTest extends JapanBaseTestCase
{
    /**
     * The name of the holiday
     */
    const HOLIDAY = 'laborThanksgivingDay';

    /**
     * The year in which the holiday was first established
     */
    const ESTABLISHMENT_YEAR = 1948;

    /**
     * Tests Labor Thanksgiving Day after 1948. Labor Thanksgiving Day is held on November 23rd and established since
     * 1948.
     */
    public function testLabourThanksgivingDayOnAfter1948()
    {
        $year = 4884;
        $this->assertHoliday(self::COUNTRY, self::HOLIDAY, $year,
            new DateTime("$year-11-23", new DateTimeZone(self::TIMEZONE)));
    }

    /**
     * Tests Labor Thanksgiving Day after 1948 substituted next working day (when Labor Thanksgiving Day falls on a
     * Sunday)
     */
    public function testLabourThanksgivingDayOnAfter1948SubstitutedNextWorkingDay()
    {
        $year = 1986;
        $this->assertHoliday(self::COUNTRY, self::SUBSTITUTE_PREFIX . self::HOLIDAY, $year,
            new DateTime("$year-11-24", new DateTimeZone(self::TIMEZONE)));
    }

    /**
     * Tests Labor Thanksgiving Day before 1948. Labor Thanksgiving Day is held on November 23rd and established since
     * 1948.
     */
    public function testLabourThanksgivingDayBefore1948()
    {
        $this->assertNotHoliday(self::COUNTRY, self::HOLIDAY,
            $this->generateRandomYear(1000, self::ESTABLISHMENT_YEAR - 1));
    }
}
