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
 * Class for testing National Foundation Day in Japan.
 */
class NationalFoundationDayTest extends JapanBaseTestCase
{
    /**
     * The name of the holiday
     */
    const HOLIDAY = 'nationalFoundationDay';

    /**
     * The year in which the holiday was first established
     */
    const ESTABLISHMENT_YEAR = 1966;

    /**
     * Tests National Foundation Day after 1966. National Foundation day was established after 1966
     */
    public function testNationalFoundationDayOnAfter1966()
    {
        $year = 1972;
        $this->assertHoliday(self::COUNTRY, self::HOLIDAY, $year,
            new DateTime("$year-2-11", new DateTimeZone(self::TIMEZONE)));
    }

    /**
     * Tests National Foundation Day after 1966. substituted next working day (when National Foundation Day falls on a
     * Sunday)
     */
    public function testNationalFoundationDayOnAfter1966SubstitutedNextWorkingDay()
    {
        $year = 2046;
        $this->assertHoliday(self::COUNTRY, self::SUBSTITUTE_PREFIX . self::HOLIDAY, $year,
            new DateTime("$year-2-12", new DateTimeZone(self::TIMEZONE)));
    }

    /**
     * Tests National Foundation Day before 1966. National Foundation day was established after 1966
     */
    public function testNationalFoundationDayBefore1966()
    {
        $this->assertNotHoliday(self::COUNTRY, self::HOLIDAY,
            $this->generateRandomYear(1000, self::ESTABLISHMENT_YEAR - 1));
    }
}
