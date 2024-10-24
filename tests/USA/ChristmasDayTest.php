<?php

declare(strict_types = 1);

/**
 * This file is part of the 'Yasumi' package.
 *
 * The easy PHP Library for calculating holidays.
 *
 * Copyright (c) 2015 - 2024 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <me at sachatelgenhof dot com>
 */

namespace Yasumi\tests\USA;

use Yasumi\Holiday;
use Yasumi\tests\HolidayTestCase;

/**
 * Class for testing New Years Day in the USA.
 */
class ChristmasDayTest extends USABaseTestCase implements HolidayTestCase
{
    /**
     * The name of the holiday.
     */
    public const HOLIDAY = 'christmasDay';

    /**
     * Tests Christmas Day. Christmas Day is celebrated on December 25th.
     *
     * @throws \Exception
     */
    public function testChristmasDay(): void
    {
        $year = 2001;
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new \DateTime("{$year}-12-25", new \DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests Christmas Day substituted on Monday (when Christmas Day falls on Sunday).
     *
     * @throws \Exception
     */
    public function testChristmasDaySubstitutedMonday(): void
    {
        // Substituted Holiday on Monday (Christmas Day falls on Sunday)
        $year = 6101;
        $this->assertHoliday(
            self::REGION,
            'substituteHoliday:christmasDay',
            $year,
            new \DateTime("{$year}-12-26", new \DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests Christmas Day substituted on Monday (when Christmas Day falls on Saturday).
     *
     * @throws \Exception
     */
    public function testChristmasDaySubstitutedFriday(): void
    {
        // Substituted Holiday on Friday (Christmas Day falls on Saturday)
        $year = 2060;
        $this->assertHoliday(
            self::REGION,
            'substituteHoliday:christmasDay',
            $year,
            new \DateTime("{$year}-12-24", new \DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests translated name of the holiday defined in this test.
     *
     * @throws \Exception
     */
    public function testTranslation(): void
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
     *
     * @throws \Exception
     */
    public function testHolidayType(): void
    {
        $this->assertHolidayType(self::REGION, self::HOLIDAY, $this->generateRandomYear(), Holiday::TYPE_OFFICIAL);
    }
}
