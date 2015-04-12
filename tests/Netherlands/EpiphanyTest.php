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
namespace Yasumi\Tests\Netherlands;

use DateTime;

/**
 * Class EpiphanyTest.
 */
class EpiphanyTest extends NetherlandsBaseTestCase
{
    /**
     * Tests Epiphany.
     *
     * @dataProvider EpiphanyDataProvider
     *
     * @param int      $year     the year for which Epiphany needs to be tested
     * @param DateTime $expected the expected date
     */
    public function testEpiphany($year, $expected)
    {
        $this->assertHoliday(self::COUNTRY, 'epiphany', $year, $expected);
    }

    /**
     * Returns a list of random test dates used for assertion of Epiphany.
     *
     * @return array list of test dates for Epiphany
     */
    public function EpiphanyDataProvider()
    {
        return $this->generateRandomDates(1, 6, self::TIMEZONE);
    }
}
