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
 * Class for testing New Years Day in the USA.
 */
class ChristmasDayTest extends USABaseTestCase
{
    /**
     * The name of the holiday
     */
    const HOLIDAY = 'christmasDay';

    /**
     * Tests Christmas Day. Christmas Day is celebrated on December 25th.
     */
    public function testChristmasDay()
    {
        $year = 2001;
        $this->assertHoliday(self::COUNTRY, self::HOLIDAY, $year,
            new DateTime("$year-12-25", new DateTimeZone(self::TIMEZONE)));
    }

    /**
     * Tests Christmas Day substituted on Monday (when Christmas Day falls on Sunday).
     */
    public function testChristmasDaySubstitutedMonday()
    {
        // Substituted Holiday on Monday (Christmas Day falls on Sunday)
        $year = 6101;
        $this->assertHoliday(self::COUNTRY, 'substituteHoliday:christmasDay', $year,
            new DateTime("$year-12-26", new DateTimeZone(self::TIMEZONE)));
    }

    /**
     * Tests Christmas Day substituted on Monday (when Christmas Day falls on Saturday).
     */
    public function testChristmasDaySubstitutedFriday()
    {
        // Substituted Holiday on Friday (Christmas Day falls on Saturday)
        $year = 2060;
        $this->assertHoliday(self::COUNTRY, 'substituteHoliday:christmasDay', $year,
            new DateTime("$year-12-24", new DateTimeZone(self::TIMEZONE)));
    }

    /**
     * Tests translated name of Christmas Day.
     */
    public function testTranslation()
    {
        $this->assertTranslatedHolidayName(self::COUNTRY, self::HOLIDAY, $this->generateRandomYear(),
            ['en_US' => 'Christmas']);
    }
}
