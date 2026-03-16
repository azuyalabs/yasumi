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
use Yasumi\Provider\ChristianHolidays;
use Yasumi\tests\HolidayTestCase;

/**
 * Class for testing Carnival Tuesday in Ecuador.
 *
 * Carnival Tuesday is always the day after Carnival Monday and is explicitly
 * exempt from the transfer rule per Art. 65 CT and the 2016 reform.
 */
class CarnavalTuesdayTest extends EcuadorBaseTestCase implements HolidayTestCase
{
    use ChristianHolidays;

    public const HOLIDAY = 'carnavalTuesday';

    /** @throws \Exception */
    public function testHoliday(): void
    {
        $year = 2025;
        // 2025: Easter = April 20; Carnival Tuesday = March 4
        $expected = static::computeEaster($year, self::TIMEZONE)->sub(new \DateInterval('P47D'));
        $this->assertHoliday(self::REGION, self::HOLIDAY, $year, $expected);
    }

    /** @throws \Exception */
    public function testAlwaysFallsOnTuesday(): void
    {
        foreach (range(2020, 2030) as $year) {
            $holidays = \Yasumi\Yasumi::create(self::REGION, $year, self::LOCALE);
            $holiday = $holidays->getHoliday(self::HOLIDAY);
            $this->assertNotNull($holiday);
            $this->assertSame(
                '2',
                $holiday->format('w'),
                self::HOLIDAY . " must fall on Tuesday in {$year}, got " . $holiday->format('l Y-m-d')
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
            [self::LOCALE => 'Martes de Carnaval']
        );
    }

    /** @throws \Exception */
    public function testHolidayType(): void
    {
        $this->assertHolidayType(self::REGION, self::HOLIDAY, static::generateRandomYear(), Holiday::TYPE_OFFICIAL);
    }
}
