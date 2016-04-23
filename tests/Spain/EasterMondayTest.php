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
 * Class containing tests for Easter Monday in Spain.
 */
class EasterMondayTest extends SpainBaseTestCase
{
    /**
     * The name of the holiday to be tested
     */
    const HOLIDAY = 'easterMonday';

    /**
     * Name of the region (e.g. country / state) to be tested
     * Using Catalonia as the holiday provider as not all regions celebrate Easter Monday in Spain.
     */
    const REGION = 'Spain/Catalonia';

    /**
     * Tests the holiday defined in this test.
     */
    public function testHoliday()
    {
        $year = 2216;
        $this->assertHoliday(self::REGION, self::HOLIDAY, $year,
            new DateTime("$year-4-8", new DateTimeZone(self::TIMEZONE)));
    }

    /**
     * Tests translated name of the holiday defined in this test.
     */
    public function testTranslation()
    {
        $this->assertTranslatedHolidayName(self::REGION, self::HOLIDAY, $this->generateRandomYear(),
            [self::LOCALE => 'Lunes de Pascua']);
    }
}
