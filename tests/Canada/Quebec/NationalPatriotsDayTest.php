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

namespace Yasumi\tests\Canada\Quebec;

use Yasumi\Holiday;
use Yasumi\tests\HolidayTestCase;

/**
 * Class for testing National Patriots' Day in Quebec (Canada).
 */
class NationalPatriotsDayTest extends QuebecBaseTestCase implements HolidayTestCase
{
    /**
     * The name of the holiday.
     */
    public const HOLIDAY = 'nationalPatriotsDay';

    /**
     * The year in which the holiday was first established.
     */
    public const ESTABLISHMENT_YEAR = 2003;

    /**
     * Tests National Patriots' Day on or after 2003. National Patriots' Day is celebrated on the last Monday on or
     * before May 24.
     *
     * @param int    $year     the year for which National Patriots' Day needs to be tested
     * @param string $expected the expected date of National Patriots' Day
     *
     * @throws \Exception
     */
    #[\PHPUnit\Framework\Attributes\DataProvider('nationalPatriotsDayDataProvider')]
    public function testNationalPatriotsDayOnAfter2003(int $year, string $expected): void
    {
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new \DateTime($expected, new \DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Returns a list of years and the expected dates of National Patriots' Day.
     *
     * The list covers years across centuries, as well as the years in which May 24th falls on a Monday.
     *
     * @return array<string, array{int, string}> list of years and expected dates
     */
    public static function nationalPatriotsDayDataProvider(): array
    {
        return [
            'in 2003' => [2003, '2003-05-19'],
            'in 2010 (May 24th on a Monday)' => [2010, '2010-05-24'],
            'in 2024' => [2024, '2024-05-20'],
            'in 2069' => [2069, '2069-05-20'],
            'in 2070' => [2070, '2070-05-19'],
            'in 2100 (May 24th on a Monday)' => [2100, '2100-05-24'],
        ];
    }

    /**
     * Tests National Patriots' Day before 2003.
     *
     * @throws \Exception
     */
    public function testNationalPatriotsDayBefore2003(): void
    {
        $this->assertNotHoliday(
            self::REGION,
            self::HOLIDAY,
            static::generateRandomYear(1000, self::ESTABLISHMENT_YEAR - 1)
        );
    }

    /**
     * Tests the translated name of the holiday defined in this test.
     *
     * @throws \Exception
     */
    public function testTranslation(): void
    {
        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            static::generateRandomYear(self::ESTABLISHMENT_YEAR),
            [self::LOCALE => 'National Patriot’s Day']
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
            static::generateRandomYear(self::ESTABLISHMENT_YEAR),
            Holiday::TYPE_OFFICIAL
        );
    }
}
