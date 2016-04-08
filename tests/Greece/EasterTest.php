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

namespace Yasumi\tests\Greece;

use DateTime;
use DateTimeZone;

/**
 * Class containing tests for Easter in Greece.
 */
class EasterTest extends GreeceBaseTestCase
{
    /**
     * The name of the first holiday of Easter
     */
    const HOLIDAY_FIRST = 'easter';

    /**
     * The name of the second holiday of Easter
     */
    const HOLIDAY_SECOND = 'easterMonday';

    /**
     * Tests Easter.
     */
    public function testEaster()
    {
        $year = 2016;
        $this->assertHoliday(self::REGION, self::HOLIDAY_FIRST, $year,
            new DateTime("$year-5-1", new DateTimeZone(self::TIMEZONE)));
    }

    /**
     * Tests Easter Monday.
     */
    public function testEasterMonday()
    {
        $year = 2016;
        $this->assertHoliday(self::REGION, self::HOLIDAY_SECOND, $year,
            new DateTime("$year-5-2", new DateTimeZone(self::TIMEZONE)));
    }

    /**
     * Tests translated name of Easter Monday.
     */
    public function testTranslatedEasterMonday()
    {
        $this->assertTranslatedHolidayName(self::REGION, self::HOLIDAY_SECOND, $this->generateRandomYear(),
            ['el_GR' => 'Δευτέρα του Πάσχα']);
    }

    /**
     * Tests translated name of Easter.
     */
    public function testTranslation()
    {
        $this->assertTranslatedHolidayName(self::REGION, self::HOLIDAY_FIRST, $this->generateRandomYear(),
            ['el_GR' => 'Κυριακή του Πάσχα']);
    }
}
