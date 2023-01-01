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

namespace Yasumi\tests\UnitedKingdom\Scotland;

use Yasumi\Holiday;
use Yasumi\tests\HolidayTestCase;

/**
 * Class for testing New Years Day in Scotland.
 */
class SecondNewYearsDayTest extends ScotlandBaseTestCase implements HolidayTestCase
{
    /**
     * The year in which the holiday was first established.
     */
    public const ESTABLISHMENT_YEAR = 1871;

    /**
     * The year in which the holiday was adjusted.
     */
    public const ADJUSTMENT_YEAR = 1974;

    /**
     * The name of the holiday to be tested.
     */
    public const HOLIDAY = 'secondNewYearsDay';

    /**
     * Tests the holiday defined in this test on or after establishment.
     *
     * @dataProvider HolidayDataProvider
     *
     * @param int    $year     the year for which the holiday defined in this test needs to be tested
     * @param string $expected the expected date
     *
     * @throws \Exception
     */
    public function testHolidayOnAfterEstablishment(int $year, string $expected): void
    {
        $date = new \DateTime($expected, new \DateTimeZone(self::TIMEZONE));
        $this->assertHoliday(self::REGION, self::HOLIDAY, $year, $date);

        if (\in_array((int) $date->format('w'), [0, 6], true)) {
            $date->add(new \DateInterval('P2D'));
            $this->assertHoliday(self::REGION, 'substituteHoliday:'.self::HOLIDAY, $year, $date);
        }
    }

    /**
     * Tests the holiday defined in this test before establishment.
     *
     * @throws \Exception
     */
    public function testHolidayBeforeEstablishment(): void
    {
        $this->assertNotHoliday(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(1000, self::ESTABLISHMENT_YEAR - 1)
        );
    }

    /**
     * Tests that the holiday defined in this test is of the type 'observance' before the year it was changed.
     *
     * @throws \Exception
     */
    public function testHolidayIsObservedTypeBeforeChange(): void
    {
        $this->assertHolidayType(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(self::ESTABLISHMENT_YEAR, self::ADJUSTMENT_YEAR - 1),
            Holiday::TYPE_OBSERVANCE
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
            $year = $this->generateRandomYear(self::ESTABLISHMENT_YEAR);
            $date = new \DateTime("$year-1-2", new \DateTimeZone(self::TIMEZONE));
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
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(self::ESTABLISHMENT_YEAR),
            [self::LOCALE => '2nd January']
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
            $this->generateRandomYear(self::ADJUSTMENT_YEAR + 1),
            Holiday::TYPE_BANK
        );
    }
}
