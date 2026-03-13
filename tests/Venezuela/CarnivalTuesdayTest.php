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

namespace Yasumi\tests\Venezuela;

use Yasumi\Holiday;
use Yasumi\Provider\ChristianHolidays;
use Yasumi\tests\HolidayTestCase;

/**
 * Class for testing Carnival Tuesday in Venezuela.
 *
 * Falls on Easter − 47 days (LOTTT Art. 184(b)).
 * 2025: Easter = 20 Apr → Carnival Tuesday = 4 Mar.
 */
class CarnivalTuesdayTest extends VenezuelaBaseTestCase implements HolidayTestCase
{
    use ChristianHolidays;

    public const HOLIDAY = 'carnivalTuesday';

    /** @throws \Exception */
    public function testHoliday(): void
    {
        $year = 2025;
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            static::computeEaster($year, self::TIMEZONE)->sub(new \DateInterval('P47D'))
        );
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
