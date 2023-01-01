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

namespace Yasumi\tests\Ireland;

use Yasumi\Holiday;
use Yasumi\tests\HolidayTestCase;

/**
 * Class for testing Pentecost in Ireland.
 */
class pentecostMondayTest extends IrelandBaseTestCase implements HolidayTestCase
{
    /**
     * The name of the holiday to be tested.
     */
    public const HOLIDAY = 'pentecostMonday';

    /**
     * The year in which the holiday was abolished.
     */
    public const ABOLISHMENT_YEAR = 1973;

    /**
     * Tests the holiday defined in this test.
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
     * Returns a list of random test dates used for assertion of the holiday defined in this test.
     *
     * @return array<array> list of test dates for the holiday defined in this test
     *
     * @throws \Exception
     */
    public function HolidayDataProvider(): array
    {
        $data = [];

        for ($y = 0; $y < self::TEST_ITERATIONS; ++$y) {
            $year = $this->generateRandomYear(1000, self::ABOLISHMENT_YEAR);
            $date = $this->calculateEaster($year, self::TIMEZONE);
            $date->add(new \DateInterval('P50D'));
            $data[] = [$year, $date->format('Y-m-d')];
        }

        return $data;
    }

    /**
     * Tests the holiday defined in this test after abolishment.
     *
     * @throws \Exception
     */
    public function testHolidayDayAfterAbolishment(): void
    {
        $this->assertNotHoliday(self::REGION, self::HOLIDAY, $this->generateRandomYear(self::ABOLISHMENT_YEAR + 1));
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
            $this->generateRandomYear(1000, self::ABOLISHMENT_YEAR),
            [self::LOCALE => 'Whitmonday']
        );
        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(1000, self::ABOLISHMENT_YEAR),
            ['ga_IE' => 'Luan Cincíse']
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
            $this->generateRandomYear(1000, self::ABOLISHMENT_YEAR),
            Holiday::TYPE_OFFICIAL
        );
    }
}
