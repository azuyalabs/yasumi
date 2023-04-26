<?php

declare(strict_types=1);

/*
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 - 2023 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <me at sachatelgenhof dot com>
 */

namespace Yasumi\tests\SouthKorea;

use Yasumi\Holiday;
use Yasumi\tests\HolidayTestCase;

/**
 * Class for testing Children's Day in South Korea.
 */
class ChildrensDayTest extends SouthKoreaBaseTestCase implements HolidayTestCase
{
    /**
     * The name of the holiday.
     */
    public const HOLIDAY = 'childrensDay';

    /**
     * The year in which the holiday was first established.
     */
    public const ESTABLISHMENT_YEAR = 1970;

    /**
     * Tests the holiday defined in this test.
     *
     * @throws \Exception
     */
    public function testHoliday(): void
    {
        $year = $this->generateRandomYear(self::ESTABLISHMENT_YEAR);
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new \DateTime("$year-5-5", new \DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests the substitute holiday defined in this test (conflict with Buddha's Birthday).
     *
     * @throws \Exception
     */
    public function testSubstituteHolidayByBuddhasBirthday(): void
    {
        $tz = new \DateTimeZone(self::TIMEZONE);

        foreach ([2025, 2044] as $year) {
            $this->assertHoliday(
                self::REGION,
                'buddhasBirthday',
                $year,
                new \DateTime("$year-5-5", $tz)
            );

            $this->assertSubstituteHoliday(
                self::REGION,
                'buddhasBirthday',
                $year,
                new \DateTime("$year-5-6", $tz)
            );
        }
    }

    /**
     * Tests the substitute holiday defined in this test.
     *
     * @throws \Exception
     */
    public function testSubstituteHoliday(): void
    {
        $tz = new \DateTimeZone(self::TIMEZONE);

        // Before 2022
        $this->assertNotSubstituteHoliday(self::REGION, self::HOLIDAY, 2013);
        $this->assertSubstituteHoliday(
            self::REGION,
            self::HOLIDAY,
            2019,
            new \DateTime('2019-5-6', $tz)
        );

        // By saturday
        $this->assertSubstituteHoliday(
            self::REGION,
            self::HOLIDAY,
            2029,
            new \DateTime('2029-5-7', $tz)
        );

        // By sunday
        $this->assertSubstituteHoliday(
            self::REGION,
            self::HOLIDAY,
            2024,
            new \DateTime('2024-5-6', $tz)
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
            $this->generateRandomYear(1000, self::ESTABLISHMENT_YEAR - 1)
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
            $this->generateRandomYear(self::ESTABLISHMENT_YEAR),
            [self::LOCALE => '어린이날']
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
            $this->generateRandomYear(self::ESTABLISHMENT_YEAR),
            Holiday::TYPE_OFFICIAL
        );
    }
}
