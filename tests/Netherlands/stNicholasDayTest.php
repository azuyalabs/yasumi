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
 * Class stNicholasDayTest.
 */
class stNicholasDayTest extends NetherlandsBaseTestCase
{
    /**
     * Tests Sint Nicholas Day.
     *
     * @dataProvider stNicholasDayDataProvider
     *
     * @param int           $year     the year for which Sint Nicholas Day needs to be tested
     * @param Carbon\Carbon $expected the expected date
     */
    public function teststNicholasDay($year, $expected)
    {
        $this->assertHoliday(self::COUNTRY, 'stNicholasDay', $year, $expected);

    }

    /**
     * Returns a list of random test dates used for assertion of Sint Nicholas Day.
     *
     * @return array list of test dates for Sint Nicholas Day
     */
    public function stNicholasDayDataProvider()
    {
        return $this->generateRandomDates(12, 5);
    }
}
