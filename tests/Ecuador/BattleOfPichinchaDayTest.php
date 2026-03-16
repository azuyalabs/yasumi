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
use Yasumi\Provider\Ecuador;
use Yasumi\tests\HolidayTestCase;

class BattleOfPichinchaDayTest extends EcuadorBaseTestCase implements HolidayTestCase
{
    public const HOLIDAY = 'battleOfPichinchaDay';

    /** @throws \Exception */
    public function testHoliday(): void
    {
        // May 24 2002 = Friday — no transfer
        $year = 2002;
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new \DateTime("{$year}-05-24", new \DateTimeZone(self::TIMEZONE))
        );
    }

    /** @throws \Exception */
    public function testTransferRule(): void
    {
        // May 24 2000 = Wednesday → 2000-05-26
        $holidays = \Yasumi\Yasumi::create(self::REGION, 2000, self::LOCALE);
        $holiday = $holidays->getHoliday(self::HOLIDAY);
        $this->assertNotNull($holiday);
        $this->assertSame('2000-05-26', $holiday->format('Y-m-d'));
    }

    /** @throws \Exception */
    public function testNotBeforeEstablishment(): void
    {
        $this->assertNotHoliday(self::REGION, self::HOLIDAY, Ecuador::BATTLE_OF_PICHINCHA_YEAR - 1);
    }

    /** @throws \Exception */
    public function testTranslation(): void
    {
        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            static::generateRandomYear(Ecuador::BATTLE_OF_PICHINCHA_YEAR),
            [self::LOCALE => 'Batalla del Pichincha']
        );
    }

    /** @throws \Exception */
    public function testHolidayType(): void
    {
        $this->assertHolidayType(self::REGION, self::HOLIDAY, static::generateRandomYear(Ecuador::BATTLE_OF_PICHINCHA_YEAR), Holiday::TYPE_OFFICIAL);
    }
}
