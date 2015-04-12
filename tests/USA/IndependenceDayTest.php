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
 * Class to test Independence Day.
 *
 * Independence Day, commonly known as the Fourth of July or July Fourth, is a federal holiday in the United States
 * commemorating the adoption of the Declaration of Independence on July 4, 1776, declaring independence from Great
 * Britain. In case Independence Day falls on a Sunday, a substituted holiday is observed the following Monday. If it
 * falls on a Saturday, a substituted holiday is observed the previous Friday.
 *
 * @link http://en.wikipedia.org/wiki/Independence_Day_(United_States) Source: Wikipedia.
 */
class IndependenceDayTest extends USABaseTestCase
{
    /**
     * The name of the holiday
     */
    const HOLIDAY = 'independenceDay';

    /**
     * Tests Independence Day on or after 1776. Independence Day is celebrated since 1776 on July 4th.
     */
    public function testIndependenceDayOnAfter1776()
    {
        $year = 1955;
        $this->assertHoliday(self::COUNTRY, self::HOLIDAY, $year,
            new DateTime("$year-7-4", new DateTimeZone(self::TIMEZONE)));

        // Substituted Holiday on Monday (Independence Day falls on Sunday)
        $year = 3362;
        $this->assertHoliday(self::COUNTRY, 'substituteHoliday:independenceDay', $year,
            new DateTime("$year-7-5", new DateTimeZone(self::TIMEZONE)));

        // Substituted Holiday on Friday (Independence Day falls on Saturday)
        $year = 8291;
        $this->assertHoliday(self::COUNTRY, 'substituteHoliday:independenceDay', $year,
            new DateTime("$year-7-3", new DateTimeZone(self::TIMEZONE)));
    }

    /**
     * Tests Independence Day before 1776. Independence Day is celebrated since 1776 on July 4th.
     */
    public function testIndependenceDayBefore1776()
    {
        $this->assertNotHoliday(self::COUNTRY, self::HOLIDAY, $this->generateRandomYear(1000, 1775));
    }
}
