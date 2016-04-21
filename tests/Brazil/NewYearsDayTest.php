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

namespace Yasumi\tests\Brazil;

use DateTime;
use DateTimeZone;

/**
 * Class for testing New Years Day in the Brazil.
 */
class NewYearsDayTest extends BrazilBaseTestCase
{
    /**
     * The name of the holiday
     */
    const HOLIDAY = 'newYearsDay';

    /**
     * Tests New Years Day.
     */
    public function testNewYearsDay()
    {
        $year = 1997;
        $this->assertHoliday(self::REGION, self::HOLIDAY, $year,
            new DateTime("$year-1-1", new DateTimeZone(self::TIMEZONE)));
    }

    /**
     * Tests translated name of New Years Day.
     */
    public function testTranslation()
    {
        $this->assertTranslatedHolidayName(self::REGION, self::HOLIDAY, $this->generateRandomYear(),
            ['pt_BR' => 'Ano novo']);
    }
}
