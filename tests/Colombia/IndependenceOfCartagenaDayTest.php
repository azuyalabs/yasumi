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
 * Class for testing Independence of Cartagena (Independencia de Cartagena) in Colombia.
 *
 * Under the Emiliani rule, when 11 November falls on a Monday the holiday stays;
 * otherwise it moves to the following Monday.
 *
 * 2024: 11 Nov = Monday → observed = 11 Nov.
 * 2025: 11 Nov = Tuesday → observed = 17 Nov (Monday).
 */
class IndependenceOfCartagenaDayTest extends ColombiaBaseTestCase implements HolidayTestCase
{
    public const HOLIDAY = 'independenceOfCartagenaDay';

    /** @throws \Exception */
    public function testHolidayOnMonday(): void
    {
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            2024,
            new \DateTime('2024-11-11', new \DateTimeZone(self::TIMEZONE))
        );
    }

    /** @throws \Exception */
    public function testHolidayMovedToMonday(): void
    {
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            2025,
            new \DateTime('2025-11-17', new \DateTimeZone(self::TIMEZONE))
        );
    }

    /** @throws \Exception */
    public function testTranslation(): void
    {
        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            static::generateRandomYear(),
            [self::LOCALE => 'Independencia de Cartagena']
        );
    }

    /** @throws \Exception */
    public function testHolidayType(): void
    {
        $this->assertHolidayType(self::REGION, self::HOLIDAY, static::generateRandomYear(), Holiday::TYPE_OFFICIAL);
    }
}
