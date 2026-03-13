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
use Yasumi\tests\HolidayTestCase;

/**
 * Class for testing Christmas Eve (Nochebuena, 24 December) in Venezuela.
 *
 * Established by LOTTT Art. 184(b).
 */
class ChristmasEveTest extends VenezuelaBaseTestCase implements HolidayTestCase
{
    public const HOLIDAY = 'christmasEve';

    /** @throws \Exception */
    public function testHoliday(): void
    {
        $year = 2025;
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new \DateTime("{$year}-12-24", new \DateTimeZone(self::TIMEZONE))
        );
    }

    /** @throws \Exception */
    public function testTranslation(): void
    {
        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            static::generateRandomYear(),
            [self::LOCALE => 'Nochebuena']
        );
    }

    /** @throws \Exception */
    public function testHolidayType(): void
    {
        $this->assertHolidayType(self::REGION, self::HOLIDAY, static::generateRandomYear(), Holiday::TYPE_OFFICIAL);
    }
}
