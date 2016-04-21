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
 * Class containing tests for Clean Monday in Greece.
 */
class CleanMondayTest extends GreeceBaseTestCase
{
    /**
     * The name of the holiday
     */
    const HOLIDAY = 'cleanMonday';

    /**
     * Tests Clean Monday.
     */
    public function testCleanMonday()
    {
        $year = 2016;
        $this->assertHoliday(self::REGION, self::HOLIDAY, $year,
            new DateTime("$year-3-14", new DateTimeZone(self::TIMEZONE)));
    }

    /**
     * Tests translated name of Clean Monday.
     */
    public function testTranslation()
    {
        $this->assertTranslatedHolidayName(self::REGION, self::HOLIDAY,
            $this->generateRandomYear(), ['el_GR' => 'Καθαρά Δευτέρα']);
    }
}
