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
 * Class for testing Mountain Day in Japan.
 */
class MountainDayTest extends JapanBaseTestCase implements YasumiTestCaseInterface
{
    /**
     * The name of the holiday
     */
    const HOLIDAY = 'mountainDay';

    /**
     * The year in which the holiday was first established
     */
    const ESTABLISHMENT_YEAR = 2016;

    /**
     * Tests Mountain Day after 2016. Mountain Day was established in 2014 and is held from 2016 on August 11th.
     */
    public function testMountainDayOnAfter2016()
    {
        $year = 2016;
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new DateTime("$year-8-11", new DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests Mountain Day after 2016 substituted next working day (when Mountain Day falls on a Sunday)
     */
    public function testMountainDayOnAfter2016SubstitutedNextWorkingDay()
    {
        $year = 2019;
        $this->assertHoliday(
            self::REGION,
            self::SUBSTITUTE_PREFIX . self::HOLIDAY,
            $year,
            new DateTime("$year-8-12", new DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests Mountain Day before 2016. Mountain Day was established in 2014 and is held from 2016 on August 11th.
     */
    public function testMountainDayBefore2016()
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
            [self::LOCALE => '山の日']
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
