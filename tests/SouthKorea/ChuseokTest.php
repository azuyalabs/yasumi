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
     * The name of the holiday.
     */
    public const HOLIDAY = 'chuseok';

    /**
     * The year of upper limit for tests of lunar date.
     */
    public const LUNAR_UPPER_LIMIT = 2050;

    /**
     * Tests the holiday defined in this test.
     *
     * @throws \Exception
     */
    public function testChuseok(): void
    {
        // From 1949 to LUNAR_UPPER_LIMIT
        $year = static::generateRandomYear(1949, self::LUNAR_UPPER_LIMIT);
        $this->assertHoliday(
            self::REGION,
            'chuseok',
            $year,
            new \DateTime(self::LUNAR_HOLIDAY['chuseok'][$year], DateTimeZoneFactory::getDateTimeZone(self::TIMEZONE))
        );
    }

    public function testDayBeforeChuseok(): void
    {
        // From 1989 to LUNAR_UPPER_LIMIT
        $year = static::generateRandomYear(1989, self::LUNAR_UPPER_LIMIT);
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
            static::generateRandomYear(null, 1988)
        );
    }

    public function testDayAfterChuseok(): void
    {
        // From 1986 to LUNAR_UPPER_LIMIT
        $year = static::generateRandomYear(1986, self::LUNAR_UPPER_LIMIT);
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
            static::generateRandomYear(null, 1985)
        );
    }

    /**
     * Tests the substitute holiday defined in this test (conflict with Gaecheonjeol).
     *
     * @throws \Exception
     */
    public function testSubstituteHolidayByGaecheonjeol(): void
    {
        foreach ([2017, 2028, 2036, 2039] as $year) {
            $this->assertHoliday(
                self::REGION,
                'nationalFoundationDay',
                $year,
                new \DateTime("{$year}-10-3", DateTimeZoneFactory::getDateTimeZone(self::TIMEZONE))
            );
        }

        $this->assertSubstituteHoliday(
            self::REGION,
            'dayBeforeChuseok',
            2017,
            new \DateTime('2017-10-6', DateTimeZoneFactory::getDateTimeZone(self::TIMEZONE))
        );
        $this->assertSubstituteHoliday(
            self::REGION,
            'chuseok',
            2028,
            new \DateTime('2028-10-5', DateTimeZoneFactory::getDateTimeZone(self::TIMEZONE))
        );
        $this->assertSubstituteHoliday(
            self::REGION,
            'dayBeforeChuseok',
            2036,
            new \DateTime('2036-10-6', DateTimeZoneFactory::getDateTimeZone(self::TIMEZONE))
        );
        $this->assertSubstituteHoliday(
            self::REGION,
            'dayAfterChuseok',
            2039,
            new \DateTime('2039-10-5', DateTimeZoneFactory::getDateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests the substitute holiday defined in this test (conflict with Sunday).
     *
     * @throws \Exception
     */
    public function testSubstituteHoliday(): void
    {
        // Before 2022
        $this->assertSubstituteHoliday(
            self::REGION,
            'dayBeforeChuseok',
            2014,
            new \DateTime('2014-9-10', DateTimeZoneFactory::getDateTimeZone(self::TIMEZONE))
        );

        // By sunday
        $this->assertSubstituteHoliday(
            self::REGION,
            'dayBeforeChuseok',
            2025,
            new \DateTime('2025-10-8', DateTimeZoneFactory::getDateTimeZone(self::TIMEZONE))
        );
        $this->assertSubstituteHoliday(
            self::REGION,
            'chuseok',
            2032,
            new \DateTime('2032-9-21', DateTimeZoneFactory::getDateTimeZone(self::TIMEZONE))
        );
        $this->assertSubstituteHoliday(
            self::REGION,
            'dayAfterChuseok',
            2036,
            new \DateTime('2036-10-7', DateTimeZoneFactory::getDateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests the translated name of the holiday defined in this test.
     *
     * @throws \Exception
     */
    #[TestWith([self::HOLIDAY, 1949, self::LUNAR_UPPER_LIMIT, '추석'])]
    #[TestWith(['dayAfterChuseok', 1986, self::LUNAR_UPPER_LIMIT, '추석 연휴'])]
    #[TestWith(['dayBeforeChuseok', 1989, self::LUNAR_UPPER_LIMIT, '추석 연휴'])]
    public function testTranslation(string $key = self::HOLIDAY, int $lower = 1949, int $upper = self::LUNAR_UPPER_LIMIT, string $name = '추석'): void
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
    #[TestWith([self::HOLIDAY, 1949])]
    #[TestWith(['dayAfterChuseok', 1986])]
    #[TestWith(['dayBeforeChuseok', 1989])]
    public function testHolidayType(string $key = self::HOLIDAY, int $lower = 1949): void
    {
        $this->assertHolidayType(
            self::REGION,
            $key,
            static::generateRandomYear($lower, self::LUNAR_UPPER_LIMIT),
            Holiday::TYPE_OFFICIAL
        );
    }
}
