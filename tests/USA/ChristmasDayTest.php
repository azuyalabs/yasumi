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
class ChristmasDayTest extends USABaseTestCase implements YasumiTestCaseInterface
{
    /**
     * The name of the holiday
     */
    const HOLIDAY = 'christmasDay';

    /**
     * Tests Christmas Day. Christmas Day is celebrated on December 25th.
     */
    public function testChristmasDay()
    {
        $year = 2001;
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new DateTime("$year-12-25", new DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests Christmas Day substituted on Monday (when Christmas Day falls on Sunday).
     */
    public function testChristmasDaySubstitutedMonday()
    {
        // Substituted Holiday on Monday (Christmas Day falls on Sunday)
        $year = 6101;
        $this->assertHoliday(
            self::REGION,
            'substituteHoliday:christmasDay',
            $year,
            new DateTime("$year-12-26", new DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests Christmas Day substituted on Monday (when Christmas Day falls on Saturday).
     */
    public function testChristmasDaySubstitutedFriday()
    {
        // Substituted Holiday on Friday (Christmas Day falls on Saturday)
        $year = 2060;
        $this->assertHoliday(
            self::REGION,
            'substituteHoliday:christmasDay',
            $year,
            new DateTime("$year-12-24", new DateTimeZone(self::TIMEZONE))
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
            [self::LOCALE => 'Christmas']
        );
    }

    /**
     * Tests type of the holiday defined in this test.
     */
    public function testHolidayType()
    {
        $this->assertHolidayType(self::REGION, self::HOLIDAY, $this->generateRandomYear(), Holiday::TYPE_OFFICIAL);
    }
}
