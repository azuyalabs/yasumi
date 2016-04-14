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
 * Class containing tests for Easter in Poland.
 */
class EasterTest extends PolandBaseTestCase
{
    /**
     * The name of the holiday to be tested
     */
    const HOLIDAY = 'easter';

    /**
     * Tests the holiday defined in this test.
     */
    public function testHoliday()
    {
        $year = 2020;
        $this->assertHoliday(self::REGION, self::HOLIDAY, $year,
            new DateTime("$year-4-12", new DateTimeZone(self::TIMEZONE)));
    }

    /**
     * Tests translated name of the holiday defined in this test.
     */
    public function testTranslation()
    {
        $this->assertTranslatedHolidayName(self::REGION, self::HOLIDAY, $this->generateRandomYear(),
            ['pl_PL' => 'Wielkanoc']);
    }
}
