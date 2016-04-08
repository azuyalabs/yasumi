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

namespace Yasumi\tests\NewZealand;

use DateTime;
use DateTimeZone;
use DateInterval;

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
        $data = [];

        for ($y = 0; $y < 50; $y ++) {
            $year = $this->generateRandomYear(1800, 3000);
            $date = new DateTime("$year-3-21", new DateTimeZone(self::TIMEZONE));
            $date->add(new DateInterval('P' . (easter_days($year)+1) . 'D'));

            $data[] = [$year, $date->format('Y-m-d')];
        }

        return $data;
    }
}
