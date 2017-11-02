<?php
/**
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 - 2017 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <stelgenhof@gmail.com>
 */

namespace Yasumi\tests\Italy;

use DateTime;
use Yasumi\Holiday;
use Yasumi\tests\YasumiTestCaseInterface;

/**
 * Class for testing the day of Immaculate Conception in Italy.
 */
class ImmaculateConceptionTest extends ItalyBaseTestCase implements YasumiTestCaseInterface
{
    /**
     * The name of the holiday
     */
    const HOLIDAY = 'immaculateConception';

    /**
     * Tests the day of Immaculate Conception.
     *
     * @dataProvider ImmaculateConceptionDataProvider
     *
     * @param int      $year     the year for which the day of Immaculate Conception needs to be tested
     * @param DateTime $expected the expected date
     */
    public function testImmaculateConception($year, $expected)
    {
        $this->assertHoliday(self::REGION, self::HOLIDAY, $year, $expected);
    }

    /**
     * Returns a list of random test dates used for assertion of the day of Immaculate Conception.
     *
     * @return array list of test dates for the day of Immaculate Conception
     */
    public function ImmaculateConceptionDataProvider()
    {
        return $this->generateRandomDates(12, 8, self::TIMEZONE);
    }

    /**
     * Tests translated name of the day of Immaculate Conception.
     */
    public function testTranslation()
    {
        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(),
            [self::LOCALE => 'Immacolata Concezione']
        );
    }

    /**
     * Tests type of the holiday defined in this test.
     */
    public function testHolidayType()
    {
        $this->assertHolidayType(self::REGION, self::HOLIDAY, $this->generateRandomYear(), Holiday::TYPE_OFFICIAL);
    }
}
