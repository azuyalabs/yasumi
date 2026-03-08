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

namespace Yasumi\tests\SanMarino;

use Yasumi\Holiday;
use Yasumi\Provider\SanMarino;
use Yasumi\tests\HolidayTestCase;

/**
 * Class containing tests for the Fall of Fascism in San Marino.
 *
 * Observed on 28 July, this holiday commemorates the coup d'état of 28 July 1943 that overthrew
 * San Marino's Fascist government. It has been observed since 1944.
 *
 * @see https://en.wikipedia.org/wiki/San_Marino_in_World_War_II
 */
class FallOfFascismTest extends SanMarinoBaseTestCase implements HolidayTestCase
{
    /**
     * The name of the holiday.
     */
    public const HOLIDAY = 'fallOfFascism';

    /**
     * Tests the Fall of Fascism on or after 1944.
     *
     * @throws \Exception
     */
    public function testFallOfFascismOnAfter1944(): void
    {
        $year = static::generateRandomYear(SanMarino::FALL_OF_FASCISM_YEAR);
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new \DateTime("{$year}-7-28", new \DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests the Fall of Fascism before 1944.
     *
     * @throws \Exception
     */
    public function testFallOfFascismBefore1944(): void
    {
        $this->assertNotHoliday(
            self::REGION,
            self::HOLIDAY,
            static::generateRandomYear(1000, SanMarino::FALL_OF_FASCISM_YEAR - 1)
        );
    }

    /**
     * Tests translated name of the Fall of Fascism.
     *
     * @throws \Exception
     */
    public function testTranslation(): void
    {
        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            static::generateRandomYear(SanMarino::FALL_OF_FASCISM_YEAR),
            [self::LOCALE => 'Caduta del Fascismo']
        );
    }

    /**
     * Tests type of the holiday defined in this test.
     *
     * @throws \Exception
     */
    public function testHolidayType(): void
    {
        $this->assertHolidayType(
            self::REGION,
            self::HOLIDAY,
            static::generateRandomYear(SanMarino::FALL_OF_FASCISM_YEAR),
            Holiday::TYPE_OFFICIAL
        );
    }
}
