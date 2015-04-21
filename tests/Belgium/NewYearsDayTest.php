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
namespace Yasumi\Tests\Belgium;

/**
 * Class for testing New Years Day in Belgium.
 *
 * New Year's Day is observed on January 1, the first day of the year on the modern Gregorian calendar as well as the
 * Julian calendar.
 */
class NewYearsDayTest extends BelgiumBaseTestCase
{
    /**
     * Tests New Years Day.
     *
     * @dataProvider NewYearsDayDataProvider
     *
     * @param int      $year     the year for which New Years Day needs to be tested
     * @param \DateTime $expected the expected date
     */
    public function testNewYearsDay($year, $expected)
    {
        $this->assertHoliday(self::COUNTRY, 'newYearsDay', $year, $expected);

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
