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
 * Class for testing Father's Day in the Netherlands.
 */
class FathersDayTest extends NetherlandsBaseTestCase
{
    /**
     * The name of the holiday to be tested
     */
    const HOLIDAY = 'fathersDay';

    /**
     * Tests the holiday defined in this test.
     */
    public function testHoliday()
    {
        $year = $this->generateRandomYear();
        $this->assertHoliday(self::REGION, self::HOLIDAY, $year,
            new DateTime("third sunday of june $year", new DateTimeZone(self::TIMEZONE)));
    }

    /**
     * Tests the translated name of the holiday defined in this test.
     */
    public function testTranslation()
    {
        $this->assertTranslatedHolidayName(self::REGION, self::HOLIDAY, $this->generateRandomYear(),
            [self::LOCALE => 'Vaderdag']);
    }
}
