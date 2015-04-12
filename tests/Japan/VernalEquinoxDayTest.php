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
namespace Yasumi\Tests\Japan;

use DateTime;
use DateTimeZone;

/**
 * Class VernalEquinoxDayTest.
 */
class VernalEquinoxDayTest extends JapanBaseTestCase
{
    /**
     * The name of the holiday
     */
    const HOLIDAY = 'vernalEquinoxDay';

    /**
     * Tests Vernal Equinox Day after 2150. This national holiday was established in 1948 as a day for the admiration
     * of nature and the love of living things. Prior to 1948, the vernal equinox was an imperial ancestor worship
     * festival called Shunki kōrei-sai (春季皇霊祭).
     *
     * After 2150 no calculations are available yet.
     */
    public function testVernalEquinoxDayOnAfter2150()
    {
        $this->assertNotHoliday(self::COUNTRY, self::HOLIDAY, $this->generateRandomYear(2151));
    }

    /**
     * Tests Vernal Equinox Day between 1948 and 2150. This national holiday was established in 1948 as a day for the
     * admiration of nature and the love of living things. Prior to 1948, the vernal equinox was an imperial ancestor
     * worship festival called Shunki kōrei-sai (春季皇霊祭).
     *
     * After 2150 no calculations are available yet.
     *
     * @dataProvider vernalEquinoxHolidaysProvider
     *
     * @param $year  int year of example data to be tested
     * @param $month int month (number) of example data to be tested
     * @param $day   int day of the month (number) of example data to be tested
     */
    public function testVernalEquinoxDayBetween1948And2150($year, $month, $day)
    {
        $this->assertHoliday(self::COUNTRY, self::HOLIDAY, $year,
            new DateTime("$year-$month-$day", new DateTimeZone(self::TIMEZONE)));
    }


    /**
     * Returns a list of all Japanese Vernal Equinox holidays used for assertions.
     *
     * @return array list of Japanese Vernal Equinox holidays
     */
    public function vernalEquinoxHolidaysProvider()
    {
        return [
            [1948, 3, 22],
            [2013, 3, 20],
            [2016, 3, 20],
            [2025, 3, 20],
            [2143, 3, 21],
        ];
    }

    /**
     * Tests Vernal Equinox Day before 1948. This national holiday was established in 1948 as a day for the admiration
     * of nature and the love of living things. Prior to 1948, the vernal equinox was an imperial ancestor worship
     * festival called Shunki kōrei-sai (春季皇霊祭).
     */
    public function testVernalEquinoxDayBefore1948()
    {
        $this->assertNotHoliday(self::COUNTRY, self::HOLIDAY, $this->generateRandomYear(1000, 1947));
    }

    /**
     * Tests Vernal Equinox Day between 1851 and 1948. This national holiday was established in 1948 as a day for
     * the admiration of nature and the love of living things. Prior to 1948, the vernal equinox was an imperial
     * ancestor worship festival called Shunki kōrei-sai (春季皇霊祭).
     */
    public function testVernalEquinoxDayBetween1851And1948()
    {
        $this->assertNotHoliday(self::COUNTRY, self::HOLIDAY, $this->generateRandomYear(1851, 1947));
    }
}
