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
 * Class for testing Kenyatta Day in Kenya.
 *
 * Fixed date: 20 October. Renamed Mashujaa Day following the promulgation of
 * the Constitution of Kenya in August 2010.
 */
class KenyattaDayTest extends KenyaBaseTestCase implements HolidayTestCase
{
    public const HOLIDAY = 'kenyattaDay';

    /** @throws \Exception */
    public function testHoliday(): void
    {
        $year = 1995;
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new \DateTime("{$year}-10-20", new \DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests that Kenyatta Day is no longer observed after being renamed
     * Mashujaa Day in 2010.
     *
     * @throws \Exception
     */
    public function testHolidayAfterRenaming(): void
    {
        $this->assertNotHoliday(self::REGION, self::HOLIDAY, 2010);
    }

    /**
     * Tests the substitute holiday when Kenyatta Day falls on a Sunday.
     *
     * @throws \Exception
     */
    public function testSubstituteHoliday(): void
    {
        // In 2002 Kenyatta Day falls on a Sunday, so Monday 21 October is a public holiday.
        $this->assertSubstituteHoliday(
            self::REGION,
            self::HOLIDAY,
            2002,
            new \DateTime('2002-10-21', new \DateTimeZone(self::TIMEZONE))
        );

        // In 1995 Kenyatta Day falls on a Friday, so no substitute holiday is given.
        $this->assertNotSubstituteHoliday(self::REGION, self::HOLIDAY, 1995);
    }

    /** @throws \Exception */
    public function testTranslation(): void
    {
        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            static::generateRandomYear(Kenya::ESTABLISHMENT_YEAR, 2009),
            [self::LOCALE => 'Kenyatta Day']
        );
    }

    /** @throws \Exception */
    public function testHolidayType(): void
    {
        $this->assertHolidayType(
            self::REGION,
            self::HOLIDAY,
            static::generateRandomYear(Kenya::ESTABLISHMENT_YEAR, 2009),
            Holiday::TYPE_OFFICIAL
        );
    }
}
