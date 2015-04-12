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
namespace Yasumi\Tests\USA;

use DateTime;
use DateTimeZone;

/**
 * Class to test Dr. Martin Luther King Day.
 *
 * Honors Dr. Martin Luther King, Jr., Civil Rights leader, who was actually born on January 15, 1929; combined with
 * other holidays in several states. It is observed on the third Monday of January since 1986.
 *
 * @link http://en.wikipedia.org/wiki/Martin_Luther_King,_Jr._Day Source: Wikipedia.
 */
class MartinLutherKingDayTest extends USABaseTestCase
{
    /**
     * The name of the holiday
     */
    const HOLIDAY = 'martinLutherKingDay';

    /**
     * Tests Dr. Martin Luther King Day after 1986. Dr. Martin Luther King Day was established since 1996 on the third
     * Monday of January.
     */
    public function testMartinLutherKingDayOnAfter1986()
    {
        $year = $this->generateRandomYear(1986);
        $this->assertHoliday(self::COUNTRY, self::HOLIDAY, $year,
            new DateTime("third monday of january $year", new DateTimeZone(self::TIMEZONE)));
    }

    /**
     * Tests Dr. Martin Luther King Day before 1986. Dr. Martin Luther King Day was established since 1996 on the third
     * Monday of January.
     */
    public function testMartinLutherKingDayBefore1986()
    {
        $this->assertNotHoliday(self::COUNTRY, self::HOLIDAY, $this->generateRandomYear(1000, 1985));
    }
}
