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

namespace Yasumi\tests\Ukraine;

use Yasumi\Holiday;
use Yasumi\tests\HolidayTestCase;

/**
 * Class ChristmasDayTest.
 */
class ChristmasDayTest extends UkraineBaseTestCase implements HolidayTestCase
{
    public const ABOLISHMENT_YEAR = 2023;

    /**
     * The name of the holiday.
     */
    public const HOLIDAY = 'christmasDay';

    /**
     * Tests Christmas Day.
     */
    public function testHoliday(): void
    {
        $year = $this->generateRandomYear(1000, self::ABOLISHMENT_YEAR);
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new \DateTime("{$year}-01-07", new \DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests Christmas Day was abolished in 2023.
     */
    public function testNotHolidayAfter2023(): void
    {
        $year = $this->generateRandomYear(self::ABOLISHMENT_YEAR + 1);
        $this->assertNotHoliday(self::REGION, self::HOLIDAY, $year);
    }

    /**
     * Tests translated name of Christmas Day.
     */
    public function testTranslation(): void
    {
        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(1000, 2023),
            [self::LOCALE => 'Різдво']
        );
    }

    /**
     * Tests type of the holiday defined in this test.
     *
     * @throws \Exception
     */
    public function testHolidayType(): void
    {
        $this->assertHolidayType(self::REGION, self::HOLIDAY, $this->generateRandomYear(1000, 2023), Holiday::TYPE_OFFICIAL);
    }
}
