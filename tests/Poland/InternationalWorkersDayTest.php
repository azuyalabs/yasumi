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

namespace Yasumi\tests\Poland;

use DateTime;

/**
 * Class containing tests for International Workers' Day (i.e. Labour Day) in Poland.
 */
class InternationalWorkersDayTest extends PolandBaseTestCase
{
    /**
     * The name of the holiday
     */
    const HOLIDAY = 'internationalWorkersDay';

    /**
     * Tests International Workers' Day.
     *
     * @dataProvider InternationalWorkersDayDataProvider
     *
     * @param int      $year     the year for which International Workers' Day needs to be tested
     * @param DateTime $expected the expected date
     */
    public function testInternationalWorkersDay($year, $expected)
    {
        $this->assertHoliday(self::REGION, self::HOLIDAY, $year, $expected);
    }

    /**
     * Tests translated name of International Workers' Day.
     */
    public function testTranslatedInternationalWorkersDay()
    {
        $this->assertTranslatedHolidayName(self::REGION, self::HOLIDAY, $this->generateRandomYear(),
            ['pl_PL' => 'Święto Pracy']);
    }

    /**
     * Returns a list of random test dates used for assertion of International Workers' Day.
     *
     * @return array list of test dates for International Workers' Day
     */
    public function InternationalWorkersDayDataProvider()
    {
        return $this->generateRandomDates(5, 1, self::TIMEZONE);
    }
}
