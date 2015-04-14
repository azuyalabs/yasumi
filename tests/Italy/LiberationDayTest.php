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
namespace Yasumi\Tests\Italy;

use DateTime;
use DateTimeZone;

/**
 * Class containing tests for Liberation Day in Italy.
 *
 * Italy's Liberation Day (Festa della Liberazione), also known as the Anniversary of the Liberation
 * (Anniversario della liberazione d'Italia), Anniversary of the Resistance (anniversario della Resistenza), or simply
 * April 25 is a national Italian holiday commemorating the end of the second world war and the end of Nazi occupation
 * of the country. On May 27, 1949, bill 260 made the anniversary a permanent, annual national holiday.
 *
 * @link http://en.wikipedia.org/wiki/Liberation_Day_%28Italy%29 Source: Wikipedia.
 */
class LiberationDayTest extends ItalyBaseTestCase
{
    /**
     * The name of the holiday
     */
    const HOLIDAY = 'liberationDay';

    /**
     * Tests Liberation Day on or after 1949.
     */
    public function testLiberationDayOnAfter1949()
    {
        $year = $this->generateRandomYear(1949);
        $this->assertHoliday(self::COUNTRY, self::HOLIDAY, $year,
            new DateTime("$year-4-25", new DateTimeZone(self::TIMEZONE)));
    }

    /**
     * Tests Liberation Day before 1949.
     */
    public function testLiberationDayBefore1949()
    {
        $this->assertNotHoliday(self::COUNTRY, self::HOLIDAY, $this->generateRandomYear(1000, 1948));
    }

    /**
     * Tests translated name of Liberation Day.
     */
    public function testTranslatedLiberationDay()
    {
        $this->assertTranslatedHolidayName(self::COUNTRY, self::HOLIDAY, $this->generateRandomYear(1949),
            ['it_IT' => 'Festa della Liberazione']);
    }
}
