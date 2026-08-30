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
 * Class for testing AirForce in Peru.
 */
class AirForceDayTest extends PeruBaseTestCase implements HolidayTestCase
{
    public const HOLIDAY = 'airForceDay';

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
            new \DateTime("{$year}-07-23", new \DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests that the observed date always falls on a Monday.
     *
     * @throws \Exception
     */
    public function testAlwaysFallsOnMonday(): void
    {
        foreach (range(Peru::AIR_FORCE_YEAR, Peru::AIR_FORCE_YEAR + 10) as $year) {
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
     * Tests that the holiday is not present before 1929.
     *
     * @throws \Exception
     */
    public function testNotBeforeEstablishment(): void
    {
        $this->assertNotHoliday(self::REGION, self::HOLIDAY, Peru::AIR_FORCE_YEAR - 1);
    }

    /** @throws \Exception */
    public function testTranslation(): void
    {
        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            static::generateRandomYear(Peru::AIR_FORCE_YEAR),
            [self::LOCALE => 'Día de la Fuerza Aérea del Perú']
        );
    }

    /** @throws \Exception */
    public function testHolidayType(): void
    {
        $this->assertHolidayType(self::REGION, self::HOLIDAY, static::generateRandomYear(Peru::AIR_FORCE_YEAR), Holiday::TYPE_OFFICIAL);
    }
}
