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
 * Class for testing Easter Monday in New Zealand.
 */
class EasterMondayTest extends NewZealandBaseTestCase
{
    /**
     * The name of the holiday
     */
    const HOLIDAY = 'easterMonday';

    /**
     * Tests Easter Monday
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
            [2757, '2757-04-01'],
            [1829, '1829-04-20'],
            [2413, '2413-04-22'],
            [2455, '2455-04-05'],
            [2668, '2668-04-20'],
            [2476, '2476-04-13'],
            [2848, '2848-04-13'],
            [2882, '2882-03-30'],
            [2530, '2530-04-17'],
            [2495, '2495-04-11'],
            [1972, '1972-04-03'],
            [2864, '2864-04-21'],
            [2135, '2135-04-04'],
            [1885, '1885-04-06'],
            [2797, '2797-04-07'],
            [2375, '2375-04-21'],
            [2695, '2695-03-25'],
            [1938, '1938-04-18'],
            [2963, '2963-04-04'],
            [2904, '2904-03-31'],
            [2474, '2474-04-09'],
            [2552, '2552-04-17'],
            [1817, '1817-04-07'],
            [2967, '2967-04-20'],
            [2890, '2890-04-03'],
            [2318, '2318-04-22'],
            [2325, '2325-04-06'],
            [2346, '2346-04-15'],
            [2398, '2398-04-06'],
            [2868, '2868-04-02'],
            [1908, '1908-04-20'],
            [2292, '2292-04-11'],
            [1845, '1845-03-24'],
            [2585, '2585-04-11'],
            [2749, '2749-03-28'],
            [2333, '2333-04-03'],
            [1841, '1841-04-12'],
            [2218, '2218-04-13'],
            [2031, '2031-04-14'],
            [2462, '2462-04-17'],
            [2134, '2134-04-12'],
            [2772, '2772-04-17'],
            [2454, '2454-04-20'],
            [2635, '2635-03-30'],
            [2889, '2889-04-11'],
            [2369, '2369-03-31'],
            [1941, '1941-04-14'],
            [2129, '2129-04-11'],
            [2684, '2684-03-31'],
            [2190, '2190-04-26'],
        ];
    }
}
