<?php

declare(strict_types = 1);

/**
 * This file is part of the 'Yasumi' package.
 *
 * The easy PHP Library for calculating holidays.
 *
 * Copyright (c) 2025 Magic Web Group
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Art Kurbakov <admin at mgwebgroup dot com>
 */

namespace Yasumi\tests\USA\NYSE;

use Yasumi\Holiday;
use Yasumi\tests\HolidayTestCase;
use Yasumi\tests\USA\USABaseTestCase;

/**
 * Class to test Juneteenth.
 */
class JuneteenthTest extends USABaseTestCase
{
    /**
     * Country (name) to be tested.
     */
    public const REGION = 'USA/NYSE';

    /**
     * The name of the holiday.
     */
    public const HOLIDAY = 'juneteenth';

    /**
     * The year in which the holiday was first established for NYSE.
     */
    public const ESTABLISHMENT_YEAR = 2022;

    /**
     * Tests Juneteenth on or after 2022. For NYSE Juneteenth is celebrated since 2022 on June 19th.
     *
     * @throws \Exception
     */
    public function testJuneteenthOnAfter2022(): void
    {
        $year = 2023;
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new \DateTime("{$year}-6-19", new \DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests Juneteenth on or after 2022 when substituted on Monday (when Juneteenth falls on Sunday).
     *
     * @throws \Exception
     */
    public function testJuneteenthOnAfter2022SubstitutedMonday(): void
    {
        $year = 2022;
        $this->assertSubstituteHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new \DateTime("{$year}-6-20", new \DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests Juneteenth on or after 2022 when substituted on Friday (when Juneteenth falls on Saturday).
     *
     * @throws \Exception
     */
    public function testJuneteenthOnAfter2022SubstitutedFriday(): void
    {
        $year = 2027;
        $this->assertSubstituteHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new \DateTime("{$year}-6-18", new \DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests Juneteenth before 2022. For NYSE Juneteenth is celebrated since 2022 on June 19th.
     *
     * @throws \Exception
     */
    public function testJuneteenthBefore2022(): void
    {
        $this->assertNotHoliday(
           	self::REGION,
            self::HOLIDAY,
            self::ESTABLISHMENT_YEAR - 1
        );
    }
}
