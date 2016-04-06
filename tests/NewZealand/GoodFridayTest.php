<?php
/**
 *  This file is part of the Yasumi package.
 *
 *  Copyright (c) 2015 - 2016 AzuyaLabs
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <stelgenhof@gmail.com>
 */

namespace Yasumi\Tests\NewZealand;

use DateTime;
use DateTimeZone;

/**
 * Class for testing Good Friday in New Zealand.
 */
class GoodFridayTest extends NewZealandBaseTestCase
{
    /**
     * The name of the holiday
     */
    const HOLIDAY = 'goodFriday';

    /**
     * Tests Good Friday
     *
     * @dataProvider HolidayDataProvider
     *
     * @param int $year the year for which the holiday defined in this test needs to be tested
     * @param string $expected the expected date
     */
    public function testHoliday($year, $expected)
    {
        $this->assertHoliday(self::REGION, self::HOLIDAY, $year,
            new DateTime($expected, new DateTimeZone(self::TIMEZONE)));
    }

    /**
     * Returns a list of test dates
     *
     * @return array list of test dates for the holiday defined in this test
     */
    public function HolidayDataProvider()
    {
        return [
            [2096, '2096-04-13'],
            [2482, '2482-04-03'],
            [2971, '2971-04-05'],
            [2024, '2024-03-29'],
            [2244, '2244-03-29'],
            [1832, '1832-04-20'],
            [2415, '2415-03-27'],
            [2107, '2107-04-08'],
            [2440, '2440-04-20'],
            [2420, '2420-04-03'],
            [2803, '2803-03-28'],
            [2932, '2932-04-11'],
            [2437, '2437-03-20'],
            [2275, '2275-04-16'],
            [2228, '2228-03-21'],
            [2440, '2440-04-20'],
            [2489, '2489-04-15'],
            [2902, '2902-04-14'],
            [2592, '2592-04-20'],
            [2734, '2734-04-13'],
            [1867, '1867-04-19'],
            [2145, '2145-04-09'],
            [2300, '2300-04-06'],
            [1809, '1809-03-31'],
            [1998, '1998-04-10'],
            [1873, '1873-04-11'],
            [2500, '2500-04-16'],
            [2003, '2003-04-18'],
            [2749, '2749-03-25'],
            [1984, '1984-04-20'],
            [2405, '2405-04-15'],
            [2026, '2026-04-03'],
            [2638, '2638-03-23'],
            [2275, '2275-04-16'],
            [2800, '2800-03-31'],
            [1915, '1915-04-02'],
            [1814, '1814-04-08'],
            [1883, '1883-03-23'],
            [1856, '1856-03-21'],
            [2704, '2704-04-15'],
            [2169, '2169-04-14'],
            [2552, '2552-04-14'],
            [2082, '2082-04-17'],
            [2907, '2907-04-22'],
            [2268, '2268-04-03'],
            [2900, '2900-04-09'],
            [2027, '2027-03-26'],
            [2915, '2915-03-22'],
            [2885, '2885-03-23'],
            [2199, '2199-04-12'],
        ];
    }
}
