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

use Carbon\Carbon;

/**
 * Class AutumnalEquinoxDayTest.
 */
class AutumnalEquinoxDayTest extends JapanBaseTestCase
{
    /**
     * The name of the holiday
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
        $this->assertNotHoliday(self::COUNTRY, self::HOLIDAY, 4987);
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
        $this->assertHoliday(self::COUNTRY, self::HOLIDAY, $year, Carbon::createFromDate($year, $month, $day));
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
        $this->assertNotHoliday(self::COUNTRY, self::HOLIDAY, 699);
    }

    /**
     * Tests Vernal Equinox Day before 1948 and after 1851. This national holiday was established in 1948 as a day on
     * which to honor one's ancestors and remember the dead. Prior to 1948, the autumnal equinox was an imperial
     * ancestor worship festival called Shūki kōrei-sai (秋季皇霊祭).
     */
    public function testAutumnalEquinoxDayBefore1948AndAfter1851()
    {
        $this->assertNotHoliday(self::COUNTRY, self::HOLIDAY, 1888);
    }
}
