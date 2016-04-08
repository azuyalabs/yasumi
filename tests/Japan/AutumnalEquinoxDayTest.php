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
 * Class for testing Autumnal Equinox Day in Japan.
 */
class AutumnalEquinoxDayTest extends JapanBaseTestCase
{
    /**
     * The name of the holiday.
     */
    const HOLIDAY = 'autumnalEquinoxDay';

    /**
     * Tests Vernal Equinox Day after 2150. This national holiday was established in 1948 as a day on which to honor
     * one's ancestors and remember the dead. Prior to 1948, the autumnal equinox was an imperial ancestor worship
     * festival called Shūki kōrei-sai (秋季皇霊祭).
     *
     * After 2150 no calculations are available yet.
     */
    public function testAutumnalEquinoxDayOnAfter2150()
    {
        $this->assertNotHoliday(self::REGION, self::HOLIDAY, $this->generateRandomYear(2151));
    }

    /**
     * Tests Vernal Equinox Day between 1948 and 2150. This national holiday was established in 1948 as a day on which
     * to honor one's ancestors and remember the dead. Prior to 1948, the autumnal equinox was an imperial ancestor
     * worship festival called Shūki kōrei-sai (秋季皇霊祭).
     *
     * After 2150 no calculations are available yet.
     *
     * @dataProvider autumnalEquinoxHolidaysProvider
     *
     * @param $year  int year of example data to be tested
     * @param $month int month (number) of example data to be tested
     * @param $day   int day of the month (number) of example data to be tested
     */
    public function testAutumnalEquinoxDayBetween1948And2150($year, $month, $day)
    {
        $this->assertHoliday(self::REGION, self::HOLIDAY, $year,
            new DateTime("$year-$month-$day", new DateTimeZone(self::TIMEZONE)));
    }

    /**
     * Returns a list of all Japanese Autumnal Equinox holidays used for assertions.
     *
     * @return array list of Japanese Autumnal Equinox holidays
     */
    public function autumnalEquinoxHolidaysProvider()
    {
        return [
            [1951, 9, 24],
            [1999, 9, 23],
            [2013, 9, 23],
            [2016, 9, 22],
            [2122, 9, 23],
        ];
    }

    /**
     * Tests Vernal Equinox Day before 1948. This national holiday was established in 1948 as a day on which to honor
     * one's ancestors and remember the dead. Prior to 1948, the autumnal equinox was an imperial ancestor worship
     * festival called Shūki kōrei-sai (秋季皇霊祭).
     */
    public function testAutumnalEquinoxDayBefore1948()
    {
        $this->assertNotHoliday(self::REGION, self::HOLIDAY, $this->generateRandomYear(1000, 1947));
    }

    /**
     * Tests Vernal Equinox Day between 1851 and 1948. This national holiday was established in 1948 as a day on
     * which to honor one's ancestors and remember the dead. Prior to 1948, the autumnal equinox was an imperial
     * ancestor worship festival called Shūki kōrei-sai (秋季皇霊祭).
     */
    public function testAutumnalEquinoxDayBetween1851And1948()
    {
        $this->assertNotHoliday(self::REGION, self::HOLIDAY, $this->generateRandomYear(1851, 1947));
    }
}
