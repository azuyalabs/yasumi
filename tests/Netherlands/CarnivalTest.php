<?php
/**
 *  This file is part of the Yasumi package.
 *
 *  Copyright (c) 2015 - 2016 AzuyaLabs
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 *
 *  @author Sacha Telgenhof <stelgenhof@gmail.com>
 */

namespace Yasumi\Tests\Netherlands;

use DateTime;
use DateTimeZone;

/**
 * Class for testing Carnival in the Netherlands.
 */
class CarnivalTest extends NetherlandsBaseTestCase
{
    /**
     * Tests First Carnival Day.
     */
    public function testFirstCarnivalDay()
    {
        $year = 2015;
        $this->assertHoliday(self::REGION, 'carnivalDay', $year,
            new DateTime("$year-2-15", new DateTimeZone(self::TIMEZONE)));
    }

    /**
     * Tests Second Carnival Day.
     */
    public function testSecondCarnivalDay()
    {
        $year = 2015;
        $this->assertHoliday(self::REGION, 'secondCarnivalDay', $year,
            new DateTime("$year-2-16", new DateTimeZone(self::TIMEZONE)));
    }

    /**
     * Tests Third Carnival Day.
     */
    public function testThirdCarnivalDay()
    {
        $year = 2015;
        $this->assertHoliday(self::REGION, 'thirdCarnivalDay', $year,
            new DateTime("$year-2-17", new DateTimeZone(self::TIMEZONE)));
    }
}
