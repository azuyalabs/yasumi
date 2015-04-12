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
 * Class for testing All Saints' Day in Belgium.
 *
 * All Saints' Day, also known as All Hallows, Solemnity of All Saints, or Feast of All Saints is a solemnity
 * celebrated on 1 November by the Catholic Church and various Protestant denominations in honour of all the saints.
 */
class AllSaintsDayTest extends BelgiumBaseTestCase
{
    /**
     * Tests All Saints' Day.
     *
     * @dataProvider AllSaintsDayDataProvider
     *
     * @param int      $year     the year for which All Saints' Day needs to be tested
     * @param DateTime $expected the expected date
     */
    public function testAssumptionOfMary($year, $expected)
    {
        $this->assertHoliday(self::COUNTRY, 'allSaintsDay', $year, $expected);

    }

    /**
     * Returns a list of random test dates used for assertion of All Saints' Day.
     *
     * @return array list of test dates for All Saints' Day
     */
    public function AllSaintsDayDataProvider()
    {
        return $this->generateRandomDates(11, 1, self::TIMEZONE);
    }
}
