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
 * Class for testing Dia de Tiradentes in the Brazil.
 */
class DiaDeTiradentesTest extends BrazilBaseTestCase
{
    /**
     * The name of the holiday
     */
    const HOLIDAY = 'diaDeTiradentes';

    /**
     * The year in which the holiday was first established
     */
    const ESTABLISHMENT_YEAR = 1792;

    /**
     * Tests Dia de Tiradentes on or after 1792.
     */
    public function testDiaDeTiradentesAfter1792()
    {
        $year = $this->generateRandomYear(self::ESTABLISHMENT_YEAR);
        $this->assertHoliday(self::REGION, self::HOLIDAY, $year, 
            new DateTime("$year-04-21", new DateTimeZone(self::TIMEZONE)));
    }

    /**
     * Tests Dia de Tiradentes on or before 1792.
     */
    public function testDiaDeTiradentesBefore1792()
    {
        $year = $this->generateRandomYear(1000, self::ESTABLISHMENT_YEAR-1);
        $this->assertNotHoliday(self::REGION, self::HOLIDAY, $year, 
            new DateTime("$year-04-21", new DateTimeZone(self::TIMEZONE)));
    }
}
