<?php
/*
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Yasumi\Tests\USA;

use DateTime;
use DateTimeZone;

/**
 * Class for testing New Years Day in the USA.
 *
 * Christmas or Christmas Day (Old English: Crīstesmæsse, meaning "Christ's Mass") is an annual festival commemorating
 * the birth of Jesus Christ, observed most commonly on December 25 as a religious and cultural celebration among
 * billions of people around the world.
 *
 * @link http://en.wikipedia.org/wiki/Christmas Source: Wikipedia.
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

        // Substituted Holiday on Monday (Christmas Day falls on Sunday)
        $year = 6101;
        $this->assertHoliday(self::COUNTRY, 'substituteHoliday:christmasDay', $year,
            new DateTime("$year-12-26", new DateTimeZone(self::TIMEZONE)));

        // Substituted Holiday on Friday (Christmas Day falls on Saturday)
        $year = 2060;
        $this->assertHoliday(self::COUNTRY, 'substituteHoliday:christmasDay', $year,
            new DateTime("$year-12-24", new DateTimeZone(self::TIMEZONE)));
    }
}
