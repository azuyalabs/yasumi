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
 * Class for testing International Workers' Day in the Brazil.
 */
class InternationalWorkersDayTest extends BrazilBaseTestCase
{
    /**
     * The name of the holiday
     */
    const HOLIDAY = 'internationalWorkersDay';

    /**
     * Tests International Workers' Day.
     */
    public function testInternationalWorkersDay()
    {
        $year = 1927;
        $this->assertHoliday(self::REGION, self::HOLIDAY, $year, 
            new DateTime("$year-5-1", new DateTimeZone(self::TIMEZONE)));
    }

    /**
     * Tests translated name of International Workers' Day.
     */
    public function testTranslation()
    {
        $this->assertTranslatedHolidayName(self::REGION, self::HOLIDAY, $this->generateRandomYear(),
            ['pt_BR' => 'Dia internacional do trabalhador']);
    }
}
