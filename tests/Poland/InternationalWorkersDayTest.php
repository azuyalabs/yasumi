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

namespace Yasumi\tests\Poland;

use Yasumi\Holiday;
use Yasumi\tests\HolidayTestCase;

/**
 * Class containing tests for International Workers' Day (i.e. Labour Day) in Poland.
 */
class InternationalWorkersDayTest extends PolandBaseTestCase implements HolidayTestCase
{
    /**
     * The name of the holiday.
     */
    public const HOLIDAY = 'internationalWorkersDay';

    /**
     * Tests International Workers' Day.
     *
     * @dataProvider InternationalWorkersDayDataProvider
     *
     * @param int       $year     the year for which International Workers' Day needs to be tested
     * @param \DateTime $expected the expected date
     */
    public function testInternationalWorkersDay(int $year, \DateTimeInterface $expected): void
    {
        $this->assertHoliday(self::REGION, self::HOLIDAY, $year, $expected);
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
            [self::LOCALE => 'Święto Pracy']
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

    /**
     * Returns a list of random test dates used for assertion of International Workers' Day.
     *
     * @return array<array> list of test dates for International Workers' Day
     *
     * @throws \Exception
     */
    public function InternationalWorkersDayDataProvider(): array
    {
        return $this->generateRandomDates(5, 1, self::TIMEZONE);
    }
}
