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

namespace Yasumi\tests\Benin;

use Yasumi\Holiday;
use Yasumi\tests\HolidayTestCase;

/**
 * Class for testing the annual traditional religions festival (Vodoun Festival) in Benin.
 *
 * 10 January from 1998 (Law 97-031); the second Friday of January from 2025 (Law 2024-32).
 */
class TraditionalReligionsDayTest extends BeninBaseTestCase implements HolidayTestCase
{
    /**
     * The key of the holiday.
     */
    public const HOLIDAY = 'traditionalReligionsDay';

    /**
     * The year in which the festival was first celebrated.
     */
    public const ESTABLISHMENT_YEAR = 1998;

    /**
     * Tests the festival on 10 January under Law 97-031, including its first and last year.
     *
     * @param int $year the year to be tested
     *
     * @throws \Exception
     */
    #[\PHPUnit\Framework\Attributes\DataProvider('TenthOfJanuaryDataProvider')]
    public function testHolidayOnTenthOfJanuary(int $year): void
    {
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new \DateTime("{$year}-01-10", new \DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests the festival on the second Friday of January under Law 2024-32.
     *
     * @param int    $year     the year to be tested
     * @param string $expected the expected date
     *
     * @throws \Exception
     */
    #[\PHPUnit\Framework\Attributes\DataProvider('SecondFridayOfJanuaryDataProvider')]
    public function testHolidayOnSecondFridayOfJanuary(int $year, string $expected): void
    {
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new \DateTime($expected, new \DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests that the festival always falls on a Friday from 2025.
     *
     * @throws \Exception
     */
    public function testDayOfWeekFrom2025(): void
    {
        $this->assertDayOfWeek(self::REGION, self::HOLIDAY, static::generateRandomYear(2025), 'Friday');
    }

    /**
     * Tests that the festival is not a holiday before it was instituted.
     *
     * @throws \Exception
     */
    public function testHolidayBeforeEstablishment(): void
    {
        $this->assertNotHoliday(self::REGION, self::HOLIDAY, self::ESTABLISHMENT_YEAR - 1);
    }

    /**
     * Tests the translated name of the festival.
     *
     * @throws \Exception
     */
    public function testTranslation(): void
    {
        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            static::generateRandomYear(self::ESTABLISHMENT_YEAR),
            [self::LOCALE => 'Fête annuelle des religions traditionnelles', 'en' => 'Vodoun Festival']
        );
    }

    /**
     * Tests the type of the festival.
     *
     * @throws \Exception
     */
    public function testHolidayType(): void
    {
        $this->assertHolidayType(
            self::REGION,
            self::HOLIDAY,
            static::generateRandomYear(self::ESTABLISHMENT_YEAR),
            Holiday::TYPE_OFFICIAL
        );
    }

    /**
     * Returns years under Law 97-031: the first, a random one in between and the last.
     *
     * @return array<array{int}>
     *
     * @throws \Exception
     */
    public static function TenthOfJanuaryDataProvider(): array
    {
        return [
            [self::ESTABLISHMENT_YEAR],
            [static::generateRandomYear(self::ESTABLISHMENT_YEAR + 1, 2023)],
            [2024],
        ];
    }

    /**
     * Returns the expected dates under Law 2024-32, including the official 2025 and 2026 dates
     * and a year in which January starts on a Friday.
     *
     * @return array<array{int, string}>
     */
    public static function SecondFridayOfJanuaryDataProvider(): array
    {
        return [
            [2025, '2025-01-10'],
            [2026, '2026-01-09'],
            [2027, '2027-01-08'],
        ];
    }
}
