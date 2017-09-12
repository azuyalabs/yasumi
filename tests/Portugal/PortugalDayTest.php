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

namespace Yasumi\tests\Portugal;

use DateTime;
use DateTimeZone;
use Yasumi\Holiday;
use Yasumi\Provider\Portugal;
use Yasumi\tests\YasumiTestCaseInterface;

/**
 * Class for testing Portugal Day in Portugal.
 */
class PortugalDayTest extends PortugalBaseTestCase implements YasumiTestCaseInterface
{
    /**
     * The year in which the holiday was abolished
     */
    const ESTABLISHMENT_YEAR_BEFORE = 1932;

    /**
     * The year in which the holiday was restored
     */
    const ESTABLISHMENT_YEAR_AFTER = 1974;

    /**
     * The name of the holiday to be tested
     */
    const HOLIDAY = 'portugalDay';

    /**
     * Tests the holiday defined in this test before it was abolished.
     * @see Portugal::calculatePortugalDay()
     */
    public function testHolidayBeforeAbolishment()
    {
        $year     = $this->generateRandomYear(1000, self::ESTABLISHMENT_YEAR_BEFORE);
        $expected = new DateTime("$year-06-10", new DateTimeZone(self::TIMEZONE));
        $this->assertHoliday(self::REGION, self::HOLIDAY, $year, $expected);
    }

    /**
     * Tests the holiday defined in this test after it was restored
     * @see Portugal::calculatePortugalDay()
     */
    public function testHolidayAfterRestoration()
    {
        $year     = $this->generateRandomYear(self::ESTABLISHMENT_YEAR_AFTER);
        $expected = new DateTime("$year-06-10", new DateTimeZone(self::TIMEZONE));
        $this->assertHoliday(self::REGION, self::HOLIDAY, $year, $expected);
    }

    /**
     * Tests that the holiday defined in this test does not exist during the period that it was abolished
     * @see Portugal::calculatePortugalDay()
     */
    public function testNotHolidayDuringAbolishment()
    {
        $year = $this->generateRandomYear(self::ESTABLISHMENT_YEAR_BEFORE + 1, self::ESTABLISHMENT_YEAR_AFTER - 1);
        $this->assertNotHoliday(self::REGION, self::HOLIDAY, $year);

        $this->assertNotHoliday(self::REGION, self::HOLIDAY, self::ESTABLISHMENT_YEAR_BEFORE + 1);
        $this->assertNotHoliday(self::REGION, self::HOLIDAY, self::ESTABLISHMENT_YEAR_AFTER - 1);
    }

    /**
     * Tests the translated name of the holiday defined in this test.
     */
    public function testTranslation()
    {
        $year = $this->generateRandomYear(1000, self::ESTABLISHMENT_YEAR_BEFORE);
        $this->assertTranslatedHolidayName(self::REGION, self::HOLIDAY, $year, [self::LOCALE => 'Dia de Portugal']);

        $year = $this->generateRandomYear(self::ESTABLISHMENT_YEAR_AFTER);
        $this->assertTranslatedHolidayName(self::REGION, self::HOLIDAY, $year, [self::LOCALE => 'Dia de Portugal']);
    }

    /**
     * Tests type of the holiday defined in this test.
     */
    public function testHolidayType()
    {
        $year = $this->generateRandomYear(1000, self::ESTABLISHMENT_YEAR_BEFORE);
        $this->assertHolidayType(self::REGION, self::HOLIDAY, $year, Holiday::TYPE_OFFICIAL);

        $year = $this->generateRandomYear(self::ESTABLISHMENT_YEAR_AFTER);
        $this->assertHolidayType(self::REGION, self::HOLIDAY, $year, Holiday::TYPE_OFFICIAL);
    }
}
