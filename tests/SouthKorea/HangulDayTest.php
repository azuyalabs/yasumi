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

namespace Yasumi\tests\SouthKorea;

use PHPUnit\Framework\Attributes\DataProvider;
use Yasumi\Holiday;
use Yasumi\Provider\DateTimeZoneFactory;
use Yasumi\tests\HolidayTestCase;

/**
 * Class for testing Hangul Day in South Korea.
 */
class HangulDayTest extends SouthKoreaBaseTestCase implements HolidayTestCase
{
    /**
     * The name of the holiday.
     */
    public const HOLIDAY = 'hangulDay';

    /**
     * The year in which the holiday was first established.
     */
    public const ESTABLISHMENT_YEAR = 1949;

    /**
     * The year in which the holiday was abolished.
     */
    public const ABOLISHED_YEAR = 1991;

    /**
     * The year in which the holiday was restored after having been previously abolished.
     */
    public const RESTORATION_YEAR = 2013;

    /**
     * Tests the holiday defined in this test.
     *
     * @throws \Exception
     */
    public function testHoliday(): void
    {
        // From 1949 to 1990
        $year = static::generateRandomYear(self::ESTABLISHMENT_YEAR, self::ABOLISHED_YEAR - 1);
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new \DateTime("{$year}-10-9", DateTimeZoneFactory::getDateTimeZone(self::TIMEZONE))
        );

        // From 1991 to 2012
        $this->assertNotHoliday(
            self::REGION,
            self::HOLIDAY,
            static::generateRandomYear(self::ABOLISHED_YEAR, self::RESTORATION_YEAR - 1),
        );

        // From 2013 and after
        $year = static::generateRandomYear(self::RESTORATION_YEAR);
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new \DateTime("{$year}-10-9", DateTimeZoneFactory::getDateTimeZone(self::TIMEZONE))
        );

        // Before 1949
        $this->assertNotSubstituteHoliday(
            self::REGION,
            self::HOLIDAY,
            static::generateRandomYear(null, self::ESTABLISHMENT_YEAR - 1)
        );
    }

    /**
     * Tests the substitute holiday defined in this test.
     *
     * @throws \Exception
     */
    #[DataProvider('SubstituteHolidayDataProvider')]
    public function testSubstituteHoliday(int $year, string $expected): void
    {
        $this->assertSubstituteHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new \DateTime($expected, DateTimeZoneFactory::getDateTimeZone(self::TIMEZONE))
        );
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
            static::generateRandomYear(self::ESTABLISHMENT_YEAR, self::ABOLISHED_YEAR - 1),
            [self::LOCALE => '한글날']
        );

        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            static::generateRandomYear(self::RESTORATION_YEAR),
            [self::LOCALE => '한글날']
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
            static::generateRandomYear(self::ESTABLISHMENT_YEAR, self::ABOLISHED_YEAR - 1),
            Holiday::TYPE_OFFICIAL
        );

        $this->assertHolidayType(
            self::REGION,
            self::HOLIDAY,
            static::generateRandomYear(self::RESTORATION_YEAR),
            Holiday::TYPE_OFFICIAL
        );
    }

    public static function SubstituteHolidayDataProvider(): array
    {
        return [
            [1960, '1960-10-10'],
            [2027, '2027-10-11'],
            [2032, '2032-10-11'],
            [2033, '2033-10-10'],
            [2038, '2038-10-11'],
            [2039, '2039-10-10'],
            [2044, '2044-10-10'],
            [2049, '2049-10-11'],
        ];
    }
}
