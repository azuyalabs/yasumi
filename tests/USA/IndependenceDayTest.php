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
namespace Yasumi\Tests\USA;

use DateTime;
use DateTimeZone;

/**
 * Class to test Independence Day.
 */
class IndependenceDayTest extends USABaseTestCase
{
    /**
     * The name of the holiday
     */
    const HOLIDAY = 'independenceDay';

    /**
     * The year in which the holiday was first established
     */
    const ESTABLISHMENT_YEAR = 1776;

    /**
     * Tests Independence Day on or after 1776. Independence Day is celebrated since 1776 on July 4th.
     */
    public function testIndependenceDayOnAfter1776()
    {
        $year = 1955;
        $this->assertHoliday(self::COUNTRY, self::HOLIDAY, $year,
            new DateTime("$year-7-4", new DateTimeZone(self::TIMEZONE)));
    }

    /**
     * Tests Independence Day on or after 1776 when substituted on Monday (when Independence Day falls on Sunday)
     */
    public function testIndependenceDayOnAfter1776SubstitutedMonday()
    {
        $year = 3362;
        $this->assertHoliday(self::COUNTRY, 'substituteHoliday:independenceDay', $year,
            new DateTime("$year-7-5", new DateTimeZone(self::TIMEZONE)));
    }

    /**
     * Tests Independence Day on or after 1776 when substituted on Friday (when Independence Day falls on Saturday)
     */
    public function testIndependenceDayOnAfter1776SubstitutedFriday()
    {
        $year = 8291;
        $this->assertHoliday(self::COUNTRY, 'substituteHoliday:independenceDay', $year,
            new DateTime("$year-7-3", new DateTimeZone(self::TIMEZONE)));
    }

    /**
     * Tests Independence Day before 1776. Independence Day is celebrated since 1776 on July 4th.
     */
    public function testIndependenceDayBefore1776()
    {
        $this->assertNotHoliday(self::COUNTRY, self::HOLIDAY,
            $this->generateRandomYear(1000, self::ESTABLISHMENT_YEAR - 1));
    }

    /**
     * Tests translated name of Independence Day.
     */
    public function testTranslation()
    {
        $this->assertTranslatedHolidayName(self::COUNTRY, self::HOLIDAY,
            $this->generateRandomYear(self::ESTABLISHMENT_YEAR), ['en_US' => 'Independence Day']);
    }
}
