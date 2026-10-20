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

namespace Yasumi\tests\Indonesia;

use Yasumi\Holiday;
use Yasumi\Provider\Indonesia;
use Yasumi\tests\HolidayTestCase;

/**
 * Class for testing New Year's Day in Indonesia.
 *
 * Fixed date: 1 January.
 */
class NewYearsDayTest extends IndonesiaBaseTestCase implements HolidayTestCase
{
    public const HOLIDAY = 'newYearsDay';

    /** @throws \Exception */
    public function testHoliday(): void
    {
        $year = 2024;
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new \DateTime("{$year}-01-01", new \DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests that no holidays are defined before the establishment year.
     *
     * @throws \Exception
     */
    public function testHolidayBeforeEstablishment(): void
    {
        $this->assertNotHoliday(
            self::REGION,
            self::HOLIDAY,
            Indonesia::ESTABLISHMENT_YEAR - 1
        );
    }

    /** @throws \Exception */
    public function testTranslation(): void
    {
        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            static::generateRandomYear(Indonesia::ESTABLISHMENT_YEAR),
            [self::LOCALE => 'Tahun Baru Masehi']
        );
    }

    /** @throws \Exception */
    public function testHolidayType(): void
    {
        $this->assertHolidayType(
            self::REGION,
            self::HOLIDAY,
            static::generateRandomYear(Indonesia::ESTABLISHMENT_YEAR),
            Holiday::TYPE_OFFICIAL
        );
    }
}
