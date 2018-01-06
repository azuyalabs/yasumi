<?php
/**
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 - 2018 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <stelgenhof@gmail.com>
 */

namespace Yasumi\tests\CzechRepublic;

use DateTime;
use Yasumi\Holiday;
use Yasumi\tests\YasumiTestCaseInterface;

/**
 * Class for testing Christmas Eve in the Czech Republic.
 *
 * Class ChristmasDayTest
 * @package Yasumi\tests\CzechRepublic
 * @author  Dennis Fridrich <fridrich.dennis@gmail.com>
 */
class ChristmasEveTest extends CzechRepublicBaseTestCase implements YasumiTestCaseInterface
{
    /**
     * The name of the holiday
     */
    const HOLIDAY = 'christmasEve';

    /**
     * Tests Christmas Eve.
     *
     * @dataProvider HolidayDataProvider
     *
     * @param int      $year     the year for which Christmas Eve needs to be tested
     * @param DateTime $expected the expected date
     */
    public function testChristmasDay($year, $expected)
    {
        $this->assertHoliday(self::REGION, self::HOLIDAY, $year, $expected);
    }

    /**
     * Returns a list of random test dates used for assertion of the holiday defined in this test
     *
     * @return array list of test dates for the holiday defined in this test
     */
    public function HolidayDataProvider()
    {
        return $this->generateRandomDates(12, 24, self::TIMEZONE);
    }

    /**
     * Tests translated name of Christmas Day.
     */
    public function testTranslation()
    {
        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(),
            [self::LOCALE => 'Štědrý den']
        );
    }

    /**
     * Tests type of the holiday defined in this test.
     */
    public function testHolidayType()
    {
        $this->assertHolidayType(self::REGION, self::HOLIDAY, $this->generateRandomYear(), Holiday::TYPE_OBSERVANCE);
    }
}
