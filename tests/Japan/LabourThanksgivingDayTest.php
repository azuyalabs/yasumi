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

namespace Yasumi\tests\Japan;

use DateTime;
use DateTimeZone;
use Yasumi\Holiday;
use Yasumi\tests\YasumiTestCaseInterface;

/**
 * Class for testing Labor Thanksgiving Day in Japan.
 */
class LabourThanksgivingDayTest extends JapanBaseTestCase implements YasumiTestCaseInterface
{
    /**
     * The name of the holiday
     */
    const HOLIDAY = 'laborThanksgivingDay';

    /**
     * The year in which the holiday was first established
     */
    const ESTABLISHMENT_YEAR = 1948;

    /**
     * Tests Labor Thanksgiving Day after 1948. Labor Thanksgiving Day is held on November 23rd and established since
     * 1948.
     */
    public function testLabourThanksgivingDayOnAfter1948()
    {
        $year = 4884;
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new DateTime("$year-11-23", new DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests Labor Thanksgiving Day after 1948 substituted next working day (when Labor Thanksgiving Day falls on a
     * Sunday)
     */
    public function testLabourThanksgivingDayOnAfter1948SubstitutedNextWorkingDay()
    {
        $year = 1986;
        $this->assertHoliday(
            self::REGION,
            self::SUBSTITUTE_PREFIX . self::HOLIDAY,
            $year,
            new DateTime("$year-11-24", new DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests Labor Thanksgiving Day before 1948. Labor Thanksgiving Day is held on November 23rd and established since
     * 1948.
     */
    public function testLabourThanksgivingDayBefore1948()
    {
        $this->assertNotHoliday(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(1000, self::ESTABLISHMENT_YEAR - 1)
        );
    }

    /**
     * Tests the translated name of the holiday defined in this test.
     */
    public function testTranslation()
    {
        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(self::ESTABLISHMENT_YEAR),
            [self::LOCALE => '勤労感謝の日']
        );
    }

    /**
     * Tests type of the holiday defined in this test.
     */
    public function testHolidayType()
    {
        $this->assertHolidayType(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(self::ESTABLISHMENT_YEAR),
            Holiday::TYPE_OFFICIAL
        );
    }
}
