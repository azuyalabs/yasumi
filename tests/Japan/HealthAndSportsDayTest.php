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
 * Class for testing Health And Sports Day in Japan.
 */
class HealthAndSportsDayTest extends JapanBaseTestCase implements YasumiTestCaseInterface
{
    /**
     * The name of the holiday
     */
    const HOLIDAY = 'healthandSportsDay';

    /**
     * The year in which the holiday was first established
     */
    const ESTABLISHMENT_YEAR = 1996;

    /**
     * Tests Health And Sports Day after 2000. Health And Sports Day was established since 1996 on October 10th. After
     * 2000 it was changed to be the second monday of October.
     */
    public function testHealthAndSportsDayOnAfter2000()
    {
        $year = $this->generateRandomYear(2001);
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new DateTime("second monday of october $year", new DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests Health And Sports Day between 1996 and 2000. Health And Sports Day was established since 1996 on October
     * 10th. After 2000 it was changed to be the second monday of October.
     */
    public function testHealthAndSportsDayBetween1996And2000()
    {
        $year = 1997;
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new DateTime("$year-10-10", new DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests Health And Sports Day between 1996 and 2000 substituted next working day (when Health And Sports Day falls
     * on a Sunday)
     */
    public function testHealthAndSportsDayBetween1996And2000SubstitutedNextWorkingDay()
    {
        $year = 1999;
        $this->assertHoliday(
            self::REGION,
            self::SUBSTITUTE_PREFIX . self::HOLIDAY,
            $year,
            new DateTime("$year-10-11", new DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests Health And Sports Day before. Health And Sports Day was established since 1996 on October 10th. After
     * 2000 it was changed to be the second monday of October.
     */
    public function testHealthAndSportsDayBefore1996()
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
            [self::LOCALE => '体育の日']
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
            Holiday::TYPE_NATIONAL
        );
    }
}
