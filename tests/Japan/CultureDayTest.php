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
 * Class for testing Culture Day in Japan.
 */
class CultureDayTest extends JapanBaseTestCase
{
    /**
     * The name of the holiday
     */
    const HOLIDAY = 'cultureDay';

    /**
     * The year in which the holiday was first established
     */
    const ESTABLISHMENT_YEAR = 1948;

    /**
     * Tests Culture Day after 1948. Culture Day Day was established after 1948
     */
    public function testCultureDayOnAfter1948()
    {
        $year = 1973;
        $this->assertHoliday(self::REGION, self::HOLIDAY, $year,
            new DateTime("$year-11-3", new DateTimeZone(self::TIMEZONE)));
    }

    /**
     * Tests Culture Day after 1948 substituted next working day (when Culture Day falls on a Sunday)
     */
    public function testCultureDayOnAfter1948SubstitutedNextWorkingDay()
    {
        $year = 2661;
        $this->assertHoliday(self::REGION, self::SUBSTITUTE_PREFIX . self::HOLIDAY, $year,
            new DateTime("$year-11-4", new DateTimeZone(self::TIMEZONE)));
    }

    /**
     * Tests Culture Day before 1948. Culture Day was established after 1948
     */
    public function testCultureDayBefore1948()
    {
        $this->assertNotHoliday(self::REGION, self::HOLIDAY,
            $this->generateRandomYear(1000, self::ESTABLISHMENT_YEAR - 1));
    }
}
