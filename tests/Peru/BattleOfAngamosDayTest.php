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
use Yasumi\Provider\Peru;
use Yasumi\tests\HolidayTestCase;

/**
 * Class for testing BattleOfAngamos in Peru.
 */
class BattleOfAngamosDayTest extends PeruBaseTestCase implements HolidayTestCase
{
    public const HOLIDAY = 'battleOfAngamosDay';

    /**
     * Tests that the holiday falls on the canonical date when it is a Monday.
     *
     * @throws \Exception
     */
    public function testHoliday(): void
    {
        $year = 2018;
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new \DateTime("{$year}-10-08", new \DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests that the observed date always falls on a Monday.
     *
     * @throws \Exception
     */
    public function testAlwaysFallsOnMonday(): void
    {
        foreach (range(Peru::BATTLE_OF_ANGAMOS_YEAR, Peru::BATTLE_OF_ANGAMOS_YEAR + 10) as $year) {
            $holidays = \Yasumi\Yasumi::create(self::REGION, $year, self::LOCALE);
            $holiday = $holidays->getHoliday(self::HOLIDAY);
            $this->assertNotNull($holiday);
            $this->assertSame(
                '1',
                $holiday->format('w'),
                "{self::HOLIDAY} must fall on a Monday in {$year}, got " . $holiday->format('l Y-m-d')
            );
        }
    }

    /**
     * Tests that the holiday is not present before 1879.
     *
     * @throws \Exception
     */
    public function testNotBeforeEstablishment(): void
    {
        $this->assertNotHoliday(self::REGION, self::HOLIDAY, Peru::BATTLE_OF_ANGAMOS_YEAR - 1);
    }

    /** @throws \Exception */
    public function testTranslation(): void
    {
        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            static::generateRandomYear(Peru::BATTLE_OF_ANGAMOS_YEAR),
            [self::LOCALE => 'Combate de Angamos']
        );
    }

    /** @throws \Exception */
    public function testHolidayType(): void
    {
        $this->assertHolidayType(self::REGION, self::HOLIDAY, static::generateRandomYear(Peru::BATTLE_OF_ANGAMOS_YEAR), Holiday::TYPE_OFFICIAL);
    }
}
