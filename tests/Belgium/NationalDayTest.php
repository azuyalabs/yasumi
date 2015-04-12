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

use DateTime;

/**
 * Class for testing the National Day of Belgium.
 *
 * Belgian National Day is the National Day of Belgium celebrated on 21 July each year.
 */
class NationalDayTest extends BelgiumBaseTestCase
{
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
        $this->assertHoliday(self::COUNTRY, 'nationalDay', $year, $expected);

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
}
