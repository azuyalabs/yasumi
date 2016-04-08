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

namespace Yasumi\tests\Netherlands;

use DateTime;
use DateTimeZone;

/**
 * Class for testing Wintertime in the Netherlands.
 */
class WintertimeTest extends NetherlandsBaseTestCase
{
    /**
     * Tests Wintertime.
     */
    public function testWintertime()
    {
        $year = $this->generateRandomYear();
        $this->assertHoliday(self::REGION, 'winterTime', $year,
            new DateTime("last sunday of october $year", new DateTimeZone(self::TIMEZONE)));
    }
}
