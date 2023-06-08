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
 * Class for testing New Year's Day in South Korea.
 */
class NewYearsDayTest extends SouthKoreaBaseTestCase implements HolidayTestCase
{
    /**
     * The name of the holiday.
     */
    public const HOLIDAY = 'newYearsDay';

    /**
     * The year in which the holiday was first established.
     */
    public const ESTABLISHMENT_YEAR = 1950;

    /**
     * Tests the holiday defined in this test.
     *
     * @throws \Exception
     */
    public function testHoliday(): void
    {
        $year = $this->generateRandomYear(self::ESTABLISHMENT_YEAR);
        $date = new \DateTime("$year-1-1", new \DateTimeZone(self::TIMEZONE));

        // New Year's Day
        $this->assertHoliday(self::REGION, self::HOLIDAY, $year, $date);

        // Day after New Year's Day
        if ($year <= 1998) {
            $this->assertHoliday(
                self::REGION,
                'dayAfterNewYearsDay',
                $year,
                (clone $date)->add(new \DateInterval('P1D'))
            );
        }

        // Two days later New Year's Day
        if ($year <= 1990) {
            $this->assertHoliday(
                self::REGION,
                'twoDaysLaterNewYearsDay',
                $year,
                (clone $date)->add(new \DateInterval('P2D'))
            );
        }
    }

    /**
     * Tests the holiday defined in this test after removal.
     *
     * @throws \Exception
     */
    public function testHolidayAfterRemoval(): void
    {
        $this->assertNotHoliday(
            self::REGION,
            'dayAfterNewYearsDay',
            $this->generateRandomYear(1999)
        );
        $this->assertNotHoliday(
            self::REGION,
            'twoDaysLaterNewYearsDay',
            $this->generateRandomYear(1991)
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
            [self::LOCALE => '새해']
        );
        $this->assertTranslatedHolidayName(
            self::REGION,
            'dayAfterNewYearsDay',
            $this->generateRandomYear(self::ESTABLISHMENT_YEAR, 1998),
            [self::LOCALE => '새해 연휴']
        );
        $this->assertTranslatedHolidayName(
            self::REGION,
            'twoDaysLaterNewYearsDay',
            $this->generateRandomYear(self::ESTABLISHMENT_YEAR, 1990),
            [self::LOCALE => '새해 연휴']
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
        $this->assertHolidayType(
            self::REGION,
            'dayAfterNewYearsDay',
            $this->generateRandomYear(self::ESTABLISHMENT_YEAR, 1998),
            Holiday::TYPE_OFFICIAL
        );
        $this->assertHolidayType(
            self::REGION,
            'twoDaysLaterNewYearsDay',
            $this->generateRandomYear(self::ESTABLISHMENT_YEAR, 1990),
            Holiday::TYPE_OFFICIAL
        );
    }
}
