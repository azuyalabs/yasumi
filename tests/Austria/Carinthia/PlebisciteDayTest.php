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

namespace Yasumi\tests\Austria\Carinthia;

use Yasumi\Holiday;
use Yasumi\tests\HolidayTestCase;

/**
 * Class for testing Plebiscite Day in Carinthia (Austria).
 */
class PlebisciteDayTest extends CarinthiaBaseTestCase implements HolidayTestCase
{
    /**
     * The name of the holiday.
     */
    public const HOLIDAY = 'plebisciteDay';

    /**
     * The year in which the holiday was first established.
     */
    public const ESTABLISHMENT_YEAR = 1920;

    /**
     * Tests Plebiscite Day.
     *
     * @dataProvider PlebisciteDayDataProvider
     *
     * @param int       $year     the year for which Plebiscite Day needs to be tested
     * @param \DateTime $expected the expected date
     */
    public function testPlebisciteDay(int $year, \DateTimeInterface $expected): void
    {
        $this->assertHoliday(self::REGION, self::HOLIDAY, $year, $expected);
    }

    /**
     * Returns a list of random test dates used for assertion of Plebiscite Day.
     *
     * @return array<array> list of test dates for Plebiscite Day
     *
     * @throws \Exception
     */
    public function PlebisciteDayDataProvider(): array
    {
        $data = [];

        for ($y = 0; $y < self::TEST_ITERATIONS; ++$y) {
            $year = $this->generateRandomYear(self::ESTABLISHMENT_YEAR);
            $data[] = [$year, new \DateTime("$year-10-10", new \DateTimeZone(self::TIMEZONE))];
        }

        return $data;
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
            $this->generateRandomYear(1000, self::ESTABLISHMENT_YEAR - 2)
        );
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
            $this->generateRandomYear(self::ESTABLISHMENT_YEAR),
            [self::LOCALE => 'Tag der Volksabstimmung']
        );
    }

    /**
     * Tests type of the holiday defined in this test.
     *
     * @throws \Exception
     */
    public function testHolidayType(): void
    {
        $this->assertHolidayType(self::REGION, self::HOLIDAY, $this->generateRandomYear(self::ESTABLISHMENT_YEAR), Holiday::TYPE_OFFICIAL);
    }
}
