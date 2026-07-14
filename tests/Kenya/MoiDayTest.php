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
 * Class for testing Moi Day in Kenya.
 *
 * Fixed date: 10 October. First observed in 1989, removed from the list of
 * public holidays following the promulgation of the Constitution of Kenya in
 * August 2010, and restored by a High Court ruling as of 2018. Renamed
 * Utamaduni Day in 2020.
 */
class MoiDayTest extends KenyaBaseTestCase implements HolidayTestCase
{
    public const HOLIDAY = 'moiDay';

    public const ESTABLISHMENT_YEAR = 1989;

    /** @throws \Exception */
    public function testHoliday(): void
    {
        $year = 1995;
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new \DateTime("{$year}-10-10", new \DateTimeZone(self::TIMEZONE))
        );

        // Restored by the High Court ruling of 8 November 2017.
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            2018,
            new \DateTime('2018-10-10', new \DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests that Moi Day is not observed before its establishment, in the
     * years following the promulgation of the Constitution of Kenya, and
     * after being renamed Utamaduni Day.
     *
     * @throws \Exception
     */
    public function testHolidayInYearsNotObserved(): void
    {
        $this->assertNotHoliday(self::REGION, self::HOLIDAY, self::ESTABLISHMENT_YEAR - 1);
        $this->assertNotHoliday(self::REGION, self::HOLIDAY, 2015);
        $this->assertNotHoliday(self::REGION, self::HOLIDAY, 2020);
    }

    /**
     * Tests the substitute holiday when Moi Day falls on a Sunday.
     *
     * @throws \Exception
     */
    public function testSubstituteHoliday(): void
    {
        // In 1999 Moi Day falls on a Sunday, so Monday 11 October is a public holiday.
        $this->assertSubstituteHoliday(
            self::REGION,
            self::HOLIDAY,
            1999,
            new \DateTime('1999-10-11', new \DateTimeZone(self::TIMEZONE))
        );

        // In 1995 Moi Day falls on a Tuesday, so no substitute holiday is given.
        $this->assertNotSubstituteHoliday(self::REGION, self::HOLIDAY, 1995);
    }

    /** @throws \Exception */
    public function testTranslation(): void
    {
        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            static::generateRandomYear(self::ESTABLISHMENT_YEAR, 2009),
            [self::LOCALE => 'Moi Day']
        );
    }

    /** @throws \Exception */
    public function testHolidayType(): void
    {
        $this->assertHolidayType(
            self::REGION,
            self::HOLIDAY,
            static::generateRandomYear(self::ESTABLISHMENT_YEAR, 2009),
            Holiday::TYPE_OFFICIAL
        );
    }
}
