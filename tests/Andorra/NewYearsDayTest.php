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

namespace Yasumi\tests\Andorra;

use Yasumi\Holiday;
use Yasumi\tests\HolidayTestCase;

/**
 * Class containing tests for New Year's Day in Andorra.
 */
class NewYearsDayTest extends AndorraBaseTestCase implements HolidayTestCase
{
    /**
     * The name of the holiday.
     */
    public const HOLIDAY = 'newYearsDay';

    /**
     * Tests New Year's Day.
     *
     * @param int       $year     the year for which New Year's Day needs to be tested
     * @param \DateTime $expected the expected date
     */
    #[\PHPUnit\Framework\Attributes\DataProvider('HolidayDataProvider')]
    public function testHoliday(int $year, \DateTimeInterface $expected): void
    {
        $this->assertHoliday(self::REGION, self::HOLIDAY, $year, $expected);
    }

    /**
     * Returns a list of random test dates used for assertion of New Year's Day.
     *
     * @return array<array> list of test dates for New Year's Day
     *
     * @throws \Exception
     */
    public static function HolidayDataProvider(): array
    {
        return static::generateRandomDates(1, 1, self::TIMEZONE);
    }

    /**
     * Tests the translated name of New Year's Day.
     *
     * @throws \Exception
     */
    public function testTranslation(): void
    {
        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            static::generateRandomYear(),
            [self::LOCALE => "Cap d\u{2019}any"]
        );
    }

    /**
     * Tests type of the holiday defined in this test.
     *
     * @throws \Exception
     */
    public function testHolidayType(): void
    {
        $this->assertHolidayType(self::REGION, self::HOLIDAY, static::generateRandomYear(), Holiday::TYPE_OFFICIAL);
    }
}
