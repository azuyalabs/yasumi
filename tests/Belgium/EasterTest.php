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

namespace Yasumi\Tests\Belgium;

use DateTime;
use DateTimeZone;

/**
 * Class for testing Easter in Belgium.
 */
class EasterTest extends BelgiumBaseTestCase
{
    /**
     * The name of the holiday to be tested.
     */
    const HOLIDAY = 'easter';

    /**
     * The name of the holiday EasterMonday.
     */
    const HOLIDAY_EASTER_MONDAY = 'easterMonday';

    /**
     * Tests Easter.
     */
    public function testEaster()
    {
        $year = 2008;
        $this->assertHoliday(self::REGION, self::HOLIDAY, $year,
            new DateTime("$year-3-23", new DateTimeZone(self::TIMEZONE)));
    }

    /**
     * Tests Easter.
     */
    public function testEasterMonday()
    {
        $year = 2008;
        $this->assertHoliday(self::REGION, self::HOLIDAY_EASTER_MONDAY, $year,
            new DateTime("$year-3-24", new DateTimeZone(self::TIMEZONE)));
    }

    /**
     * Tests translated name of Easter.
     */
    public function testTranslationEaster()
    {
        $this->assertTranslatedHolidayName(self::REGION, self::HOLIDAY, $this->generateRandomYear(),
            ['nl_BE' => 'Eerste Paasdag']);
    }

    /**
     * Tests translated name of Easter Monday.
     */
    public function testTranslationEasterMonday()
    {
        $this->assertTranslatedHolidayName(self::REGION, self::HOLIDAY_EASTER_MONDAY, $this->generateRandomYear(),
            ['nl_BE' => 'Paasmaandag']);
    }
}
