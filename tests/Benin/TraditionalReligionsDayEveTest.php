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
 * Class for testing the Thursday before the annual traditional religions festival in Benin.
 *
 * Law 2024-32 makes the Thursday before the second Friday of January a day off from 2025.
 */
class TraditionalReligionsDayEveTest extends BeninBaseTestCase implements HolidayTestCase
{
    /**
     * The key of the holiday.
     */
    public const HOLIDAY = 'traditionalReligionsDayEve';

    /**
     * The first year in which Law 2024-32 applies.
     */
    public const ESTABLISHMENT_YEAR = 2025;

    /**
     * Tests the Thursday before the second Friday of January.
     *
     * @param int    $year     the year to be tested
     * @param string $expected the expected date
     *
     * @throws \Exception
     */
    #[\PHPUnit\Framework\Attributes\DataProvider('ThursdayBeforeSecondFridayDataProvider')]
    public function testHoliday(int $year, string $expected): void
    {
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new \DateTime($expected, new \DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests that the holiday always falls on a Thursday.
     *
     * @throws \Exception
     */
    public function testDayOfWeek(): void
    {
        $this->assertDayOfWeek(self::REGION, self::HOLIDAY, static::generateRandomYear(self::ESTABLISHMENT_YEAR), 'Thursday');
    }

    /**
     * Tests that the holiday is not defined before Law 2024-32.
     *
     * @throws \Exception
     */
    public function testHolidayBeforeEstablishment(): void
    {
        $this->assertNotHoliday(self::REGION, self::HOLIDAY, self::ESTABLISHMENT_YEAR - 1);
    }

    /**
     * Tests the translated name of the holiday.
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
     * Tests the type of the holiday.
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
     * Returns the expected dates, including the official 2025 and 2026 dates
     * and a year in which January starts on a Friday.
     *
     * @return array<array{int, string}>
     */
    public static function ThursdayBeforeSecondFridayDataProvider(): array
    {
        return [
            [2025, '2025-01-09'],
            [2026, '2026-01-08'],
            [2027, '2027-01-07'],
        ];
    }
}
