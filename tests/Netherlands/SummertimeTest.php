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
 * Class for testing Summertime in the Netherlands.
 */
class SummerTimeTest extends NetherlandsBaseTestCase
{
    /**
     * Tests Summertime.
     */
    public function testSummertime()
    {
        $year = $this->generateRandomYear();
        $this->assertHoliday(self::REGION, 'summerTime', $year,
            new DateTime("last sunday of march $year", new DateTimeZone(self::TIMEZONE)));
    }
}
