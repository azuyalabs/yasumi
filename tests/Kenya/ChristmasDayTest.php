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
 * Class for testing Christmas Day in Kenya.
 *
 * Fixed date: 25 December. When it falls on a Sunday, the substitute day is
 * Tuesday 27 December, as Monday 26 December is already a public holiday
 * (Boxing Day).
 */
class ChristmasDayTest extends KenyaBaseTestCase implements HolidayTestCase
{
    public const HOLIDAY = 'christmasDay';

    /** @throws \Exception */
    public function testHoliday(): void
    {
        $year = 2024;
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new \DateTime("{$year}-12-25", new \DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests the substitute holiday when Christmas Day falls on a Sunday.
     *
     * As Monday 26 December is already a public holiday (Boxing Day), the
     * substitute day is given on Tuesday 27 December.
     *
     * @throws \Exception
     */
    public function testSubstituteHoliday(): void
    {
        // In 2022 Christmas Day falls on a Sunday, so Tuesday 27 December is a public holiday.
        $this->assertSubstituteHoliday(
            self::REGION,
            self::HOLIDAY,
            2022,
            new \DateTime('2022-12-27', new \DateTimeZone(self::TIMEZONE))
        );

        // In 2021 Christmas Day falls on a Saturday, so no substitute holiday is given.
        $this->assertNotSubstituteHoliday(self::REGION, self::HOLIDAY, 2021);
    }

    /** @throws \Exception */
    public function testTranslation(): void
    {
        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            static::generateRandomYear(Kenya::ESTABLISHMENT_YEAR),
            [self::LOCALE => 'Christmas Day']
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
