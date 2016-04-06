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
 * Class for testing Christmas Day in the New Zealand.
 */
class ChristmasDayTest extends NewZealandBaseTestCase
{
    /**
     * The name of the holiday
     */
    const HOLIDAY = 'christmasDay';

    /**
     * Tests Christmas Day
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
            [1882, '1882-12-25'],
            [1924, '1924-12-25'],
            [2611, '2611-12-25'],
            [2690, '2690-12-25'],
            [1827, '1827-12-25'],
            [2417, '2417-12-25'],
            [2125, '2125-12-25'],
            [2135, '2135-12-27'],
            [2453, '2453-12-25'],
            [1818, '1818-12-25'],
            [2449, '2449-12-27'],
            [2190, '2190-12-27'],
            [2425, '2425-12-25'],
            [2695, '2695-12-25'],
            [2667, '2667-12-25'],
            [2548, '2548-12-25'],
            [2064, '2064-12-25'],
            [2490, '2490-12-25'],
            [1997, '1997-12-25'],
            [2008, '2008-12-25'],
            [2369, '2369-12-25'],
            [2999, '2999-12-25'],
            [2514, '2514-12-25'],
            [2099, '2099-12-25'],
            [3000, '3000-12-25'],
            [2354, '2354-12-27'],
            [2825, '2825-12-25'],
            [2874, '2874-12-25'],
            [2345, '2345-12-25'],
            [2639, '2639-12-25'],
            [2074, '2074-12-25'],
            [2016, '2016-12-27'],
            [2258, '2258-12-27'],
            [1887, '1887-12-27'],
            [2949, '2949-12-25'],
            [2047, '2047-12-25'],
            [2364, '2364-12-25'],
            [2331, '2331-12-25'],
            [2445, '2445-12-25'],
            [2276, '2276-12-25'],
            [2796, '2796-12-25'],
            [2631, '2631-12-27'],
            [2585, '2585-12-27'],
            [2099, '2099-12-25'],
            [2622, '2622-12-25'],
            [2510, '2510-12-25'],
            [2248, '2248-12-25'],
            [2784, '2784-12-25'],
            [2533, '2533-12-25'],
        ];
    }
}
