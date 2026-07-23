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
 * Class for testing Assumption of Mary (Asunción de la Virgen) in Colombia.
 *
 * Under the Emiliani rule, when 15 August falls on a Monday the holiday stays;
 * otherwise it moves to the following Monday.
 *
 * 2022: 15 Aug = Monday → observed = 15 Aug.
 * 2025: 15 Aug = Friday → observed = 18 Aug (Monday).
 */
class AssumptionOfMaryTest extends ColombiaBaseTestCase implements HolidayTestCase
{
    public const HOLIDAY = 'assumptionOfMary';

    /** @throws \Exception */
    public function testHolidayOnMonday(): void
    {
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            2022,
            new \DateTime('2022-08-15', new \DateTimeZone(self::TIMEZONE))
        );
    }

    /** @throws \Exception */
    public function testHolidayMovedToMonday(): void
    {
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            2025,
            new \DateTime('2025-08-18', new \DateTimeZone(self::TIMEZONE))
        );
    }

    /** @throws \Exception */
    public function testTranslation(): void
    {
        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            static::generateRandomYear(),
            [self::LOCALE => 'Asunción de la Virgen']
        );
    }

    /** @throws \Exception */
    public function testHolidayType(): void
    {
        $this->assertHolidayType(self::REGION, self::HOLIDAY, static::generateRandomYear(), Holiday::TYPE_OFFICIAL);
    }
}
