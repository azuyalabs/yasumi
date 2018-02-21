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

namespace Yasumi\tests\Switzerland;

use DateTime;
use DateTimeZone;
use Yasumi\Holiday;
use Yasumi\tests\YasumiTestCaseInterface;

/**
 * Class containing tests for National Day in Switzerland.
 */
class SwissNationalDayTest extends SwitzerlandBaseTestCase implements YasumiTestCaseInterface
{
    /**
     * The name of the holiday
     */
    const HOLIDAY = 'swissNationalDay';

    /**
     * The year in which the holiday was established as national holiday
     */
    const NATIONAL_ESTABLISHMENT_YEAR = 1994;

    /**
     * The year in which the holiday was first established
     */
    const FIRST_ESTABLISHMENT_YEAR = 1899;

    /**
     * The year in which the holiday was first observed
     */
    const FIRST_OBSERVANCE_YEAR = 1891;

    /**
     * Tests National Day on or after 1994.
     */
    public function testNationalDayOnAfter1994()
    {
        $year = $this->generateRandomYear(self::NATIONAL_ESTABLISHMENT_YEAR);
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new DateTime("$year-8-01", new DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests National Day on or after 1899 and before 1994.
     */
    public function testNationalDayOnAfter1899()
    {
        $year = $this->generateRandomYear(self::FIRST_ESTABLISHMENT_YEAR, self::NATIONAL_ESTABLISHMENT_YEAR - 1);
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new DateTime("$year-8-01", new DateTimeZone(self::TIMEZONE))
        );
        $this->assertHolidayType(self::REGION, self::HOLIDAY, $year, Holiday::TYPE_OBSERVANCE);
    }

    /**
     * Tests National Day on 1891
     */
    public function testNationalDayOn1891()
    {
        $year = self::FIRST_OBSERVANCE_YEAR;
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new DateTime("$year-8-01", new DateTimeZone(self::TIMEZONE))
        );
        $this->assertHolidayType(self::REGION, self::HOLIDAY, $year, Holiday::TYPE_OBSERVANCE);
    }

    /**
     * Tests National Day before 1891.
     */
    public function testNationalDayBefore1891()
    {
        $this->assertNotHoliday(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(1000, self::FIRST_OBSERVANCE_YEAR - 1)
        );
    }

    /**
     * Tests National Day between 1891 and 1899.
     */
    public function testNationalDayBetween1891And1899()
    {
        $year = $this->generateRandomYear(self::FIRST_OBSERVANCE_YEAR + 1, self::FIRST_ESTABLISHMENT_YEAR - 1);
        $this->assertNotHoliday(self::REGION, self::HOLIDAY, $year);
    }

    /**
     * Tests translated name of National Day.
     */
    public function testTranslation()
    {
        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(self::NATIONAL_ESTABLISHMENT_YEAR),
            [self::LOCALE => 'Bundesfeiertag']
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
            $this->generateRandomYear(self::NATIONAL_ESTABLISHMENT_YEAR),
            Holiday::TYPE_OFFICIAL
        );
    }
}
