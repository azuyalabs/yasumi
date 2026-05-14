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

//    public function testDayAfterChuseok(): void
//    {
//        // From 1986 to LUNAR_UPPER_LIMIT
//        $year = static::generateRandomYear(1986, self::LUNAR_UPPER_LIMIT);
//        $this->assertHoliday(
//            self::REGION,
//            'dayAfterChuseok',
//            $year,
//            (new \DateTime(self::LUNAR_HOLIDAY['chuseok'][$year], DateTimeZoneFactory::getDateTimeZone(self::TIMEZONE)))->sub(new \DateInterval('P1D'))
//        );
//
//        // Before 1986
//        $this->assertNotHoliday(
//            self::REGION,
//            'dayAfterChuseok',
//            static::generateRandomYear(null, 1985)
//        );
//    }

    /**
     * Tests the substitute holiday defined in this test (conflict with Gaecheonjeol).
     *
     * @throws \Exception
     */
    public function testSubstituteHolidayByGaecheonjeol(): void
    {
        $tz = new \DateTimeZone(self::TIMEZONE);

        foreach ([2017, 2028, 2036, 2039] as $year) {
            $this->assertHoliday(
                self::REGION,
                'nationalFoundationDay',
                $year,
                new \DateTime("{$year}-10-3", $tz)
            );
        }

        $this->assertSubstituteHoliday(
            self::REGION,
            'dayBeforeChuseok',
            2017,
            new \DateTime('2017-10-6', $tz)
        );
        $this->assertSubstituteHoliday(
            self::REGION,
            'chuseok',
            2028,
            new \DateTime('2028-10-5', $tz)
        );
        $this->assertSubstituteHoliday(
            self::REGION,
            'dayBeforeChuseok',
            2036,
            new \DateTime('2036-10-6', $tz)
        );
        $this->assertSubstituteHoliday(
            self::REGION,
            'dayAfterChuseok',
            2039,
            new \DateTime('2039-10-5', $tz)
        );
    }

    /**
     * Tests the substitute holiday defined in this test (conflict with Sunday).
     *
     * @throws \Exception
     */
    public function testSubstituteHoliday(): void
    {
        $tz = new \DateTimeZone(self::TIMEZONE);

        // Before 2022
        $this->assertSubstituteHoliday(
            self::REGION,
            'dayBeforeChuseok',
            2014,
            new \DateTime('2014-9-10', $tz)
        );

        // By sunday
        $this->assertSubstituteHoliday(
            self::REGION,
            'dayBeforeChuseok',
            2025,
            new \DateTime('2025-10-8', $tz)
        );
        $this->assertSubstituteHoliday(
            self::REGION,
            'chuseok',
            2032,
            new \DateTime('2032-9-21', $tz)
        );
        $this->assertSubstituteHoliday(
            self::REGION,
            'dayAfterChuseok',
            2036,
            new \DateTime('2036-10-7', $tz)
        );
    }

    /**
     * Tests the holiday defined in this test before establishment.
     *
     * @throws \Exception
     */
    public function testHolidayBeforeEstablishment(): void
    {
        $this->assertNotHoliday(
            self::REGION,
            self::HOLIDAY,
            static::generateRandomYear(1000, 1949 - 1)
        );
    }

    /**
     * Tests the translated name of the holiday defined in this test.
     *
     * @throws \Exception
     */
    public function testTranslation(): void
    {
        $year = static::generateRandomYear(1949, self::LUNAR_UPPER_LIMIT);

        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            $year,
            [self::LOCALE => '추석']
        );

        if ($year >= 1986) {
            $this->assertTranslatedHolidayName(
                self::REGION,
                'dayAfterChuseok',
                $year,
                [self::LOCALE => '추석 연휴']
            );
        }

        if ($year >= 1989) {
            $this->assertTranslatedHolidayName(
                self::REGION,
                'dayBeforeChuseok',
                $year,
                [self::LOCALE => '추석 연휴']
            );
        }
    }

    /**
     * Tests type of the holiday defined in this test.
     *
     * @throws \Exception
     */
    public function testHolidayType(): void
    {
        $year = static::generateRandomYear(1949, self::LUNAR_UPPER_LIMIT);

        $this->assertHolidayType(
            self::REGION,
            self::HOLIDAY,
            $year,
            Holiday::TYPE_OFFICIAL
        );

        if ($year >= 1986) {
            $this->assertHolidayType(
                self::REGION,
                'dayAfterChuseok',
                $year,
                Holiday::TYPE_OFFICIAL
            );
        }

        if ($year >= 1989) {
            $this->assertHolidayType(
                self::REGION,
                'dayBeforeChuseok',
                $year,
                Holiday::TYPE_OFFICIAL
            );
        }
    }
}
