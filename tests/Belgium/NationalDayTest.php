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

namespace Yasumi\Tests\Belgium;

use DateTime;

/**
 * Class for testing the National Day of Belgium.
 */
class NationalDayTest extends BelgiumBaseTestCase
{
    /**
     * The name of the holiday to be tested
     */
    const HOLIDAY = 'nationalDay';

    /**
     * Tests National Day.
     *
     * @dataProvider NationalDayDataProvider
     *
     * @param int      $year     the year for which National Day needs to be tested
     * @param DateTime $expected the expected date
     */
    public function testNationalDay($year, $expected)
    {
        $this->assertHoliday(self::REGION, self::HOLIDAY, $year, $expected);
    }

    /**
     * Returns a list of random test dates used for assertion of National Day.
     *
     * @return array list of test dates for National Day
     */
    public function NationalDayDataProvider()
    {
        return $this->generateRandomDates(7, 21, self::TIMEZONE);
    }

    /**
     * Tests translated name of National Day
     */
    public function testTranslation()
    {
        $this->assertTranslatedHolidayName(self::REGION, self::HOLIDAY, $this->generateRandomYear(),
            ['nl_BE' => 'Nationale feestdag']);
    }
}
