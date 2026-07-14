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
use Yasumi\Provider\ChristianHolidays;
use Yasumi\tests\HolidayTestCase;

/**
 * Class for testing Sacred Heart of Jesus Day (Sagrado Corazón de Jesús) in Colombia.
 *
 * The canonical date is Easter + 68 days (Friday). Under the Emiliani rule
 * it is always moved to the following Monday.
 *
 * 2025: Easter = 20 Apr → canonical = 27 Jun (Friday) → observed = 30 Jun (Monday).
 */
class SacredHeartDayTest extends ColombiaBaseTestCase implements HolidayTestCase
{
    use ChristianHolidays;

    public const HOLIDAY = 'sacredHeartDay';

    /** @throws \Exception */
    public function testHoliday(): void
    {
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            2025,
            new \DateTime('2025-06-30', new \DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests that Sacred Heart Day always falls on a Monday in Colombia.
     *
     * @throws \Exception
     */
    public function testSacredHeartAlwaysFallsOnMonday(): void
    {
        foreach (range(2020, 2030) as $year) {
            $holidays = \Yasumi\Yasumi::create(self::REGION, $year, self::LOCALE);
            $holiday = $holidays->getHoliday(self::HOLIDAY);
            $this->assertNotNull($holiday, "Sacred Heart Day not found for year {$year}");
            $this->assertSame('1', $holiday->format('w'), "Sacred Heart Day is not a Monday in {$year}: " . $holiday->format('Y-m-d'));
        }
    }

    /** @throws \Exception */
    public function testTranslation(): void
    {
        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            static::generateRandomYear(),
            [self::LOCALE => 'Sagrado Corazón de Jesús']
        );
    }

    /** @throws \Exception */
    public function testHolidayType(): void
    {
        $this->assertHolidayType(self::REGION, self::HOLIDAY, static::generateRandomYear(), Holiday::TYPE_OFFICIAL);
    }
}
