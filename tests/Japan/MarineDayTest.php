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

namespace Yasumi\tests\Japan;

use DateTime;
use DateTimeZone;
use Yasumi\Holiday;
use Yasumi\tests\YasumiTestCaseInterface;

/**
 * Class for testing Marine Day in Japan.
 */
class MarineDayTest extends JapanBaseTestCase implements YasumiTestCaseInterface
{
    /**
     * The name of the holiday
     */
    const HOLIDAY = 'marineDay';

    /**
     * The year in which the holiday was first established
     */
    const ESTABLISHMENT_YEAR = 1996;

    /**
     * Tests Marine Day after 2003. Marine Day was established since 1996 on July 20th. After 2003 it was changed
     * to be the third monday of July.
     */
    public function testMarineDayOnAfter2003()
    {
        $year = $this->generateRandomYear(2004);
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new DateTime("third monday of july $year", new DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests Marine Day between 1996 and 2003. Marine Day was established since 1996 on July 20th. After 2003 it was
     * changed to be the third monday of July.
     */
    public function testMarineDayBetween1996And2003()
    {
        $year = 2001;
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new DateTime("$year-7-20", new DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests Marine Day between 1996 and 2003 substituted next working day (when Marine Day falls on a Sunday)
     */
    public function testMarineDayBetween1996And2003SubstitutedNextWorkingDay()
    {
        $year = 1997;
        $this->assertHoliday(
            self::REGION,
            self::SUBSTITUTE_PREFIX . self::HOLIDAY,
            $year,
            new DateTime("$year-7-21", new DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests Marine Day before 1996. Marine Day was established since 1996 on July 20th. After 2003 it was changed
     * to be the third monday of July.
     */
    public function testMarineDayBefore1996()
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
            [self::LOCALE => '海の日']
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
