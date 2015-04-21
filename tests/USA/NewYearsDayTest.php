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

    /**
     * Tests translated name of New Years Day.
     */
    public function testTranslation()
    {
        $this->assertTranslatedHolidayName(self::COUNTRY, self::HOLIDAY, $this->generateRandomYear(),
            ['en_US' => 'New Year\'s Day']);
    }
}
