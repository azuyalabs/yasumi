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
 * Class for testing Gaecheonjeol (National Foundation Day) in South Korea.
 */
class GaecheonjeolTest extends SouthKoreaBaseTestCase implements HolidayTestCase
{
    /**
     * The name of the holiday.
     */
    public const HOLIDAY = 'nationalFoundationDay';

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
            new \DateTime("$year-10-3", new \DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests the substitute holiday defined in this test (conflict with Chuseok).
     *
     * @throws \Exception
     */
    public function testSubstituteByChuseok(): void
    {
        $tz = new \DateTimeZone(self::TIMEZONE);

        $this->assertHoliday(
            self::REGION,
            'chuseok',
            2028,
            new \DateTime('2028-10-3', $tz)
        );
        $this->assertHoliday(
            self::REGION,
            'dayBeforeChuseok',
            2036,
            new \DateTime('2036-10-3', $tz)
        );
        // Chuseok will be substitute instead of Gaecheonjeol.
        $this->assertNotSubstituteHoliday(self::REGION, self::HOLIDAY, 2028);
        $this->assertNotSubstituteHoliday(self::REGION, self::HOLIDAY, 2036);
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
        $this->assertNotSubstituteHoliday(self::REGION, self::HOLIDAY, 2015);
        $this->assertNotSubstituteHoliday(self::REGION, self::HOLIDAY, 2020);
        $this->assertSubstituteHoliday(
            self::REGION,
            self::HOLIDAY,
            2021,
            new \DateTime('2021-10-4', $tz)
        );

        // By saturday
        $this->assertSubstituteHoliday(
            self::REGION,
            self::HOLIDAY,
            2026,
            new \DateTime('2026-10-5', $tz)
        );

        // By sunday
        $this->assertSubstituteHoliday(
            self::REGION,
            self::HOLIDAY,
            2032,
            new \DateTime('2032-10-4', $tz)
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
            [self::LOCALE => '개천절']
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
