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
 * Class ChristmasDayTest.
 */
class ChristmasDayTest extends NetherlandsBaseTestCase
{
    /**
     * Tests Christmas Day.
     *
     * @dataProvider ChristmasDayDataProvider
     *
     * @param int           $year     the year for which Christmas Day needs to be tested
     * @param Carbon\Carbon $expected the expected date
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
        return $this->generateRandomDates(12, 25);
    }
}
