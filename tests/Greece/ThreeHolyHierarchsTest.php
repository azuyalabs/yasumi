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
use DateTimeZone;

/**
 * Class containing tests for The Three Holy Hierarchs in Greece.
 */
class ThreeHolyHierarchsTest extends GreeceBaseTestCase
{
    /**
     * The name of the holiday
     */
    const HOLIDAY = 'threeHolyHierarchs';

    /**
    * Tests The Three Holy Hierarchs.
    *
    * @dataProvider ThreeHolyHierarchsDataProvider
    *
    * @param int      $year     the year for which The Three Holy Hierarchs needs to be tested
    * @param DateTime $expected the expected date
     */
    public function testThreeHolyHierarchs($year, $expected)
    {
        $this->assertHoliday(self::REGION, self::HOLIDAY, $year, $expected);
    }

    /**
    * Returns a list of random test dates used for assertion of The Three Holy Hierarchs.
    *
    * @return array list of test dates for The Three Holy Hierarchs
     */
    public function ThreeHolyHierarchsDataProvider()
    {
        return $this->generateRandomDates(1, 30, self::TIMEZONE);
    }

    /**
     * Tests translated name of The Three Holy Hierarchs.
     */
    public function testTranslation()
    {
        $this->assertTranslatedHolidayName(self::REGION, self::HOLIDAY,
            $this->generateRandomYear(), ['el_GR' => 'Τριών Ιεραρχών']);
    }
}
