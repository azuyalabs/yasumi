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
 * Class for testing Jamhuri Day in Kenya.
 *
 * Fixed date: 12 December. Commemorates the day Kenya became a republic in
 * 1964 and the day Kenya obtained its independence in 1963.
 */
class JamhuriDayTest extends KenyaBaseTestCase implements HolidayTestCase
{
    public const HOLIDAY = 'jamhuriDay';

    /** @throws \Exception */
    public function testHoliday(): void
    {
        $year = 2024;
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new \DateTime("{$year}-12-12", new \DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests that no holidays are defined before the establishment year.
     *
     * @throws \Exception
     */
    public function testHolidayBeforeEstablishment(): void
    {
        $this->assertNotHoliday(
            self::REGION,
            self::HOLIDAY,
            Kenya::ESTABLISHMENT_YEAR - 1
        );
    }

    /**
     * Tests the substitute holiday when Jamhuri Day falls on a Sunday.
     *
     * @throws \Exception
     */
    public function testSubstituteHoliday(): void
    {
        // In 2021 Jamhuri Day falls on a Sunday, so Monday 13 December is a public holiday.
        $this->assertSubstituteHoliday(
            self::REGION,
            self::HOLIDAY,
            2021,
            new \DateTime('2021-12-13', new \DateTimeZone(self::TIMEZONE))
        );

        // In 2024 Jamhuri Day falls on a Thursday, so no substitute holiday is given.
        $this->assertNotSubstituteHoliday(self::REGION, self::HOLIDAY, 2024);
    }

    /** @throws \Exception */
    public function testTranslation(): void
    {
        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            static::generateRandomYear(Kenya::ESTABLISHMENT_YEAR),
            [self::LOCALE => 'Jamhuri Day']
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
