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
 * Class for testing Utamaduni Day in Kenya.
 *
 * Fixed date: 10 October. Moi Day was renamed Utamaduni Day in 2020, which in
 * turn was renamed Mazingira Day in 2024.
 */
class UtamaduniDayTest extends KenyaBaseTestCase implements HolidayTestCase
{
    public const HOLIDAY = 'utamaduniDay';

    public const ESTABLISHMENT_YEAR = 2020;

    /** @throws \Exception */
    public function testHoliday(): void
    {
        $year = 2022;
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new \DateTime("{$year}-10-10", new \DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests that Utamaduni Day is not observed before 2020 (Moi Day) and
     * after 2023 (Mazingira Day).
     *
     * @throws \Exception
     */
    public function testHolidayInYearsNotObserved(): void
    {
        $this->assertNotHoliday(self::REGION, self::HOLIDAY, self::ESTABLISHMENT_YEAR - 1);
        $this->assertNotHoliday(self::REGION, self::HOLIDAY, 2024);
    }

    /**
     * Tests the substitute holiday when Utamaduni Day falls on a Sunday.
     *
     * @throws \Exception
     */
    public function testSubstituteHoliday(): void
    {
        // In 2021 Utamaduni Day falls on a Sunday, so Monday 11 October is a public holiday.
        $this->assertSubstituteHoliday(
            self::REGION,
            self::HOLIDAY,
            2021,
            new \DateTime('2021-10-11', new \DateTimeZone(self::TIMEZONE))
        );

        // In 2022 Utamaduni Day falls on a Monday, so no substitute holiday is given.
        $this->assertNotSubstituteHoliday(self::REGION, self::HOLIDAY, 2022);
    }

    /** @throws \Exception */
    public function testTranslation(): void
    {
        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            static::generateRandomYear(self::ESTABLISHMENT_YEAR, 2023),
            [self::LOCALE => 'Utamaduni Day']
        );
    }

    /** @throws \Exception */
    public function testHolidayType(): void
    {
        $this->assertHolidayType(
            self::REGION,
            self::HOLIDAY,
            static::generateRandomYear(self::ESTABLISHMENT_YEAR, 2023),
            Holiday::TYPE_OFFICIAL
        );
    }
}
