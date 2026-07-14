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
 * Class for testing Mazingira Day in Kenya.
 *
 * Fixed date: 10 October. Utamaduni Day was renamed Mazingira Day by the
 * Statute Law (Miscellaneous Amendments) Act, 2024.
 */
class MazingiraDayTest extends KenyaBaseTestCase implements HolidayTestCase
{
    public const HOLIDAY = 'mazingiraDay';

    public const ESTABLISHMENT_YEAR = 2024;

    /** @throws \Exception */
    public function testHoliday(): void
    {
        $year = 2024;
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new \DateTime("{$year}-10-10", new \DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests that Mazingira Day is not observed before its establishment.
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
     * Tests the substitute holiday when Mazingira Day falls on a Sunday.
     *
     * @throws \Exception
     */
    public function testSubstituteHoliday(): void
    {
        // In 2027 Mazingira Day falls on a Sunday, so Monday 11 October is a public holiday.
        $this->assertSubstituteHoliday(
            self::REGION,
            self::HOLIDAY,
            2027,
            new \DateTime('2027-10-11', new \DateTimeZone(self::TIMEZONE))
        );

        // In 2024 Mazingira Day falls on a Thursday, so no substitute holiday is given.
        $this->assertNotSubstituteHoliday(self::REGION, self::HOLIDAY, 2024);
    }

    /** @throws \Exception */
    public function testTranslation(): void
    {
        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            static::generateRandomYear(self::ESTABLISHMENT_YEAR),
            [self::LOCALE => 'Mazingira Day']
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
