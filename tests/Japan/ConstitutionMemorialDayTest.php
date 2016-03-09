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
 * Class for teting Constitution Memorial Day in Japan.
 */
class ConstitutionMemorialDayTest extends JapanBaseTestCase
{
    /**
     * The name of the holiday
     */
    const HOLIDAY = 'constitutionMemorialDay';

    /**
     * The year in which the holiday was first established
     */
    const ESTABLISHMENT_YEAR = 1948;

    /**
     * Tests Constitution Memorial Day after 1948. Constitution Memorial Day was established after 1948
     */
    public function testConstitutionMemorialDayOnAfter1948()
    {
        $year = 1967;
        $this->assertHoliday(self::COUNTRY, self::HOLIDAY, $year,
            new DateTime("$year-5-3", new DateTimeZone(self::TIMEZONE)));
    }

    /**
     * Tests Constitution Memorial Day after 1948 substituted next working day (when Constitution Memorial Day falls on
     * a Sunday)
     */
    public function testConstitutionMemorialDayOnAfter1948SubstitutedNextWorkingDay()
    {
        $year = 2009;
        $this->assertHoliday(self::COUNTRY, self::SUBSTITUTE_PREFIX . self::HOLIDAY, $year,
            new DateTime("$year-5-6", new DateTimeZone(self::TIMEZONE)));
    }

    /**
     * Tests Constitution Memorial Day before 1948. Constitution Memorial Day was established after 1948
     */
    public function testConstitutionMemorialDayBefore1948()
    {
        $this->assertNotHoliday(self::COUNTRY, self::HOLIDAY,
            $this->generateRandomYear(1000, self::ESTABLISHMENT_YEAR - 1));
    }
}
