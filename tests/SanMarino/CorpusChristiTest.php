<?php

declare(strict_types = 1);

/**
 * This file is part of the 'Yasumi' package.
 *
 * The easy PHP Library for calculating holidays.
 *
 * Copyright (c) 2015 - 2026 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <me at sachatelgenhof dot com>
 */

namespace Yasumi\tests\SanMarino;

use Yasumi\Holiday;
use Yasumi\tests\HolidayTestCase;

/**
 * Class containing tests for Corpus Christi in San Marino.
 *
 * Corpus Christi (Italian: Corpus Domini) is celebrated on the Thursday 60 days after Easter Sunday.
 *
 * @see https://en.wikipedia.org/wiki/Corpus_Christi_(feast)
 */
class CorpusChristiTest extends SanMarinoBaseTestCase implements HolidayTestCase
{
    /**
     * The name of the holiday.
     */
    public const HOLIDAY = 'corpusChristi';

    /**
     * Tests Corpus Christi.
     *
     * @param int       $year     the year for which the holiday defined in this test needs to be tested
     * @param \DateTime $expected the expected date
     *
     * @throws \Exception
     */
    #[\PHPUnit\Framework\Attributes\DataProvider('HolidayDataProvider')]
    public function testHoliday(int $year, \DateTimeInterface $expected): void
    {
        $this->assertHoliday(self::REGION, self::HOLIDAY, $year, $expected);
    }

    /**
     * Returns a list of test dates used for assertion of the holiday defined in this test.
     *
     * @return array<array> list of test dates for the holiday defined in this test
     *
     * @throws \Exception
     */
    public static function HolidayDataProvider(): array
    {
        return [
            [2020, new \DateTime('2020-6-11', new \DateTimeZone(self::TIMEZONE))],
            [2021, new \DateTime('2021-6-3', new \DateTimeZone(self::TIMEZONE))],
            [2022, new \DateTime('2022-6-16', new \DateTimeZone(self::TIMEZONE))],
            [2023, new \DateTime('2023-6-8', new \DateTimeZone(self::TIMEZONE))],
            [2024, new \DateTime('2024-5-30', new \DateTimeZone(self::TIMEZONE))],
            [2025, new \DateTime('2025-6-19', new \DateTimeZone(self::TIMEZONE))],
            [2026, new \DateTime('2026-6-4', new \DateTimeZone(self::TIMEZONE))],
        ];
    }

    /**
     * Tests the translated name of Corpus Christi.
     *
     * @throws \Exception
     */
    public function testTranslation(): void
    {
        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            static::generateRandomYear(),
            [self::LOCALE => 'Corpus Domini']
        );
    }

    /**
     * Tests type of the holiday defined in this test.
     *
     * @throws \Exception
     */
    public function testHolidayType(): void
    {
        $this->assertHolidayType(self::REGION, self::HOLIDAY, static::generateRandomYear(), Holiday::TYPE_OFFICIAL);
    }
}
