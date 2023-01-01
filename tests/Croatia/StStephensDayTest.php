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

namespace Yasumi\tests\Croatia;

use Yasumi\Holiday;
use Yasumi\tests\HolidayTestCase;

/**
 * Class for testing St. Stephen's Day in Croatia.
 */
class StStephensDayTest extends CroatiaBaseTestCase implements HolidayTestCase
{
    /**
     * The name of the holiday.
     */
    public const HOLIDAY = 'stStephensDay';

    /**
     * Tests the day of St. Stephen's Day.
     *
     * @dataProvider stStephensDayDataProvider
     *
     * @param int       $year     the year for which St. Stephen's Day needs to be tested
     * @param \DateTime $expected the expected date
     */
    public function teststStephensDay(int $year, \DateTimeInterface $expected): void
    {
        $this->assertHoliday(self::REGION, self::HOLIDAY, $year, $expected);
    }

    /**
     * Returns a list of random test dates used for assertion of St. Stephen's Day.
     *
     * @return array<array> list of test dates for St. Stephen's Day
     *
     * @throws \Exception
     */
    public function stStephensDayDataProvider(): array
    {
        return $this->generateRandomDates(12, 26, self::TIMEZONE);
    }

    /**
     * Tests translated name of St. Stephen's Day.
     *
     * @throws \Exception
     */
    public function testTranslation(): void
    {
        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(),
            [self::LOCALE => 'Sveti Stjepan']
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
