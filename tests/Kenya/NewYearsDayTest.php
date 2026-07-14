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
use Yasumi\Provider\Kenya;
use Yasumi\tests\HolidayTestCase;

/**
 * Class for testing New Year's Day in Kenya.
 *
 * Fixed date: 1 January. Substituted when falling on a Sunday.
 */
class NewYearsDayTest extends KenyaBaseTestCase implements HolidayTestCase
{
    public const HOLIDAY = 'newYearsDay';

    /** @throws \Exception */
    public function testHoliday(): void
    {
        $year = 2024;
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new \DateTime("{$year}-01-01", new \DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests the substitute holiday when New Year's Day falls on a Sunday.
     *
     * @throws \Exception
     */
    public function testSubstituteHoliday(): void
    {
        // In 2023 New Year's Day falls on a Sunday, so Monday 2 January is a public holiday.
        $this->assertSubstituteHoliday(
            self::REGION,
            self::HOLIDAY,
            2023,
            new \DateTime('2023-01-02', new \DateTimeZone(self::TIMEZONE))
        );

        // In 2024 New Year's Day falls on a Monday, so no substitute holiday is given.
        $this->assertNotSubstituteHoliday(self::REGION, self::HOLIDAY, 2024);
    }

    /** @throws \Exception */
    public function testTranslation(): void
    {
        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            static::generateRandomYear(Kenya::ESTABLISHMENT_YEAR),
            [self::LOCALE => 'New Year’s Day']
        );
    }

    /** @throws \Exception */
    public function testHolidayType(): void
    {
        $this->assertHolidayType(
            self::REGION,
            self::HOLIDAY,
            static::generateRandomYear(Kenya::ESTABLISHMENT_YEAR),
            Holiday::TYPE_OFFICIAL
        );
    }
}
