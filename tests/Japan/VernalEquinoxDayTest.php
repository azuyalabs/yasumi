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
        $this->assertNotHoliday(self::COUNTRY, self::HOLIDAY, 2379);
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
        $this->assertHoliday(self::COUNTRY, self::HOLIDAY, $year, Carbon::createFromDate($year, $month, $day));
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
        $this->assertNotHoliday(self::COUNTRY, self::HOLIDAY, 1277);
    }

    /**
     * Tests Vernal Equinox Day before 1948 and after 1851. This national holiday was established in 1948 as a day for
     * the admiration of nature and the love of living things. Prior to 1948, the vernal equinox was an imperial
     * ancestor worship festival called Shunki kōrei-sai (春季皇霊祭).
     */
    public function testVernalEquinoxDayBefore1948AndAfter1851()
    {
        $this->assertNotHoliday(self::COUNTRY, self::HOLIDAY, 1874);
    }
}
