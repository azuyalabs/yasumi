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

namespace Yasumi\tests\Belgium;

use DateTime;
use DateTimeZone;

/**
 * Class for testing Ascension Day in Belgium.
 */
class AscensionDayTest extends BelgiumBaseTestCase
{
    /**
     * The name of the holiday to be tested
     */
    const HOLIDAY = 'ascensionDay';

    /**
     * Tests Ascension Day.
     */
    public function testAscensionDay()
    {
        $year = 1818;
        $this->assertHoliday(self::REGION, self::HOLIDAY, $year,
            new DateTime("$year-4-30", new DateTimeZone(self::TIMEZONE)));
    }

    /**
     * Tests translated name of Ascension Day
     */
    public function testTranslation()
    {
        $this->assertTranslatedHolidayName(self::REGION, self::HOLIDAY, $this->generateRandomYear(),
            ['nl_BE' => 'Hemelvaart']);
    }
}
