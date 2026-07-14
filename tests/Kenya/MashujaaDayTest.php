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

namespace Yasumi\tests\Kenya;

use Yasumi\Holiday;
use Yasumi\tests\HolidayTestCase;

/**
 * Class for testing Mashujaa Day in Kenya.
 *
 * Fixed date: 20 October. Known as Kenyatta Day until the promulgation of the
 * Constitution of Kenya in August 2010.
 */
class MashujaaDayTest extends KenyaBaseTestCase implements HolidayTestCase
{
    public const HOLIDAY = 'mashujaaDay';

    public const ESTABLISHMENT_YEAR = 2010;

    /** @throws \Exception */
    public function testHoliday(): void
    {
        $year = 2023;
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new \DateTime("{$year}-10-20", new \DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests that Mashujaa Day is not observed before its establishment
     * (the day was known as Kenyatta Day).
     *
     * @throws \Exception
     */
    public function testHolidayBeforeEstablishment(): void
    {
        $this->assertNotHoliday(
            self::REGION,
            self::HOLIDAY,
            self::ESTABLISHMENT_YEAR - 1
        );
    }

    /**
     * Tests the substitute holiday when Mashujaa Day falls on a Sunday.
     *
     * @throws \Exception
     */
    public function testSubstituteHoliday(): void
    {
        // In 2024 Mashujaa Day falls on a Sunday, so Monday 21 October is a public holiday.
        $this->assertSubstituteHoliday(
            self::REGION,
            self::HOLIDAY,
            2024,
            new \DateTime('2024-10-21', new \DateTimeZone(self::TIMEZONE))
        );

        // In 2023 Mashujaa Day falls on a Friday, so no substitute holiday is given.
        $this->assertNotSubstituteHoliday(self::REGION, self::HOLIDAY, 2023);
    }

    /** @throws \Exception */
    public function testTranslation(): void
    {
        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            static::generateRandomYear(self::ESTABLISHMENT_YEAR),
            [self::LOCALE => 'Mashujaa Day']
        );
    }

    /** @throws \Exception */
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
