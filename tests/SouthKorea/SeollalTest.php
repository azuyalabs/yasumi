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
 * Class for testing Seollal (Korean Lunar New Year's Day).
 */
class SeollalTest extends SouthKoreaBaseTestCase implements HolidayTestCase
{
    /** @var int Upper limit year for lunar calendar test. */
    public const LUNAR_UPPER_LIMIT = 2050;

    /**
     * Testing Seollal itself
     *
     * @throws \Exception
     */
    public function testSeollal(): void
    {
        // From 1985 to LUNAR_UPPER_LIMIT
        $year = static::generateRandomYear(1985, self::LUNAR_UPPER_LIMIT);
        $this->assertHoliday(
            self::REGION,
            'seollal',
            $year,
            new \DateTime(self::LUNAR_HOLIDAY['seollal'][$year], DateTimeZoneFactory::getDateTimeZone(self::TIMEZONE))
        );

        // Before 1985
        $this->assertNotHoliday(
            self::REGION,
            'seollal',
            static::generateRandomYear(null, 1984)
        );
    }

    /**
     * Testing Seollal's eve
     *
     * @throws \DateInvalidOperationException
     */
    public function testDayBeforeSeollal(): void
    {
        // From 1989 to LUNAR_UPPER_LIMIT
        $year = static::generateRandomYear(1989, self::LUNAR_UPPER_LIMIT);
        $this->assertHoliday(
            self::REGION,
            'dayBeforeSeollal',
            $year,
            (new \DateTime(self::LUNAR_HOLIDAY['seollal'][$year], DateTimeZoneFactory::getDateTimeZone(self::TIMEZONE)))->sub(new \DateInterval('P1D'))
        );

        // Before 1989
        $this->assertNotHoliday(
            self::REGION,
            'dayBeforeSeollal',
            static::generateRandomYear(null, 1988)
        );
    }

    /**
     * Testing the day after Seollal
     *
     * @throws \Exception
     */
    public function testDayAfterSeollal(): void
    {
        // From 1989 to LUNAR_UPPER_LIMIT
        $year = static::generateRandomYear(1989, self::LUNAR_UPPER_LIMIT);
        $this->assertHoliday(
            self::REGION,
            'dayAfterSeollal',
            $year,
            (new \DateTime(self::LUNAR_HOLIDAY['seollal'][$year], DateTimeZoneFactory::getDateTimeZone(self::TIMEZONE)))->add(new \DateInterval('P1D'))
        );

        // Before 1989
        $this->assertNotHoliday(
            self::REGION,
            'dayAfterSeollal',
            static::generateRandomYear(null, 1988)
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
            'dayBeforeSeollal',
            2016,
            new \DateTime('2016-2-10', DateTimeZoneFactory::getDateTimeZone(self::TIMEZONE))
        );
        $this->assertNotSubstituteHoliday(self::REGION, 'dayAfterSeollal', 2021);

        // By sunday
        $this->assertSubstituteHoliday(
            self::REGION,
            'dayBeforeSeollal',
            2033,
            new \DateTime('2033-2-2', DateTimeZoneFactory::getDateTimeZone(self::TIMEZONE))
        );
        $this->assertSubstituteHoliday(
            self::REGION,
            'seollal',
            2034,
            new \DateTime('2034-2-21', DateTimeZoneFactory::getDateTimeZone(self::TIMEZONE))
        );
        $this->assertSubstituteHoliday(
            self::REGION,
            'dayAfterSeollal',
            2024,
            new \DateTime('2024-2-12', DateTimeZoneFactory::getDateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests the translated name of the holiday defined in this test.
     *
     * @throws \Exception
     */
    public function testTranslation(): void
    {
        // From 1985 to 1988
        // Seollal itself
        $this->assertTranslatedHolidayName(
            self::REGION,
            'seollal',
            static::generateRandomYear(1985, 1988),
            [self::LOCALE => '민속의 날']
        );

        // From 1989 to LUNAR_UPPER_LIMIT
        // Seollal itself
        $this->assertTranslatedHolidayName(
            self::REGION,
            'seollal',
            static::generateRandomYear(1989, self::LUNAR_UPPER_LIMIT),
            [self::LOCALE => '설날']
        );

        // From 1989 to LUNAR_UPPER_LIMIT
        // Seollal's eve
        $this->assertTranslatedHolidayName(
            self::REGION,
            'dayBeforeSeollal',
            static::generateRandomYear(1989, self::LUNAR_UPPER_LIMIT),
            [self::LOCALE => '설날 연휴']
        );

        // From 1989 to LUNAR_UPPER_LIMIT
        // The day after Seollal
        $this->assertTranslatedHolidayName(
            self::REGION,
            'dayAfterSeollal',
            static::generateRandomYear(1989, self::LUNAR_UPPER_LIMIT),
            [self::LOCALE => '설날 연휴']
        );
    }

    /**
     * Tests type of the holiday defined in this test.
     *
     * @throws \Exception
     */
    public function testHolidayType(): void
    {
        // From 1985 to LUNAR_UPPER_LIMIT
        $this->assertHolidayType(
            self::REGION,
            'seollal',
            static::generateRandomYear(1985, self::LUNAR_UPPER_LIMIT),
            Holiday::TYPE_OFFICIAL
        );

        // From 1989 to LUNAR_UPPER_LIMIT
        $this->assertHolidayType(
            self::REGION,
            'dayBeforeSeollal',
            static::generateRandomYear(1989, self::LUNAR_UPPER_LIMIT),
            Holiday::TYPE_OFFICIAL
        );

        // From 1989 to LUNAR_UPPER_LIMIT
        $this->assertHolidayType(
            self::REGION,
            'dayAfterSeollal',
            static::generateRandomYear(1989, self::LUNAR_UPPER_LIMIT),
            Holiday::TYPE_OFFICIAL
        );
    }

}
