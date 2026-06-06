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

namespace Yasumi\tests\SouthKorea;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\TestWith;
use Yasumi\Holiday;
use Yasumi\Provider\DateTimeZoneFactory;
use Yasumi\tests\HolidayTestCase;

/**
 * Class for testing Chuseok in South Korea.
 */
class ChuseokTest extends SouthKoreaBaseTestCase implements HolidayTestCase
{
    /**
     * The year of upper limit for tests of lunar date.
     */
    public const LUNAR_UPPER_LIMIT = 2050;

    /**
     * The year in which the holiday was first established.
     */
    public const ESTABLISHMENT_YEAR = 1949;

    /**
     * The year in which the day before Chuseok became a public holiday,
     * officially extending Chuseok into a multi-day holiday period.
     */
    public const EVE_EXPANSION_YEAR = 1989;

    /**
     * The year in which the day after Chuseok became a public holiday,
     * officially expanding Chuseok into a multi-day holiday period.
     */
    public const MORROW_EXPANSION_YEAR = 1986;

    /**
     * Tests the holiday defined in this test.
     *
     * @throws \Exception
     */
    public function testChuseok(): void
    {
        // From 1949 to LUNAR_UPPER_LIMIT
        $year = static::generateRandomYear(self::ESTABLISHMENT_YEAR, self::LUNAR_UPPER_LIMIT);
        $this->assertHoliday(
            self::REGION,
            'chuseok',
            $year,
            new \DateTime(self::LUNAR_HOLIDAY['chuseok'][$year], DateTimeZoneFactory::getDateTimeZone(self::TIMEZONE))
        );

        // Before 1949
        $this->assertNotHoliday(
            self::REGION,
            'chuseok',
            static::generateRandomYear(null, self::ESTABLISHMENT_YEAR - 1)
        );
    }

    public function testDayBeforeChuseok(): void
    {
        // From 1989 to LUNAR_UPPER_LIMIT
        $year = static::generateRandomYear(self::EVE_EXPANSION_YEAR, self::LUNAR_UPPER_LIMIT);
        $this->assertHoliday(
            self::REGION,
            'dayBeforeChuseok',
            $year,
            (new \DateTime(self::LUNAR_HOLIDAY['chuseok'][$year], DateTimeZoneFactory::getDateTimeZone(self::TIMEZONE)))->sub(new \DateInterval('P1D'))
        );

        // Before 1989
        $this->assertNotHoliday(
            self::REGION,
            'dayBeforeChuseok',
            static::generateRandomYear(null, self::EVE_EXPANSION_YEAR - 1)
        );
    }

    public function testDayAfterChuseok(): void
    {
        // From 1986 to LUNAR_UPPER_LIMIT
        $year = static::generateRandomYear(self::MORROW_EXPANSION_YEAR, self::LUNAR_UPPER_LIMIT);
        $this->assertHoliday(
            self::REGION,
            'dayAfterChuseok',
            $year,
            (new \DateTime(self::LUNAR_HOLIDAY['chuseok'][$year], DateTimeZoneFactory::getDateTimeZone(self::TIMEZONE)))->add(new \DateInterval('P1D'))
        );

        // Before 1986
        $this->assertNotHoliday(
            self::REGION,
            'dayAfterChuseok',
            static::generateRandomYear(null, self::MORROW_EXPANSION_YEAR - 1)
        );
    }

    /**
     * Tests the substitute holiday defined in this test (conflict with Sunday).
     *
     * @throws \Exception
     */
    #[DataProvider('SubstituteHolidayDataProvider')]
    public function testSubstituteHoliday(int $year, string $key, string $expected): void
    {
        $this->assertSubstituteHoliday(
            self::REGION,
            $key,
            $year,
            new \DateTime($expected, DateTimeZoneFactory::getDateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests the translated name of the holiday defined in this test.
     *
     * @throws \Exception
     */
    #[TestWith(['chuseok', self::ESTABLISHMENT_YEAR, self::LUNAR_UPPER_LIMIT, '추석'])]
    #[TestWith(['dayAfterChuseok', self::MORROW_EXPANSION_YEAR, self::LUNAR_UPPER_LIMIT, '추석 연휴'])]
    #[TestWith(['dayBeforeChuseok', self::EVE_EXPANSION_YEAR, self::LUNAR_UPPER_LIMIT, '추석 연휴'])]
    public function testTranslation(string $key = 'chuseok', int $lower = 1949, int $upper = self::LUNAR_UPPER_LIMIT, string $name = '추석'): void
    {
        $this->assertTranslatedHolidayName(
            self::REGION,
            $key,
            static::generateRandomYear($lower, $upper),
            [self::LOCALE => $name]
        );
    }

    /**
     * Tests type of the holiday defined in this test.
     *
     * @throws \Exception
     */
    #[TestWith(['chuseok', self::ESTABLISHMENT_YEAR])]
    #[TestWith(['dayAfterChuseok', self::MORROW_EXPANSION_YEAR])]
    #[TestWith(['dayBeforeChuseok', self::EVE_EXPANSION_YEAR])]
    public function testHolidayType(string $key = 'chuseok', int $lower = 1949): void
    {
        $this->assertHolidayType(
            self::REGION,
            $key,
            static::generateRandomYear($lower, self::LUNAR_UPPER_LIMIT),
            Holiday::TYPE_OFFICIAL
        );
    }

    public static function SubstituteHolidayDataProvider(): array
    {
        return [
            [2014, 'dayBeforeChuseok', '2014-09-10'],
            [2015, 'chuseok', '2015-09-29'],
            [2017, 'dayBeforeChuseok', '2017-10-06'],
            [2018, 'dayBeforeChuseok', '2018-09-26'],
            [2022, 'dayAfterChuseok', '2022-09-12'],
            [2025, 'dayBeforeChuseok', '2025-10-08'],
            [2028, 'chuseok', '2028-10-05'],
            [2029, 'dayAfterChuseok', '2029-09-24'],
            [2032, 'chuseok', '2032-09-21'],
            [2035, 'chuseok', '2035-09-18'],
            [2036, 'dayBeforeChuseok', '2036-10-06'],
            [2036, 'dayAfterChuseok', '2036-10-07'],
            [2038, 'dayBeforeChuseok', '2038-09-15'],
            [2039, 'chuseok', '2039-10-04'],
            [2039, 'dayAfterChuseok', '2039-10-05'],
            [2042, 'chuseok', '2042-09-30'],
            [2045, 'dayBeforeChuseok', '2045-09-27'],
            [2046, 'dayAfterChuseok', '2046-09-17'],
            [2047, 'dayBeforeChuseok', '2047-10-07'],
            [2049, 'dayAfterChuseok', '2049-09-13'],
        ];
    }
}
