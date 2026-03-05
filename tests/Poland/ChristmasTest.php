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

namespace Yasumi\tests\Poland;

use Yasumi\Holiday;
use Yasumi\tests\HolidayTestCase;

/**
 * Class for testing Christmas in Poland.
 */
class ChristmasTest extends PolandBaseTestCase implements HolidayTestCase
{
    /**
     * The name of the holiday.
     */
    public const HOLIDAY = 'christmasDay';

    /**
     * Tests Christmas Day.
     *
     * @param int       $year     the year for which Christmas Day needs to be tested
     * @param \DateTime $expected the expected date
     */
    #[\PHPUnit\Framework\Attributes\DataProvider('ChristmasDayDataProvider')]
    public function testChristmasDay(int $year, \DateTimeInterface $expected): void
    {
        $this->assertHoliday(self::REGION, self::HOLIDAY, $year, $expected);
    }

    /**
     * Returns a list of random test dates used for assertion of Christmas Day.
     *
     * @return array<array> list of test dates for Christmas Day
     *
     * @throws \Exception
     */
    public static function ChristmasDayDataProvider(): array
    {
        return static::generateRandomDates(12, 25, self::TIMEZONE);
    }

    /**
     * Tests translated name of Christmas Day.
     *
     * @throws \Exception
     */
    public function testTranslation(): void
    {
        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            static::generateRandomYear(),
            [self::LOCALE => 'pierwszy dzień Bożego Narodzenia']
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
