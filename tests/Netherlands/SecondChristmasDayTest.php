<?php
/*
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
use Yasumi\Tests\Netherlands\NetherlandsBaseTestCase;

/**
 * Class SecondChristmasDayTest.
 */
class SecondChristmasDayTest extends NetherlandsBaseTestCase
{
    /**
     * Tests Second Christmas Day.
     *
     * @dataProvider SecondChristmasDayDataProvider
     *
     * @param int           $year     the year for which Second Christmas Day needs to be tested
     * @param Carbon\Carbon $expected the expected date
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
        return $this->generateRandomDates(12, 26);
    }
}
