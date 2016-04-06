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
 * Class for testing New Years Day in the New Zealand.
 */
class NewYearsDayTest extends NewZealandBaseTestCase
{
    /**
     * The name of the holiday
     */
    const HOLIDAY = 'newYearsDay';

    /**
     * Tests New Years Day
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
            [2647, '2647-01-01'],
            [1923, '1923-01-01'],
            [2950, '2950-01-01'],
            [2984, '2984-01-01'],
            [2361, '2361-01-02'],
            [1863, '1863-01-01'],
            [1969, '1969-01-01'],
            [2602, '2602-01-01'],
            [2991, '2991-01-03'],
            [2607, '2607-01-01'],
            [2959, '2959-01-01'],
            [1891, '1891-01-01'],
            [2805, '2805-01-03'],
            [1966, '1966-01-03'],
            [1983, '1983-01-03'],
            [2721, '2721-01-03'],
            [2142, '2142-01-01'],
            [2736, '2736-01-01'],
            [2772, '2772-01-03'],
            [2862, '2862-01-02'],
            [2479, '2479-01-02'],
            [2372, '2372-01-03'],
            [1931, '1931-01-01'],
            [1835, '1835-01-01'],
            [2405, '2405-01-03'],
            [2090, '2090-01-02'],
            [2124, '2124-01-03'],
            [1825, '1825-01-03'],
            [2226, '2226-01-02'],
            [2326, '2326-01-01'],
            [1939, '1939-01-02'],
            [1987, '1987-01-01'],
            [2818, '2818-01-01'],
            [2923, '2923-01-01'],
            [2337, '2337-01-01'],
            [1973, '1973-01-01'],
            [1908, '1908-01-01'],
            [2178, '2178-01-01'],
            [2356, '2356-01-02'],
            [2013, '2013-01-01'],
            [1880, '1880-01-01'],
            [2515, '2515-01-01'],
            [2939, '2939-01-01'],
            [2574, '2574-01-03'],
            [2431, '2431-01-01'],
            [2754, '2754-01-01'],
            [2784, '2784-01-02'],
            [2682, '2682-01-02'],
            [2524, '2524-01-03'],
            [2003, '2003-01-01'],
        ];
    }
}
