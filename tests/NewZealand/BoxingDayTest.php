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
 * Class for testing Boxing Day in the New Zealand.
 */
class BoxingDayTest extends NewZealandBaseTestCase
{
    /**
     * The name of the holiday
     */
    const HOLIDAY = 'secondChristmasDay';

    /**
     * Tests Boxing Day
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
            [2448, '2448-12-28'],
            [2798, '2798-12-28'],
            [1929, '1929-12-26'],
            [2360, '2360-12-26'],
            [2929, '2929-12-26'],
            [1910, '1910-12-26'],
            [1867, '1867-12-26'],
            [2163, '2163-12-26'],
            [2782, '2782-12-28'],
            [2472, '2472-12-26'],
            [1952, '1952-12-26'],
            [2642, '2642-12-26'],
            [2606, '2606-12-26'],
            [2953, '2953-12-26'],
            [2748, '2748-12-28'],
            [2476, '2476-12-28'],
            [2354, '2354-12-28'],
            [2178, '2178-12-28'],
            [2476, '2476-12-28'],
            [2789, '2789-12-26'],
            [1843, '1843-12-26'],
            [2734, '2734-12-26'],
            [2866, '2866-12-28'],
            [1830, '1830-12-28'],
            [2724, '2724-12-26'],
            [2656, '2656-12-26'],
            [2184, '2184-12-28'],
            [2573, '2573-12-28'],
            [1809, '1809-12-26'],
            [1867, '1867-12-26'],
            [2113, '2113-12-26'],
            [2249, '2249-12-26'],
            [2631, '2631-12-26'],
            [2633, '2633-12-26'],
            [2448, '2448-12-28'],
            [1970, '1970-12-28'],
            [1855, '1855-12-26'],
            [2901, '2901-12-26'],
            [1942, '1942-12-28'],
            [2610, '2610-12-26'],
            [2568, '2568-12-26'],
            [2212, '2212-12-28'],
            [1833, '1833-12-26'],
            [2778, '2778-12-26'],
            [2393, '2393-12-28'],
            [2699, '2699-12-26'],
            [1992, '1992-12-28'],
            [2882, '2882-12-28'],
            [2324, '2324-12-26'],
        ];
    }
}
