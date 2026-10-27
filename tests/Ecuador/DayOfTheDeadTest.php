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

namespace Yasumi\tests\Ecuador;

use Yasumi\Holiday;
use Yasumi\tests\HolidayTestCase;

class DayOfTheDeadTest extends EcuadorBaseTestCase implements HolidayTestCase
{
    public const HOLIDAY = 'dayOfTheDead';

    /** @throws \Exception */
    public function testHoliday(): void
    {
        // Nov 02 2001 = Friday — no transfer
        $year = 2001;
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new \DateTime("{$year}-11-02", new \DateTimeZone(self::TIMEZONE))
        );
    }

    /** @throws \Exception */
    public function testTransferRule(): void
    {
        // Nov 02 2000 = Thursday → 2000-11-03
        $holidays = \Yasumi\Yasumi::create(self::REGION, 2000, self::LOCALE);
        $holiday = $holidays->getHoliday(self::HOLIDAY);
        $this->assertNotNull($holiday);
        $this->assertSame('2000-11-03', $holiday->format('Y-m-d'));
    }

    /** @throws \Exception */
    public function testTranslation(): void
    {
        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            static::generateRandomYear(),
            [self::LOCALE => 'Día de Difuntos']
        );
    }

    /** @throws \Exception */
    public function testHolidayType(): void
    {
        $this->assertHolidayType(self::REGION, self::HOLIDAY, static::generateRandomYear(), Holiday::TYPE_OFFICIAL);
    }
}
