<?php
/*
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <stelgenhof@gmail.com>
 */
namespace Yasumi\Tests\Italy;

use DateTime;

/**
 * Class for testing the day of Immaculate Conception in Italy.
 */
class ImmaculateConceptionTest extends ItalyBaseTestCase
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
        $this->assertHoliday(self::COUNTRY, self::HOLIDAY, $year, $expected);

    }

    /**
     * Tests translated name of the day of Immaculate Conception.
     */
    public function testTranslatedImmaculateConception()
    {
        $this->assertTranslatedHolidayName(self::COUNTRY, self::HOLIDAY, $this->generateRandomYear(),
            ['it_IT' => 'Immacolata Concezione']);
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
}
