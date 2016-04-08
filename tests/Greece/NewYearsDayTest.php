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

namespace Yasumi\tests\Greece;

use DateTime;

/**
 * Class containing tests for New Years Day in France.
 */
class NewYearsDayTest extends GreeceBaseTestCase
{
    /**
     * The name of the holiday
     */
    const HOLIDAY = 'newYearsDay';

    /**
     * Tests New Years Day.
     *
     * @dataProvider NewYearsDayDataProvider
     *
     * @param int      $year     the year for which New Years Day needs to be tested
     * @param DateTime $expected the expected date
     */
    public function testNewYearsDay($year, $expected)
    {
        $this->assertHoliday(self::REGION, self::HOLIDAY, $year, $expected);
    }

    /**
     * Tests translated name of New Years Day.
     */
    public function testTranslation()
    {
        $this->assertTranslatedHolidayName(self::REGION, self::HOLIDAY, $this->generateRandomYear(),
            ['el_GR' => 'Πρωτοχρονιά']);
    }

    /**
     * Returns a list of random test dates used for assertion of New Years Day.
     *
     * @return array list of test dates for New Years Day
     */
    public function NewYearsDayDataProvider()
    {
        return $this->generateRandomDates(1, 1, self::TIMEZONE);
    }
}
