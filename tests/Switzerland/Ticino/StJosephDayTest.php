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

namespace Yasumi\tests\Switzerland\Ticino;

use Yasumi\Holiday;
use Yasumi\Provider\ChristianHolidays;
use Yasumi\tests\HolidayTestCase;

/**
 * Class for testing St. Joseph's Day in Ticino (Switzerland).
 */
class StJosephDayTest extends TicinoBaseTestCase implements HolidayTestCase
{
    use ChristianHolidays;

    /**
     * The name of the holiday.
     */
    public const HOLIDAY = 'stJosephsDay';

    /**
     * Tests St. Joseph's Day.
     *
     * @dataProvider StJosephDayDataProvider
     *
     * @param int       $year     the year for which St. Joseph's Day needs to be tested
     * @param \DateTime $expected the expected date
     */
    public function testStJosephDay(int $year, \DateTimeInterface $expected): void
    {
        $this->assertHoliday(self::REGION, self::HOLIDAY, $year, $expected);
    }

    /**
     * Returns a list of random test dates used for assertion of St. Joseph's Day.
     *
     * @return array<array> list of test dates for St. Joseph's Day
     *
     * @throws \Exception
     */
    public function StJosephDayDataProvider(): array
    {
        return $this->generateRandomDates(3, 19, self::TIMEZONE);
    }

    /**
     * Tests translated name of the holiday defined in this test.
     *
     * @throws \Exception
     */
    public function testTranslation(): void
    {
        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(),
            [self::LOCALE => 'San Giuseppe']
        );
    }

    /**
     * Tests type of the holiday defined in this test.
     *
     * @throws \Exception
     */
    public function testHolidayType(): void
    {
        $this->assertHolidayType(self::REGION, self::HOLIDAY, $this->generateRandomYear(), Holiday::TYPE_OTHER);
    }
}
