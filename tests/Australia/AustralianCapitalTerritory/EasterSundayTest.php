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

namespace Yasumi\tests\Australia\AustralianCapitalTerritory;

use Yasumi\Holiday;
use Yasumi\tests\HolidayTestCase;

/**
 * Class for testing Easter Sunday in Australian Capital Territory (Australia)..
 */
class EasterSundayTest extends AustralianCapitalTerritoryBaseTestCase implements HolidayTestCase
{
    /**
     * The name of the holiday.
     */
    public const HOLIDAY = 'easter';

    /**
     * Tests Easter Sunday.
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
            $this->region,
            self::HOLIDAY,
            $year,
            new \DateTime($expected, new \DateTimeZone($this->timezone))
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
        $data = [];

        for ($y = 0; $y < 50; ++$y) {
            $year = $this->generateRandomYear();
            $date = $this->calculateEaster($year, $this->timezone);

            $data[] = [$year, $date->format('Y-m-d')];
        }

        return $data;
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
            $this->generateRandomYear(),
            [self::LOCALE => 'Easter Sunday']
        );
    }

    /**
     * Tests type of the holiday defined in this test.
     *
     * @throws \Exception
     */
    public function testHolidayType(): void
    {
        $this->assertHolidayType($this->region, self::HOLIDAY, $this->generateRandomYear(), Holiday::TYPE_OFFICIAL);
    }
}
