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
 * Class for testing Good Friday in Kenya.
 *
 * Movable feast: the Friday before Easter Sunday.
 */
class GoodFridayTest extends KenyaBaseTestCase implements HolidayTestCase
{
    public const HOLIDAY = 'goodFriday';

    /** @throws \Exception */
    public function testHoliday(): void
    {
        $year = 2024;
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new \DateTime("{$year}-03-29", new \DateTimeZone(self::TIMEZONE))
        );
    }

    /** @throws \Exception */
    public function testTranslation(): void
    {
        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            static::generateRandomYear(Kenya::ESTABLISHMENT_YEAR),
            [self::LOCALE => 'Good Friday']
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
