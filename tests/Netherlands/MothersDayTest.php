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
 * Class for testing Mother's Day in the Netherlands.
 */
class MothersDayTest extends NetherlandsBaseTestCase
{
    /**
     * Tests Mother's Day.
     */
    public function testMothersDay()
    {
        $year = $this->generateRandomYear();
        $this->assertHoliday(self::REGION, 'mothersDay', $year,
            new DateTime("second sunday of may $year", new DateTimeZone(self::TIMEZONE)));
    }
}
