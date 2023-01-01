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

namespace Yasumi\tests\Austria\Salzburg;

use Yasumi\Holiday;
use Yasumi\tests\HolidayTestCase;

/**
 * Class for testing Saint Rupert's Day in Salzburg (Austria).
 */
class StRupertsDayTest extends SalzburgBaseTestCase implements HolidayTestCase
{
    /**
     * The name of the holiday.
     */
    public const HOLIDAY = 'stRupertsDay';

    /**
     * Tests Saint Rupert's Day.
     *
     * @dataProvider StRupertsDayDataProvider
     *
     * @param int       $year     the year for which Saint Rupert's Day needs to be tested
     * @param \DateTime $expected the expected date
     */
    public function testStRupertsDay(int $year, \DateTimeInterface $expected): void
    {
        $this->assertHoliday(self::REGION, self::HOLIDAY, $year, $expected);
    }

    /**
     * Returns a list of random test dates used for assertion of Saint Rupert's Day.
     *
     * @return array<array> list of test dates for Saint Rupert's Day
     *
     * @throws \Exception
     */
    public function StRupertsDayDataProvider(): array
    {
        return $this->generateRandomDates(9, 24, self::TIMEZONE);
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
            [self::LOCALE => 'Rupert']
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
