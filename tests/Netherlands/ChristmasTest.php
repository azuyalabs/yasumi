<?php
/*
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Yasumi\Tests\Netherlands;

use DateTime;

/**
 * Class ChristmasTest.
 */
class ChristmasTest extends NetherlandsBaseTestCase
{
    /**
     * Tests Christmas Day.
     *
     * @dataProvider ChristmasDayDataProvider
     *
     * @param int      $year     the year for which Christmas Day needs to be tested
     * @param DateTime $expected the expected date
     */
    public function testChristmasDay($year, $expected)
    {
        $this->assertHoliday(self::COUNTRY, 'christmasDay', $year, $expected);

    }

    /**
     * Returns a list of random test dates used for assertion of Christmas Day.
     *
     * @return array list of test dates for Christmas Day
     */
    public function ChristmasDayDataProvider()
    {
        return $this->generateRandomDates(12, 25, self::TIMEZONE);
    }

    /**
     * Tests Second Christmas Day.
     *
     * @dataProvider SecondChristmasDayDataProvider
     *
     * @param int      $year     the year for which Second Christmas Day needs to be tested
     * @param DateTime $expected the expected date
     */
    public function testSecondChristmasDay($year, $expected)
    {
        $this->assertHoliday(self::COUNTRY, 'secondChristmasDay', $year, $expected);

    }

    /**
     * Returns a list of random test dates used for assertion of Second Christmas Day.
     *
     * @return array list of test dates for Second Christmas Day
     */
    public function SecondChristmasDayDataProvider()
    {
        return $this->generateRandomDates(12, 26, self::TIMEZONE);
    }
}
