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
 * Class for testing Proclamação da República in the Brazil.
 */
class ProclamacaoDaRepublicaTest extends BrazilBaseTestCase
{
    /**
     * The name of the holiday
     */
    const HOLIDAY = 'proclamacaoDaRepublica';

    /**
     * The year in which the holiday was first established
     */
    const ESTABLISHMENT_YEAR = 1889;

    /**
     * Tests Proclamação da República on or after 1889.
     */
    public function testProclamacaoDaRepublicaAfter1889()
    {
        $year = $this->generateRandomYear(self::ESTABLISHMENT_YEAR);
        $this->assertHoliday(self::REGION, self::HOLIDAY, $year,
            new DateTime("$year-11-15", new DateTimeZone(self::TIMEZONE)));
    }

    /**
     * Tests Proclamação da República on or before 1889.
     */
    public function testProclamacaoDaRepublicaBefore1889()
    {
        $year = $this->generateRandomYear(1000, self::ESTABLISHMENT_YEAR-1);
        $this->assertNotHoliday(self::REGION, self::HOLIDAY, $year,
            new DateTime("$year-11-15", new DateTimeZone(self::TIMEZONE)));
    }
}
