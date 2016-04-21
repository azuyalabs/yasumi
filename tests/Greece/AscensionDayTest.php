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
 * Class for testing Ascension Day in Greece.
 */
class AscensionDayTest extends GreeceBaseTestCase
{
    /**
     * The name of the holiday
     */
    const HOLIDAY = 'ascensionDay';

    /**
     * Tests Ascension Day.
     */
    public function testAscensionDay()
    {
        $year = 2016;
        $this->assertHoliday(self::REGION, self::HOLIDAY, $year,
            new DateTime("$year-6-9", new DateTimeZone(self::TIMEZONE)));
    }

    /**
     * Tests translated name of Ascension Day.
     */
    public function testTranslation()
    {
        $this->assertTranslatedHolidayName(self::REGION, self::HOLIDAY, $this->generateRandomYear(),
            ['el_GR' => 'Ανάληψη του Χριστού']);
    }
}
