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

namespace Yasumi\tests\Australia\Queensland;

use Yasumi\Holiday;
use Yasumi\tests\Australia\MonarchsBirthdayTransitionTestTrait;
use Yasumi\tests\HolidayTestCase;

/**
 * Class for testing Monarch's Birthday in Queensland (Australia)..
 */
class QueensBirthdayTest extends QueenslandBaseTestCase implements HolidayTestCase
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
            [2012, '2012-10-01'],
            [2013, '2013-06-10'],
            [2014, '2014-06-09'],
            [2015, '2015-06-08'],
            [2016, '2016-10-03'],
            [2017, '2017-10-02'],
            [2018, '2018-10-01'],
            [2019, '2019-10-07'],
            [2020, '2020-10-05'],
            [2021, '2021-10-04'],
            [2022, '2022-10-03'],
            [2023, '2023-10-02'],
            [2024, '2024-10-07'],
            [2025, '2025-10-06'],
            [2026, '2026-10-05'],
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
