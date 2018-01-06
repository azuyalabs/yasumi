<?php
/**
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 - 2018 AzuyaLabs
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
use Yasumi\tests\YasumiTestCaseInterface;

/**
 * Class containing tests for All Saints Day in Portugal.
 */
class AllSaintsDayTest extends PortugalBaseTestCase implements YasumiTestCaseInterface
{
    /**
     * The name of the holiday
     */
    const HOLIDAY = 'allSaintsDay';

    /**
     * Holiday was abolished by the portuguese government in 2014.
     */
    const HOLIDAY_YEAR_ABOLISHED = 2014;

    /**
     * Holiday was restored by the portuguese government in 2016.
     */
    const HOLIDAY_YEAR_RESTORED = 2016;

    /**
     * Tests the holiday defined in this test.
     */
    public function testHoliday()
    {
        $year     = 2016;
        $expected = new DateTime("$year-11-01", new DateTimeZone(self::TIMEZONE));
        $this->assertHoliday(self::REGION, self::HOLIDAY, $year, $expected);

        $year     = 2013;
        $expected = new DateTime("$year-11-01", new DateTimeZone(self::TIMEZONE));
        $this->assertHoliday(self::REGION, self::HOLIDAY, $year, $expected);
    }

    /**
     * Test that the holiday did not happen in 2014 and 2015.
     */
    public function testNotHoliday()
    {
        $year = $this->generateRandomYear(2014, 2015);
        $this->assertNotHoliday(self::REGION, self::HOLIDAY, $year);
    }

    /**
     * Tests translated name of Corpus Christi.
     */
    public function testTranslation()
    {
        $year = $this->generateRandomYear(self::HOLIDAY_YEAR_RESTORED);
        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            $year,
            [self::LOCALE => 'Dia de todos os Santos']
        );
    }

    /**
     * Tests type of the holiday defined in this test.
     */
    public function testHolidayType()
    {
        // After restoration
        $year = $this->generateRandomYear(self::HOLIDAY_YEAR_RESTORED);
        $this->assertHolidayType(self::REGION, self::HOLIDAY, $year, Holiday::TYPE_OFFICIAL);

        // Before abolishment
        $year = $this->generateRandomYear(1000, self::HOLIDAY_YEAR_ABOLISHED - 1);
        $this->assertHolidayType(self::REGION, self::HOLIDAY, $year, Holiday::TYPE_OFFICIAL);
    }
}
