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
 * Class for testing Day After New Years Day in the New Zealand.
 */
class DayAfterNewYearsDayTest extends NewZealandBaseTestCase
{
    /**
     * The name of the holiday
     */
    const HOLIDAY = 'dayAfterNewYearsDay';

    /**
     * Tests Day After New Years Day
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
            [2114, '2114-01-02'],
            [1923, '1923-01-02'],
            [2210, '2210-01-02'],
            [2191, '2191-01-04'],
            [2087, '2087-01-02'],
            [1800, '1800-01-02'],
            [2936, '2936-01-03'],
            [2607, '2607-01-02'],
            [2476, '2476-01-02'],
            [1806, '1806-01-02'],
            [2036, '2036-01-02'],
            [2043, '2043-01-02'],
            [2103, '2103-01-02'],
            [2062, '2062-01-03'],
            [2556, '2556-01-02'],
            [2217, '2217-01-02'],
            [2262, '2262-01-02'],
            [2840, '2840-01-03'],
            [2975, '2975-01-03'],
            [1883, '1883-01-02'],
            [1868, '1868-01-02'],
            [2748, '2748-01-02'],
            [2390, '2390-01-02'],
            [2645, '2645-01-02'],
            [2201, '2201-01-02'],
            [2727, '2727-01-04'],
            [2699, '2699-01-03'],
            [2258, '2258-01-04'],
            [2713, '2713-01-02'],
            [2499, '2499-01-02'],
            [2670, '2670-01-04'],
            [2328, '2328-01-03'],
            [1960, '1960-01-04'],
            [2489, '2489-01-04'],
            [2907, '2907-01-04'],
            [2960, '2960-01-02'],
            [1899, '1899-01-03'],
            [1997, '1997-01-02'],
            [2671, '2671-01-03'],
            [2851, '2851-01-03'],
            [2329, '2329-01-02'],
            [2598, '2598-01-02'],
            [2682, '2682-01-03'],
            [2135, '2135-01-04'],
            [2313, '2313-01-02'],
            [2692, '2692-01-04'],
            [2596, '2596-01-04'],
            [2024, '2024-01-02'],
            [2854, '2854-01-02'],
        ];
    }
}
