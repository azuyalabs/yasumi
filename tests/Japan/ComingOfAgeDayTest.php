<?php
/*
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Yasumi\Tests\Japan;

use DateTime;
use DateTimeZone;

/**
 * Class ComingOfAgeDayTest.
 */
class ComingOfAgeDayTest extends JapanBaseTestCase
{
    /**
     * The name of the holiday
     */
    const HOLIDAY = 'comingOfAgeDay';

    /**
     * Tests Coming of Age Day after 2000. Coming of Age Day was established after 1948 on January 15th. After 2000 it
     * was changed to be the second monday of January.
     */
    public function testComingOfAgeDayOnAfter2000()
    {
        $year = $this->generateRandomYear(2001);
        $this->assertHoliday(self::COUNTRY, self::HOLIDAY, $year,
            new DateTime("second monday of january $year", new DateTimeZone(self::TIMEZONE)));
    }


    /**
     * Tests Coming of Age Day between 1948 and 2000. Coming of Age Day was established after 1948 on January 15th.
     * After 2000 it was changed to be the second monday of January.
     */
    public function testComingOfAgeDayBetween1948And2000()
    {
        $year = 1991;
        $this->assertHoliday(self::COUNTRY, self::HOLIDAY, $year,
            new DateTime("$year-1-15", new DateTimeZone(self::TIMEZONE)));
    }

    /**
     * Tests Coming of Age Day before 1948. Coming of Age Day was established after 1948 on January 15th. After 2000 it
     * was changed to be the second monday of January.
     */
    public function testConstitutionMemorialDayBefore1948()
    {
        $this->assertNotHoliday(self::COUNTRY, self::HOLIDAY, $this->generateRandomYear(1000, 1947));
    }
}
