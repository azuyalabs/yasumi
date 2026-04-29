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

namespace Yasumi\tests\Australia\Victoria;

use Yasumi\Holiday;
use Yasumi\tests\Australia\MonarchsBirthdayTransitionTestTrait;
use Yasumi\tests\HolidayTestCase;

/**
 * Class for testing Monarch's Birthday in Victoria (Australia)..
 */
class QueensBirthdayTest extends VictoriaBaseTestCase implements HolidayTestCase
{
    use MonarchsBirthdayTransitionTestTrait;

    /**
     * The name of the holiday.
     */
    public const HOLIDAY = 'monarchsBirthday';

    /**
     * The year in which the holiday was first established.
     */
    public const ESTABLISHMENT_YEAR = 1950;

    /**
     * Tests Monarch's Birthday.
     *
     * @param int    $year     the year for which the holiday defined in this test needs to be tested
     * @param string $expected the expected date
     *
     * @throws \Exception
     */
    #[\PHPUnit\Framework\Attributes\DataProvider('HolidayDataProvider')]
    public function testHoliday(int $year, string $expected): void
    {
        $this->assertHoliday(
            $this->region,
            self::HOLIDAY,
            $year,
            new \DateTime($expected, new \DateTimeZone($this->timezone))
        );
    }

    /**
     * Returns a list of test dates.
     *
     * @return array<int, array{int, string}> list of test dates for the holiday defined in this test
     */
    public static function HolidayDataProvider(): array
    {
        return [
            [2010, '2010-06-14'],
            [2011, '2011-06-13'],
            [2012, '2012-06-11'],
            [2013, '2013-06-10'],
            [2014, '2014-06-09'],
            [2015, '2015-06-08'],
            [2016, '2016-06-13'],
            [2017, '2017-06-12'],
            [2018, '2018-06-11'],
            [2019, '2019-06-10'],
            [2020, '2020-06-08'],
            [2021, '2021-06-14'],
            [2022, '2022-06-13'],
            [2023, '2023-06-12'],
            [2024, '2024-06-10'],
            [2025, '2025-06-09'],
            [2026, '2026-06-08'],
        ];
    }

    /**
     * Tests the translated name of the holiday defined in this test.
     *
     * @throws \Exception
     */
    public function testTranslation(): void
    {
        $this->assertTranslatedHolidayName(
            $this->region,
            self::HOLIDAY,
            static::generateRandomYear(self::ESTABLISHMENT_YEAR, 2022),
            [self::LOCALE => 'Queen’s Birthday']
        );
        $this->assertTranslatedHolidayName(
            $this->region,
            self::HOLIDAY,
            static::generateRandomYear(2023),
            [self::LOCALE => 'King’s Birthday']
        );
    }

    /**
     * Tests type of the holiday defined in this test.
     *
     * @throws \Exception
     */
    public function testHolidayType(): void
    {
        $this->assertHolidayType(
            $this->region,
            self::HOLIDAY,
            static::generateRandomYear(self::ESTABLISHMENT_YEAR, 2100),
            Holiday::TYPE_OFFICIAL
        );
    }
}
