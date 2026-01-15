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

namespace Yasumi\tests\Canada\Nunavut;

use Yasumi\Holiday;
use Yasumi\tests\HolidayTestCase;

/*
 * Nunavut Day – July 9, originated as a paid holiday for Nunavut Tunngavik Incorporated
 * and regional Inuit associations. It became a half-day holiday for government employees
 * in 1999 and a full day in 2001.
 */
class NunavutDayTest extends NunavutBaseTestCase implements HolidayTestCase
{
    public const HOLIDAY = 'nunavutDay';

    public const ESTABLISHMENT_YEAR = 1999;

    public function testNunavutDayOnAfterEstablishment(): void
    {
        $year = $this->generateRandomYear(self::ESTABLISHMENT_YEAR);
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new \DateTime("{$year}-07-09", new \DateTimeZone(self::TIMEZONE))
        );
    }

    public function testLabourDayBeforeEstablishment(): void
    {
        $this->assertNotHoliday(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(1000, self::ESTABLISHMENT_YEAR - 1)
        );
    }

    public function testTranslation(): void
    {
        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(self::ESTABLISHMENT_YEAR),
            [self::LOCALE => 'Nunavut Day']
        );
    }

    public function testHolidayType(): void
    {
        $this->assertHolidayType(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(self::ESTABLISHMENT_YEAR),
            Holiday::TYPE_OBSERVANCE
        );
    }
}
