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
 * Class for testing Independence Movement Day in South Korea.
 */
class LiberationDayTest extends SouthKoreaBaseTestCase implements HolidayTestCase
{
    /**
     * The name of the holiday.
     */
    public const HOLIDAY = 'liberationDay';

    /**
     * The year in which the holiday was first established.
     */
    public const ESTABLISHMENT_YEAR = 1949;

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
            new \DateTime("$year-8-15", new \DateTimeZone(self::TIMEZONE))
        );
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
        $this->assertNotSubstituteHoliday(self::REGION, self::HOLIDAY, 2020);

        // Year 2021
        $this->assertSubstituteHoliday(
            self::REGION,
            self::HOLIDAY,
            2021,
            new \DateTime('2021-8-16', $tz)
        );

        // By saturday
        $this->assertSubstituteHoliday(
            self::REGION,
            self::HOLIDAY,
            2037,
            new \DateTime('2037-8-17', $tz)
        );

        // By sunday
        $this->assertSubstituteHoliday(
            self::REGION,
            self::HOLIDAY,
            2027,
            new \DateTime('2027-8-16', $tz)
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
            [self::LOCALE => '광복절']
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
