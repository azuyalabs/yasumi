<?php
/**
 *  This file is part of the Yasumi package.
 *
 *  Copyright (c) 2015 - 2016 AzuyaLabs
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 *
 *  @author Dorian Neto <doriansampaioneto@gmail.com>
 */

namespace Yasumi\Tests\Brazil;

use DateTime;
use DateTimeZone;

/**
 * Class for testing Christmas Day in the Brazil.
 */
class ChristmasDayTest extends BrazilBaseTestCase
{
    /**
     * The name of the holiday
     */
    const HOLIDAY = 'christmasDay';

    /**
     * Tests Christmas Day.
     */
    public function testChristmasDay()
    {
        $year = 1897;
        $this->assertHoliday(self::REGION, self::HOLIDAY, $year, 
            new DateTime("$year-12-25", new DateTimeZone(self::TIMEZONE)));
    }

    /**
     * Tests translated name of Christmas Day.
     */
    public function testTranslation()
    {
        $this->assertTranslatedHolidayName(self::REGION, self::HOLIDAY, $this->generateRandomYear(),
            ['pt_BR' => 'Natal']);
    }
}
