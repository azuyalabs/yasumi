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
 * Class for testing Pentecost in Belgium.
 */
class PentecostTest extends BelgiumBaseTestCase
{
    /**
     * The name of the holiday to be tested
     */
    const HOLIDAY = 'pentecost';

    /**
     * The name of the holiday
     */
    const HOLIDAY_PENTECOST_MONDAY = 'pentecostMonday';

    /**
     * Tests Pentecost.
     */
    public function testPentecost()
    {
        $year = 2025;
        $this->assertHoliday(self::REGION, self::HOLIDAY, $year,
            new DateTime("$year-6-8", new DateTimeZone(self::TIMEZONE)));
    }

    /**
     * Tests Pentecost Monday.
     */
    public function testPentecostMonday()
    {
        $year = 2025;
        $this->assertHoliday(self::REGION, self::HOLIDAY_PENTECOST_MONDAY, $year,
            new DateTime("$year-6-9", new DateTimeZone(self::TIMEZONE)));
    }

    /**
     * Tests translated name of Pentecost
     */
    public function testTranslationPentecost()
    {
        $this->assertTranslatedHolidayName(self::REGION, self::HOLIDAY, $this->generateRandomYear(),
            ['nl_BE' => 'Eerste Pinksterdag']);
    }

    /**
     * Tests translated name of Pentecost Monday
     */
    public function testTranslationPentecostMonday()
    {
        $this->assertTranslatedHolidayName(self::REGION, self::HOLIDAY_PENTECOST_MONDAY, $this->generateRandomYear(),
            ['nl_BE' => 'Pinkstermaandag']);
    }
}
