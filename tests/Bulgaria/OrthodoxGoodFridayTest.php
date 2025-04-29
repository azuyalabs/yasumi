<?php

declare(strict_types = 1);

/**
 * This file is part of the 'Yasumi' package.
 *
 * The easy PHP Library for calculating holidays.
 *
 * Copyright (c) 2015 - 2025 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <me at sachatelgenhof dot com>
 */

namespace Yasumi\tests\Bulgaria;

use Yasumi\Holiday;
use Yasumi\Provider\ChristianHolidays;
use Yasumi\tests\HolidayTestCase;

class OrthodoxGoodFridayTest extends BulgariaBaseTestCase implements HolidayTestCase
{
    use ChristianHolidays;

    public const HOLIDAY = 'orthodoxGoodFriday';

    public function testHoliday(): void
    {
        $year = 2023;
        $easter = $this->calculateOrthodoxEaster($year, self::TIMEZONE);
        $goodFriday = clone $easter;
        $goodFriday->sub(new \DateInterval('P2D'));

        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            $goodFriday
        );
    }

    public function testTranslation(): void
    {
        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(),
            [self::LOCALE => 'Разпети петък']
        );
    }

    public function testHolidayType(): void
    {
        $this->assertHolidayType(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(),
            Holiday::TYPE_OFFICIAL
        );
    }
}
