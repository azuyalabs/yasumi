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

namespace Yasumi\tests\Poland;

use DateTime;
use DateTimeZone;

/**
 * Class for testing Pentecost Monday in Poland.
 */
class PentecostTest extends PolandBaseTestCase
{
    /**
     * The name of the holiday
     */
    const HOLIDAY = 'pentecost';

    /**
     * Tests the holiday defined in this test.
     */
    public function testHoliday()
    {
        $year = 2019;
        $this->assertHoliday(self::REGION, self::HOLIDAY, $year,
            new DateTime("$year-6-9", new DateTimeZone(self::TIMEZONE)));
    }

    /**
     * Tests the translated name of the holiday defined in this test.
     */
    public function testTranslation()
    {
        $this->assertTranslatedHolidayName(self::REGION, self::HOLIDAY, $this->generateRandomYear(),
            ['pl_PL' => 'Zielone Świątki']);
    }
}
