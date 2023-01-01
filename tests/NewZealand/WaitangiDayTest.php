<?php

declare(strict_types=1);
/*
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 - 2023 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <me at sachatelgenhof dot com>
 */

namespace Yasumi\tests\NewZealand;

use Yasumi\Holiday;
use Yasumi\tests\HolidayTestCase;

/**
 * Class for testing Waitangi day in the New Zealand.
 */
class WaitangiDayTest extends NewZealandBaseTestCase implements HolidayTestCase
{
    /**
     * The name of the holiday.
     */
    public const HOLIDAY = 'waitangiDay';

    /**
     * The year in which the holiday was first established.
     */
    public const ESTABLISHMENT_YEAR = 1974;

    /**
     * Tests Waitangi Day.
     *
     * @dataProvider HolidayDataProvider
     *
     * @param int    $year     the year for which the holiday defined in this test needs to be tested
     * @param string $expected the expected date
     *
     * @throws \Exception
     */
    public function testHoliday(int $year, string $expected): void
    {
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new \DateTime($expected, new \DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     *  Tests that Holiday is not present before 1974.
     */
    public function testNotHoliday(): void
    {
        $this->assertNotHoliday(self::REGION, self::HOLIDAY, self::ESTABLISHMENT_YEAR - 1);
    }

    /**
     * Tests the translated name of the holiday defined in this test.
     *
     * @throws \Exception
     */
    public function testTranslation(): void
    {
        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(self::ESTABLISHMENT_YEAR),
            [self::LOCALE => 'Waitangi Day']
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
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(self::ESTABLISHMENT_YEAR),
            Holiday::TYPE_OFFICIAL
        );
    }

    /**
     * Returns a list of test dates.
     *
     * @return array<array> list of test dates for the holiday defined in this test
     *
     * @throws \Exception
     */
    public function HolidayDataProvider(): array
    {
        return $this->generateRandomDatesWithModifier(2, 06, function ($year, \DateTime $date): void {
            // in 2015 some policy was introduced to make sure this holiday was celebrated during the working week.
            if ($year < 2015) {
                return;
            }

            if (!$this->isWeekend($date)) {
                return;
            }

            $date->modify('next monday');
        }, 100, self::ESTABLISHMENT_YEAR, self::TIMEZONE);
    }
}
