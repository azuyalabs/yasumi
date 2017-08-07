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

namespace Yasumi\tests\USA;

use DateTime;
use DateTimeZone;
use Yasumi\Holiday;
use Yasumi\tests\YasumiTestCaseInterface;

/**
 * Class for testing New Years Day in the USA.
 */
class NewYearsDayTest extends USABaseTestCase implements YasumiTestCaseInterface
{
    /**
     * The name of the holiday
     */
    const HOLIDAY = 'newYearsDay';

    /**
     * Tests New Years Day.
     */
    public function testNewYearsDay()
    {
        $year = 1997;
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new DateTime("$year-1-1", new DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests New Years Day when substituted on Monday (when New Years Day falls on Sunday).
     */
    public function testNewYearsDaySubstitutedMonday()
    {
        $year = 2445;
        $this->assertHoliday(
            self::REGION,
            'substituteHoliday:newYearsDay',
            $year,
            new DateTime("$year-1-2", new DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests New Years Day when substituted on Friday (when New Years Day falls on Saturday).
     */
    public function testNewYearsDaySubstitutedFriday()
    {
        $year    = 1938;
        $subYear = $year - 1;
        $this->assertHoliday(
            self::REGION,
            'substituteHoliday:newYearsDay',
            $year,
            new DateTime("$subYear-12-31", new DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests translated name of the holiday defined in this test.
     */
    public function testTranslation()
    {
        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(),
            [self::LOCALE => 'New Year\'s Day']
        );
    }

    /**
     * Tests type of the holiday defined in this test.
     */
    public function testHolidayType()
    {
        $this->assertHolidayType(self::REGION, self::HOLIDAY, $this->generateRandomYear(), Holiday::TYPE_NATIONAL);
    }
}
