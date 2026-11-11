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

namespace Yasumi\tests\Peru;

use Yasumi\Holiday;
use Yasumi\tests\HolidayTestCase;

/**
 * Class for testing Saint Peter and Saint Paul Day in Peru.
 */
class SaintPeterAndPaulDayTest extends PeruBaseTestCase implements HolidayTestCase
{
    public const HOLIDAY = 'saintPeterAndPaulDay';

    /** @throws \Exception */
    public function testHoliday(): void
    {
        // Jun 29 2020 = Monday
        $year = 2020;
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new \DateTime("{$year}-06-29", new \DateTimeZone(self::TIMEZONE))
        );
    }

    /** @throws \Exception */
    public function testAlwaysFallsOnMonday(): void
    {
        foreach (range(2020, 2030) as $year) {
            $holidays = \Yasumi\Yasumi::create(self::REGION, $year, self::LOCALE);
            $holiday = $holidays->getHoliday(self::HOLIDAY);
            $this->assertNotNull($holiday);
            $this->assertSame(
                '1',
                $holiday->format('w'),
                self::HOLIDAY . " must fall on a Monday in {$year}, got " . $holiday->format('l Y-m-d')
            );
        }
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
