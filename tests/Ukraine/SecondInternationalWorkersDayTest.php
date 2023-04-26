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

namespace Yasumi\tests\Ukraine;

use Yasumi\Holiday;
use Yasumi\tests\HolidayTestCase;
use Yasumi\Yasumi;

/**
 * Class SecondInternationalWorkersDayTest.
 */
class SecondInternationalWorkersDayTest extends UkraineBaseTestCase implements HolidayTestCase
{
    /**
     * The name of the holiday.
     */
    public const HOLIDAY = 'secondInternationalWorkersDay';

    /**
     * Tests International Workers' Day.
     *
     * @dataProvider SecondInternationalWorkersDayDataProvider
     *
     * @param int       $year     the year for which International Workers' Day needs to be tested
     * @param \DateTime $expected the expected date
     */
    public function testSecondInternationalWorkersDay(int $year, \DateTimeInterface $expected): void
    {
        $this->assertHoliday(self::REGION, self::HOLIDAY, $year, $expected);
    }

    /**
     * Tests International Workers' Day since 2018.
     *
     * @throws \Exception
     */
    public function testNoSecondInternationalWorkersDaySince2018(): void
    {
        $year = $this->generateRandomYear(2018);
        $holidays = Yasumi::create(self::REGION, $year);
        $holiday = $holidays->getHoliday(self::HOLIDAY);

        self::assertNull($holiday);

        unset($year, $holiday, $holidays);
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
            $this->generateRandomYear(null, 2017),
            [self::LOCALE => 'День міжнародної солідарності трудящих']
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
            $this->generateRandomYear(null, 2017),
            Holiday::TYPE_OFFICIAL
        );
    }

    /**
     * Returns a list of random test dates used for assertion of International Workers' Day.
     *
     * @return array<array> list of test dates for International Workers' Day
     *
     * @throws \Exception
     */
    public function SecondInternationalWorkersDayDataProvider(): array
    {
        $data = [];

        for ($y = 0; $y < 10; ++$y) {
            $year = $this->generateRandomYear(null, 2017);
            $data[] = [$year, new \DateTime("$year-05-02", new \DateTimeZone(self::TIMEZONE))];
        }

        return $data;
    }
}
