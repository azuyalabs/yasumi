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
 * Class for testing Columbus Day (Día de la Raza) in Colombia.
 *
 * Under the Emiliani rule, when 12 October falls on a Monday the holiday stays;
 * otherwise it moves to the following Monday.
 *
 * 2026: 12 Oct = Monday → observed = 12 Oct.
 * 2025: 12 Oct = Sunday → observed = 13 Oct (Monday).
 */
class ColumbusDayTest extends ColombiaBaseTestCase implements HolidayTestCase
{
    public const HOLIDAY = 'columbusDay';

    /** @throws \Exception */
    public function testHolidayOnMonday(): void
    {
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            2026,
            new \DateTime('2026-10-12', new \DateTimeZone(self::TIMEZONE))
        );
    }

    /** @throws \Exception */
    public function testHolidayMovedToMonday(): void
    {
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            2025,
            new \DateTime('2025-10-13', new \DateTimeZone(self::TIMEZONE))
        );
    }

    /** @throws \Exception */
    public function testTranslation(): void
    {
        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            static::generateRandomYear(),
            [self::LOCALE => 'Día de la Raza']
        );
    }

    /** @throws \Exception */
    public function testHolidayType(): void
    {
        $this->assertHolidayType(self::REGION, self::HOLIDAY, static::generateRandomYear(), Holiday::TYPE_OFFICIAL);
    }
}
