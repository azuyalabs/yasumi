<?php

declare(strict_types = 1);

/**
 * This file is part of the 'Yasumi' package.
 *
 * The easy PHP Library for calculating holidays.
 *
 * Copyright (c) 2015 - 2025 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <me at sachatelgenhof dot com>
 */

namespace Yasumi\tests\Mexico;

use Yasumi\Holiday;
use Yasumi\tests\HolidayTestCase;

class TransmissionOfFederalPowerDayTest extends MexicoBaseTestCase implements HolidayTestCase
{
    public const HOLIDAY = 'transmissionOfFederalPowerDay';

    public const ESTABLISHMENT_YEAR = 1934;

    /**
     *  Tests that holiday is in December in 1934-2018.
     */
    public function testHolidayBefore2018(): void
    {
        $year = self::ESTABLISHMENT_YEAR;
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new \DateTime("{$year}-12-01", new \DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     *  Tests that holiday is in October since 2024.
     */
    public function testHolidayAfter2024(): void
    {
        $year = 2024;
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new \DateTime('2024-10-01', new \DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     *  Tests that holiday is in October since 2024.
     */
    public function testNotHolidayOutsideElectionYear(): void
    {
        $year = $this->numberBetween(2019, 2023);
        $this->assertNotHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new \DateTime("{$year}-10-01", new \DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     *  Tests that holiday is not present before establishment year.
     */
    public function testNotHolidayBefore1934(): void
    {
        $this->assertNotHoliday(self::REGION, self::HOLIDAY, self::ESTABLISHMENT_YEAR - 6);
    }

    /**
     * Tests translated name of the holiday.
     *
     * @throws \Exception
     */
    public function testTranslation(): void
    {
        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            self::ESTABLISHMENT_YEAR,
            [self::LOCALE => 'Transmisión de Poder Ejecutivo Federal']
        );
    }

    /**
     * Tests type of the holiday defined in this test.
     *
     * @throws \Exception
     */
    public function testHolidayType(): void
    {
        $this->assertHolidayType(self::REGION, self::HOLIDAY, self::ESTABLISHMENT_YEAR, Holiday::TYPE_OFFICIAL);
    }
}
