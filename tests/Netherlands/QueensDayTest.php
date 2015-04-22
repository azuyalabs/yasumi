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
namespace Yasumi\Tests\Netherlands;

use DateTime;
use DateTimeZone;

/**
 * Class for testing Queen's Day.
 */
class QueensDayTest extends NetherlandsBaseTestCase
{
    /**
     * The name of the holiday
     */
    const HOLIDAY = 'queensDay';

    /**
     * Tests Queens Day between 1891 and 1948.
     */
    public function testQueensBetween1891and1948()
    {
        $year = 1901;
        $this->assertHoliday(self::COUNTRY, self::HOLIDAY, $year,
            new DateTime("$year-8-31", new DateTimeZone(self::TIMEZONE)));

        // Substituted day (one day later)
        $year = 1947;
        $this->assertHoliday(self::COUNTRY, self::HOLIDAY, $year,
            new DateTime("$year-9-1", new DateTimeZone(self::TIMEZONE)));
    }

    /**
     * Tests Queens Day between 1949 and 2013.
     */
    public function testQueensBetween1949and2013()
    {
        $year = 1965;
        $this->assertHoliday(self::COUNTRY, self::HOLIDAY, $year,
            new DateTime("$year-4-30", new DateTimeZone(self::TIMEZONE)));

        // Substituted day (one day later)
        $year = 1967;
        $this->assertHoliday(self::COUNTRY, self::HOLIDAY, $year,
            new DateTime("$year-5-1", new DateTimeZone(self::TIMEZONE)));

        // Substituted day (one day earlier)
        $year = 2006;
        $this->assertHoliday(self::COUNTRY, self::HOLIDAY, $year,
            new DateTime("$year-4-29", new DateTimeZone(self::TIMEZONE)));
    }

    /**
     * Tests Queen's Day before 1891.
     */
    public function testQueensDayBefore1891()
    {
        $this->assertNotHoliday(self::COUNTRY, self::HOLIDAY, $this->generateRandomYear(1000, 1890));
    }

    /**
     * Tests Queen's Day after 2013.
     */
    public function testQueensDayAfter2013()
    {
        $this->assertNotHoliday(self::COUNTRY, self::HOLIDAY, $this->generateRandomYear(2014));
    }
}
