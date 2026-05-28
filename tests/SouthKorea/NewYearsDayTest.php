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
 * Class for testing New Year's Day.
 */
class NewYearsDayTest extends SouthKoreaBaseTestCase implements HolidayTestCase
{
    /**
     * Test january 1 (New Year's Day).
     *
     * @throws \Exception
     */
    public function testNewYearsDay(): void
    {
        // From 1949 onwards.
        $year = static::generateRandomYear(1949);
        $this->assertHoliday(
            self::REGION,
            'newYearsDay',
            $year,
            new \DateTime("{$year}-1-1", DateTimeZoneFactory::getDateTimeZone(self::TIMEZONE))
        );

        // Before 1949
        $this->assertNotHoliday(
            self::REGION,
            'newYearsDay',
            static::generateRandomYear(null, 1948)
        );
    }

    /**
     * Test January 2.
     *
     * In effect from 1949 to 1998, and removed starting in 1999.
     *
     * @throws \Exception
     */
    public function testDayAfterNewYearsDay(): void
    {
        // From 1949 to 1998
        $year = static::generateRandomYear(1949, 1998);
        $this->assertHoliday(
            self::REGION,
            'dayAfterNewYearsDay',
            $year,
            new \DateTime("{$year}-1-2", DateTimeZoneFactory::getDateTimeZone(self::TIMEZONE))
        );

        // From 1999 onwards.
        $this->assertNotHoliday(
            self::REGION,
            'dayAfterNewYearsDay',
            static::generateRandomYear(1999),
        );

        // Before 1949
        $this->assertNotHoliday(
            self::REGION,
            'dayAfterNewYearsDay',
            static::generateRandomYear(null, 1948),
        );
    }

    /**
     * Test January 3.
     *
     * In effect from 1949 to 1989, and removed starting in 1990.
     *
     * @throws \Exception
     */
    public function testTwoDaysLaterNewYearsDay(): void
    {
        // From 1949 to 1989
        $year = static::generateRandomYear(1949, 1989);
        $this->assertHoliday(
            self::REGION,
            'twoDaysLaterNewYearsDay',
            $year,
            new \DateTime("{$year}-1-3", DateTimeZoneFactory::getDateTimeZone(self::TIMEZONE))
        );

        // From 1990 onwards.
        $this->assertNotHoliday(
            self::REGION,
            'twoDaysLaterNewYearsDay',
            static::generateRandomYear(1990),
        );
    }

    /**
     * Test that there are no alternative holidays.
     *
     * Alternative holidays do not apply to New Year's Day-related holidays.
     *
     * @throws \Exception
     */
    #[TestWith(['newYearsDay'])]
    #[TestWith(['dayAfterNewYearsDay'])]
    #[TestWith(['twoDaysLaterNewYearsDay'])]
    public function testSubstituteHoliday(string $key): void
    {
        $this->assertNotSubstituteHoliday(self::REGION, $key, static::generateRandomYear());
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
            'newYearsDay',
            static::generateRandomYear(1949),
            [self::LOCALE => '새해']
        );

        $this->assertTranslatedHolidayName(
            self::REGION,
            'dayAfterNewYearsDay',
            static::generateRandomYear(1949, 1998),
            [self::LOCALE => '새해 연휴']
        );

        $this->assertTranslatedHolidayName(
            self::REGION,
            'twoDaysLaterNewYearsDay',
            static::generateRandomYear(1949, 1989),
            [self::LOCALE => '새해 연휴']
        );
    }

    public function testHolidayType(): void
    {
        $this->assertHolidayType(
            self::REGION,
            'newYearsDay',
            static::generateRandomYear(1949),
            Holiday::TYPE_OFFICIAL
        );

        $this->assertHolidayType(
            self::REGION,
            'dayAfterNewYearsDay',
            static::generateRandomYear(1949, 1998),
            Holiday::TYPE_OFFICIAL
        );

        $this->assertHolidayType(
            self::REGION,
            'twoDaysLaterNewYearsDay',
            static::generateRandomYear(1949, 1989),
            Holiday::TYPE_OFFICIAL
        );
    }
}
