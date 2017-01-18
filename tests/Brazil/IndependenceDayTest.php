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
 * Class for testing Independence Day in Brazil.
 */
class IndependenceDayTest extends BrazilBaseTestCase implements YasumiTestCaseInterface
{
    /**
     * The name of the holiday
     */
    const HOLIDAY = 'independenceDay';

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
        $year = $this->generateRandomYear(1000, self::ESTABLISHMENT_YEAR - 1);
        $this->assertNotHoliday(self::REGION, self::HOLIDAY, $year,
            new DateTime("$year-09-07", new DateTimeZone(self::TIMEZONE)));
    }

    /**
     * Tests the translated name of the holiday defined in this test.
     */
    public function testTranslation()
    {
        $year = $this->generateRandomYear(self::ESTABLISHMENT_YEAR);
        $this->assertTranslatedHolidayName(self::REGION, self::HOLIDAY, $year,
            [self::LOCALE => 'Dia da Independência do Brasil']);
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
