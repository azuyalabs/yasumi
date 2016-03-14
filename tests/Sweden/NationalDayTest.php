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

namespace Yasumi\Tests\Sweden;

use DateTime;
use DateTimeZone;

/**
 * Class for testing the National Day of Sweden in Sweden.
 */
class NationalDayTest extends SwedenBaseTestCase
{
    /**
     * The name of the holiday
     */
    const HOLIDAY = 'nationalDay';

    /**
     * Tests the holiday defined in this test.
     */
    public function testHoliday()
    {
        $year = 2071;
        $this->assertHoliday(self::REGION, self::HOLIDAY, $year,
            new DateTime("$year-6-10", new DateTimeZone(self::TIMEZONE)));
    }

    /**
     * Tests the translated name of the holiday defined in this test.
     */
    public function testTranslation()
    {
        $this->assertTranslatedHolidayName(self::REGION, self::HOLIDAY, $this->generateRandomYear(),
            [self::LOCALE => 'Sveriges nationaldag']);
    }
}
