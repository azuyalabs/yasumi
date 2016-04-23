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

namespace Yasumi\tests\Spain;

use DateTime;
use DateTimeZone;

/**
 * Class containing tests for Maundy Thursday in Spain.
 */
class MaundyThursdayTest extends SpainBaseTestCase
{
    /**
     * The name of the holiday to be tested
     */
    const HOLIDAY = 'maundyThursday';

    /**
     * Name of the region (e.g. country / state) to be tested
     * Using the Region of Murcia as the holiday provider as not all regions celebrate Maundy Thursday in Spain.
     */
    const REGION = 'Spain/RegionOfMurcia';

    /**
     * Tests the holiday defined in this test.
     */
    public function testHoliday()
    {
        $year = 1977;
        $this->assertHoliday(self::REGION, self::HOLIDAY, $year,
            new DateTime("$year-4-7", new DateTimeZone(self::TIMEZONE)));
    }

    /**
     * Tests the translated name of the holiday defined in this test.
     */
    public function testTranslation()
    {
        $this->assertTranslatedHolidayName(self::REGION, self::HOLIDAY, $this->generateRandomYear(),
            [self::LOCALE => 'Jueves Santo']);
    }
}
