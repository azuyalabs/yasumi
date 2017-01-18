<?php
/**
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 - 2017 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <stelgenhof@gmail.com>
 */

namespace Yasumi\tests\Brazil;

use DateTime;
use DateTimeZone;
use Yasumi\Holiday;
use Yasumi\tests\YasumiTestCaseInterface;

/**
 * Class for testing Proclamation of The Republic Day in Brazil.
 */
class ProclamationOfRepublicDayTest extends BrazilBaseTestCase implements YasumiTestCaseInterface
{
    /**
     * The name of the holiday
     */
    const HOLIDAY = 'proclamationOfRepublicDay';

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
        $year = $this->generateRandomYear(1000, self::ESTABLISHMENT_YEAR - 1);
        $this->assertNotHoliday(self::REGION, self::HOLIDAY, $year,
            new DateTime("$year-11-15", new DateTimeZone(self::TIMEZONE)));
    }

    /**
     * Tests the translated name of the holiday defined in this test.
     */
    public function testTranslation()
    {
        $year = $this->generateRandomYear(self::ESTABLISHMENT_YEAR);
        $this->assertTranslatedHolidayName(self::REGION, self::HOLIDAY, $year,
            [self::LOCALE => 'Dia da Proclamação da República']);
    }

    /**
     * Tests type of the holiday defined in this test.
     */
    public function testHolidayType()
    {
        $year = $this->generateRandomYear(self::ESTABLISHMENT_YEAR);
        $this->assertHolidayType(self::REGION, self::HOLIDAY, $year, Holiday::TYPE_NATIONAL);
    }
}
