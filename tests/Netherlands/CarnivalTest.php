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
use DateTimeZone;

/**
 * Class for testing Carnival.
 *
 * Carnival (Dutch: Carnaval) is originally an European Pagan spring festival, with an emphasis on role-reversal and
 * suspension of social norms. The feast became assimilated by the Catholic Church and was celebrated in the three days
 * preceding Ash Wednesday and Lent.
 */
class CarnivalTest extends NetherlandsBaseTestCase
{
    /**
     * Tests First Carnival Day.
     */
    public function testFirstCarnivalDay()
    {
        $year = 2015;
        $this->assertHoliday(self::COUNTRY, 'carnivalDay', $year,
            new DateTime("$year-2-15", new DateTimeZone(self::TIMEZONE)));
    }

    /**
     * Tests Second Carnival Day.
     */
    public function testSecondCarnivalDay()
    {
        $year = 2015;
        $this->assertHoliday(self::COUNTRY, 'secondCarnivalDay', $year,
            new DateTime("$year-2-16", new DateTimeZone(self::TIMEZONE)));
    }

    /**
     * Tests Third Carnival Day.
     */
    public function testThirdCarnivalDay()
    {
        $year = 2015;
        $this->assertHoliday(self::COUNTRY, 'thirdCarnivalDay', $year,
            new DateTime("$year-2-17", new DateTimeZone(self::TIMEZONE)));
    }
}
