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
use Yasumi\Provider\Colombia;
use Yasumi\tests\HolidayTestCase;

/**
 * Class for testing Battle of Boyacá Day (Batalla de Boyacá) in Colombia.
 *
 * Fixed date: 7 August. Not subject to the Emiliani rule.
 * Commemorates the decisive battle of 7 August 1819 that secured independence.
 */
class BattleOfBoyacaDayTest extends ColombiaBaseTestCase implements HolidayTestCase
{
    public const HOLIDAY = 'battleOfBoyacaDay';

    public const ESTABLISHMENT_YEAR = Colombia::BATTLE_OF_BOYACA_YEAR;

    /** @throws \Exception */
    public function testHoliday(): void
    {
        $year = self::ESTABLISHMENT_YEAR;
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new \DateTime("{$year}-08-07", new \DateTimeZone(self::TIMEZONE))
        );
    }

    /** @throws \Exception */
    public function testNotHoliday(): void
    {
        $this->assertNotHoliday(self::REGION, self::HOLIDAY, self::ESTABLISHMENT_YEAR - 1);
    }

    /** @throws \Exception */
    public function testTranslation(): void
    {
        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            static::generateRandomYear(self::ESTABLISHMENT_YEAR),
            [self::LOCALE => 'Batalla de Boyacá']
        );
    }

    /** @throws \Exception */
    public function testHolidayType(): void
    {
        $this->assertHolidayType(self::REGION, self::HOLIDAY, static::generateRandomYear(self::ESTABLISHMENT_YEAR), Holiday::TYPE_OFFICIAL);
    }
}
