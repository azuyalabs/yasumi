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

namespace Yasumi\tests\Japan;

use DateTime;
use DateTimeZone;

/**
 * Class for testing New Years Day in Japan.
 */
class NewYearsDayTest extends JapanBaseTestCase
{
    /**
     * The name of the holiday
     */
    const HOLIDAY = 'newYearsDay';

    /**
     * The year in which the holiday was first established
     */
    const ESTABLISHMENT_YEAR = 1948;

    /**
     * Tests New Years Day after 1948. New Years Day was established after 1948
     */
    public function testNewYearsDayOnAfter1948()
    {
        $year = 1997;
        $this->assertHoliday(self::REGION, self::HOLIDAY, $year,
            new DateTime("$year-1-1", new DateTimeZone(self::TIMEZONE)));
    }

    /**
     * Tests New Years Day after 1948 substituted next working day (when New Years Day falls on a Sunday)
     */
    public function testNewYearsDayOnAfter1948SubstitutedNextWorkingDay()
    {
        $year = 4473;
        $this->assertHoliday(self::REGION, self::SUBSTITUTE_PREFIX . self::HOLIDAY, $year,
            new DateTime("$year-1-2", new DateTimeZone(self::TIMEZONE)));
    }

    /**
     * Tests New Years Day before 1948. New Years Day was established after 1948
     */
    public function testNewYearsDayBefore1948()
    {
        $this->assertNotHoliday(self::REGION, self::HOLIDAY,
            $this->generateRandomYear(1000, self::ESTABLISHMENT_YEAR - 1));
    }
}
