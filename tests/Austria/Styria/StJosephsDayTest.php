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

namespace Yasumi\tests\Austria\Styria;

use Yasumi\Holiday;
use Yasumi\tests\HolidayTestCase;

/**
 * Class for testing St. Joseph's Day in Styria (Austria).
 */
class StJosephsDayTest extends StyriaBaseTestCase implements HolidayTestCase
{
    /**
     * The name of the holiday.
     */
    public const HOLIDAY = 'stJosephsDay';

    /**
     * Tests St. Joseph's Day.
     *
     * @dataProvider StJosephsDayDataProvider
     *
     * @param int       $year     the year for which St. Joseph's Day needs to be tested.
     * @param \DateTime $expected the expected date
     */
    public function testStJosephsDay(int $year, \DateTimeInterface $expected): void
    {
        $this->assertHoliday(self::REGION, self::HOLIDAY, $year, $expected);
    }

    /**
     * Returns a list of random test dates used for assertion of St. Joseph's Day.
     *
     * @return array<array> list of test dates for St. Joseph's Day.
     *
     * @throws \Exception
     */
    public function StJosephsDayDataProvider(): array
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
            [self::LOCALE => 'Josephstag']
        );
    }

    /**
     * Tests type of the holiday defined in this test.
     *
     * @throws \Exception
     */
    public function testHolidayType(): void
    {
        $this->assertHolidayType(self::REGION, self::HOLIDAY, $this->generateRandomYear(), Holiday::TYPE_OFFICIAL);
    }
}
