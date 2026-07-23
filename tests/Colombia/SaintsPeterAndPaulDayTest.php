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
 * Class for testing Saints Peter and Paul Day (San Pedro y San Pablo) in Colombia.
 *
 * Under the Emiliani rule, when 29 June falls on a Monday the holiday stays;
 * otherwise it moves to the following Monday.
 *
 * 2025: 29 Jun = Sunday → observed = 30 Jun (Monday).
 * 2026: 29 Jun = Monday → observed = 29 Jun (Monday).
 */
class SaintsPeterAndPaulDayTest extends ColombiaBaseTestCase implements HolidayTestCase
{
    public const HOLIDAY = 'saintsPeterAndPaulDay';

    /** @throws \Exception */
    public function testHolidayMovedToMonday(): void
    {
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            2025,
            new \DateTime('2025-06-30', new \DateTimeZone(self::TIMEZONE))
        );
    }

    /** @throws \Exception */
    public function testHolidayOnMonday(): void
    {
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            2026,
            new \DateTime('2026-06-29', new \DateTimeZone(self::TIMEZONE))
        );
    }

    /** @throws \Exception */
    public function testTranslation(): void
    {
        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            static::generateRandomYear(),
            [self::LOCALE => 'San Pedro y San Pablo']
        );
    }

    /** @throws \Exception */
    public function testHolidayType(): void
    {
        $this->assertHolidayType(self::REGION, self::HOLIDAY, static::generateRandomYear(), Holiday::TYPE_OFFICIAL);
    }
}
