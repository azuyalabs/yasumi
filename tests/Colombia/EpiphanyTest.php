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
 * Class for testing Epiphany (Día de los Reyes Magos) in Colombia.
 *
 * Under the Emiliani rule (Ley 51 of 1983), when 6 January falls on a Monday
 * the holiday stays on that date; otherwise it is moved to the following Monday.
 */
class EpiphanyTest extends ColombiaBaseTestCase implements HolidayTestCase
{
    public const HOLIDAY = 'epiphany';

    /**
     * Tests Epiphany when 6 Jan is already a Monday (stays on 6 Jan).
     *
     * 6 Jan 2025 = Monday.
     *
     * @throws \Exception
     */
    public function testEpiphanyOnMonday(): void
    {
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            2025,
            new \DateTime('2025-01-06', new \DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests Epiphany moved to following Monday (6 Jan 2026 = Tuesday → 12 Jan 2026).
     *
     * @throws \Exception
     */
    public function testEpiphanyMovedToMonday(): void
    {
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            2026,
            new \DateTime('2026-01-12', new \DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests that all Epiphany dates fall on a Monday.
     *
     * @throws \Exception
     */
    public function testEpiphanyAlwaysFallsOnMonday(): void
    {
        foreach (range(2020, 2030) as $year) {
            $holidays = \Yasumi\Yasumi::create(self::REGION, $year, self::LOCALE);
            $holiday = $holidays->getHoliday(self::HOLIDAY);
            $this->assertNotNull($holiday, "Epiphany not found for year {$year}");
            $this->assertSame('1', $holiday->format('w'), "Epiphany is not a Monday in {$year}: " . $holiday->format('Y-m-d'));
        }
    }

    /** @throws \Exception */
    public function testTranslation(): void
    {
        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            static::generateRandomYear(),
            [self::LOCALE => 'Día de los Reyes Magos']
        );
    }

    /** @throws \Exception */
    public function testHolidayType(): void
    {
        $this->assertHolidayType(self::REGION, self::HOLIDAY, static::generateRandomYear(), Holiday::TYPE_OFFICIAL);
    }
}
