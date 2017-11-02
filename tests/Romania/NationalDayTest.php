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

namespace Yasumi\tests\Romania;

use DateTime;
use DateTimeZone;
use Yasumi\Holiday;
use Yasumi\tests\YasumiTestCaseInterface;

/**
 * Class for testing National Day in Romania.
 */
class NationalDayTest extends RomaniaBaseTestCase implements YasumiTestCaseInterface
{
    /**
     * The name of the holiday to be tested
     */
    const HOLIDAY = 'nationalDay';

    /**
     * The year in which the holiday was first established
     */
    const ESTABLISHMENT_YEAR = 1866;

    /**
     * Tests National Day on or after 1990.
     */
    public function testNationalDayOnAfter1990()
    {
        $year = $this->generateRandomYear(1990);
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new DateTime("$year-12-1", new DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests National Day between 1948 - 1989.
     */
    public function testNationalDayBetween1948_1989()
    {
        $year = $this->generateRandomYear(1948, 1989);
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new DateTime("$year-08-23", new DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests National Day between 1866 - 1947.
     */
    public function testNationalDayBetween1866_1947()
    {
        $year = $this->generateRandomYear(self::ESTABLISHMENT_YEAR, 1947);
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new DateTime("$year-05-10", new DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests National Day before 1865.
     */
    public function testNationalDayBefore1865()
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
            [self::LOCALE => 'Ziua Națională']
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
