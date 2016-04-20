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
 * Class for testing Dia da independência do Brasil in the Brazil.
 */
class DiaDaIndependenciaDoBrasilTest extends BrazilBaseTestCase
{
    /**
     * The name of the holiday
     */
    const HOLIDAY = 'diaDaIndependenciaDoBrasil';

    /**
     * The year in which the holiday was first established
     */
    const ESTABLISHMENT_YEAR = 1822;

    /**
     * Tests Dia da independência do Brasil on or after 1822.
     */
    public function testDiaDaIndependenciaDoBrasilAfter1822()
    {
        $year = $this->generateRandomYear(self::ESTABLISHMENT_YEAR);
        $this->assertHoliday(self::REGION, self::HOLIDAY, $year, 
            new DateTime("$year-09-07", new DateTimeZone(self::TIMEZONE)));
    }

    /**
     * Tests Dia da independência do Brasil on or before 1822.
     */
    public function testDiaDaIndependenciaDoBrasilBefore1822()
    {
        $year = $this->generateRandomYear(1000, self::ESTABLISHMENT_YEAR-1);
        $this->assertNotHoliday(self::REGION, self::HOLIDAY, $year, 
            new DateTime("$year-09-07", new DateTimeZone(self::TIMEZONE)));
    }
}
