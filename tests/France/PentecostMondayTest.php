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

namespace Yasumi\tests\France;

use DateTime;
use DateTimeZone;

/**
 * Class for testing Pentecost Monday in France.
 */
class PentecostMondayTest extends FranceBaseTestCase
{
    /**
     * The name of the holiday
     */
    const HOLIDAY = 'pentecostMonday';

    /**
     * Tests Pentecost Monday.
     */
    public function testPentecostMonday()
    {
        $year = 1977;
        $this->assertHoliday(self::REGION, self::HOLIDAY, $year,
            new DateTime("$year-5-30", new DateTimeZone(self::TIMEZONE)));
    }

    /**
     * Tests translated name of Pentecost Monday.
     */
    public function testTranslation()
    {
        $this->assertTranslatedHolidayName(self::REGION, self::HOLIDAY, $this->generateRandomYear(),
            ['fr_FR' => 'Lundi de Pentecôte']);
    }
}
