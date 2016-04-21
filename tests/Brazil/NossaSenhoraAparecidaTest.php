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
 * Class for testing Nossa Senhora Aparecida in the Brazil.
 */
class NossaSenhoraAparecidaTest extends BrazilBaseTestCase
{
    /**
     * The name of the holiday
     */
    const HOLIDAY = 'nossaSenhoraAparecida';

    /**
     * The year in which the holiday was first established
     */
    const ESTABLISHMENT_YEAR = 1980;

    /**
     * Tests Nossa Senhora Aparecida on or after 1980.
     */
    public function testNossaSenhoraAparecidaAfter1980()
    {
        $year = $this->generateRandomYear(self::ESTABLISHMENT_YEAR);
        $this->assertHoliday(self::REGION, self::HOLIDAY, $year, 
            new DateTime("$year-10-12", new DateTimeZone(self::TIMEZONE)));
    }

    /**
     * Tests Nossa Senhora Aparecida on or before 1980.
     */
    public function testNossaSenhoraAparecidaBefore1980()
    {
        $year = $this->generateRandomYear(1000, self::ESTABLISHMENT_YEAR-1);
        $this->assertNotHoliday(self::REGION, self::HOLIDAY, $year, 
            new DateTime("$year-10-12", new DateTimeZone(self::TIMEZONE)));
    }
}
