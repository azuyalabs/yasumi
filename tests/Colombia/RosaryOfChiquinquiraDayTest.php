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

namespace Yasumi\tests\Colombia;

use Yasumi\Holiday;
use Yasumi\tests\HolidayTestCase;

/**
 * Class for testing Day of Our Lady of the Rosary of Chiquinquirá in Colombia.
 *
 * This holiday was established as a national holiday in 2026 via Law (June 2026).
 * Under the Emiliani rule, when 9 July falls on a Monday the holiday stays;
 * otherwise it moves to the following Monday.
 *
 * 2026: 9 Jul = Thursday → observed = 13 Jul (Monday).
 * 2027: 9 Jul = Friday → observed = 12 Jul (Monday).
 */
class RosaryOfChiquinquiraDayTest extends ColombiaBaseTestCase implements HolidayTestCase
{
    public const HOLIDAY = 'rosaryOfChiquinquiraDay';

    /** @throws \Exception */
    public function testHolidayMovedToMonday2026(): void
    {
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            2026,
            new \DateTime('2026-07-13', new \DateTimeZone(self::TIMEZONE))
        );
    }

    /** @throws \Exception */
    public function testHolidayMovedToMonday2027(): void
    {
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            2027,
            new \DateTime('2027-07-12', new \DateTimeZone(self::TIMEZONE))
        );
    }

    /** @throws \Exception */
    public function testHolidayOnMonday(): void
    {
        // Find a year where July 9 falls on a Monday
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            2029,
            new \DateTime('2029-07-09', new \DateTimeZone(self::TIMEZONE))
        );
    }

    /** @throws \Exception */
    public function testTranslation(): void
    {
        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            static::generateRandomYear(2026),
            [self::LOCALE => 'Día de la Virgen de Chiquinquirá']
        );
    }

    /** @throws \Exception */
    public function testHolidayType(): void
    {
        $this->assertHolidayType(self::REGION, self::HOLIDAY, static::generateRandomYear(2026), Holiday::TYPE_OFFICIAL);
    }

    /** @throws \Exception */
    public function testHolidayNotBeforeEstablishmentYear(): void
    {
        $this->assertNotHoliday(self::REGION, self::HOLIDAY, 2025);
    }
}
