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
 * Class for testing Ascension Day in the Netherlands.
 */
class AscensionDayTest extends NetherlandsBaseTestCase
{
    /**
     * Tests Ascension Day.
     */
    public function testAscensionDay()
    {
        $year = 1754;
        $this->assertHoliday(self::REGION, 'ascensionDay', $year,
            new DateTime("$year-5-23", new DateTimeZone(self::TIMEZONE)));
    }
}
