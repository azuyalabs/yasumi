<?php

declare(strict_types = 1);

/**
 * This file is part of the 'Yasumi' package.
 *
 * The easy PHP Library for calculating holidays.
 *
 * Copyright (c) 2015 - 2026 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <me at sachatelgenhof dot com>
 */

namespace Yasumi\tests\Colombia;

use Yasumi\Holiday;
use Yasumi\tests\HolidayTestCase;

/**
 * Class for testing St. Joseph's Day (Día de San José) in Colombia.
 *
 * Under the Emiliani rule (Ley 51 of 1983), when 19 March falls on a Monday
 * the holiday stays; otherwise it moves to the following Monday.
 */
class StJosephsDayTest extends ColombiaBaseTestCase implements HolidayTestCase
{
    public const HOLIDAY = 'stJosephsDay';

    /**
     * Tests St. Joseph's Day when 19 Mar falls on a Monday (2018).
     *
     * 19 March 2018 = Monday.
     *
     * @throws \Exception
     */
    public function testStJosephsDayOnMonday(): void
    {
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            2018,
            new \DateTime('2018-03-19', new \DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests St. Joseph's Day moved to following Monday (19 Mar 2025 = Wednesday → 24 Mar 2025).
     *
     * @throws \Exception
     */
    public function testStJosephsDayMovedToMonday(): void
    {
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            2025,
            new \DateTime('2025-03-24', new \DateTimeZone(self::TIMEZONE))
        );
    }

    /** @throws \Exception */
    public function testTranslation(): void
    {
        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            static::generateRandomYear(),
            [self::LOCALE => 'Día de San José']
        );
    }

    /** @throws \Exception */
    public function testHolidayType(): void
    {
        $this->assertHolidayType(self::REGION, self::HOLIDAY, static::generateRandomYear(), Holiday::TYPE_OFFICIAL);
    }
}
