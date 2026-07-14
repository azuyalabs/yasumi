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
 * Class for testing All Saints' Day (Día de Todos los Santos) in Colombia.
 *
 * Under the Emiliani rule, when 1 November falls on a Monday the holiday stays;
 * otherwise it moves to the following Monday.
 *
 * 2021: 1 Nov = Monday → observed = 1 Nov.
 * 2025: 1 Nov = Saturday → observed = 3 Nov (Monday).
 */
class AllSaintsDayTest extends ColombiaBaseTestCase implements HolidayTestCase
{
    public const HOLIDAY = 'allSaintsDay';

    /**
     * Tests All Saints' Day when 1 Nov falls on a Monday (2021).
     *
     * @throws \Exception
     */
    public function testHolidayOnMonday(): void
    {
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            2021,
            new \DateTime('2021-11-01', new \DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests All Saints' Day moved to following Monday (1 Nov 2025 = Saturday → 3 Nov 2025).
     *
     * @throws \Exception
     */
    public function testHolidayMovedToMonday(): void
    {
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            2025,
            new \DateTime('2025-11-03', new \DateTimeZone(self::TIMEZONE))
        );
    }

    /** @throws \Exception */
    public function testTranslation(): void
    {
        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            static::generateRandomYear(),
            [self::LOCALE => 'Día de Todos los Santos']
        );
    }

    /** @throws \Exception */
    public function testHolidayType(): void
    {
        $this->assertHolidayType(self::REGION, self::HOLIDAY, static::generateRandomYear(), Holiday::TYPE_OFFICIAL);
    }
}
