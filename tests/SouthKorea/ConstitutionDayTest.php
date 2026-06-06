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
 * Class for testing day after Constitution Day in South Korea.
 */
class ConstitutionDayTest extends SouthKoreaBaseTestCase implements HolidayTestCase
{
    /**
     * The name of the holiday.
     */
    public const HOLIDAY = 'constitutionDay';

    /**
     * The year in which the holiday was first established.
     */
    public const ESTABLISHMENT_YEAR = 1949;

    /**
     * The year in which the holiday was abolished.
     */
    public const ABOLISHED_YEAR = 2008;

    /**
     * The year in which the holiday was restored after having been previously abolished.
     */
    public const RESTORATION_YEAR = 2026;

    /**
     * Tests the holiday defined in this test.
     *
     * @throws \Exception
     */
    public function testHoliday(): void
    {
        // From 1949 to 2007
        $year = static::generateRandomYear(self::ESTABLISHMENT_YEAR, self::ABOLISHED_YEAR - 1);
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new \DateTime("{$year}-7-17", DateTimeZoneFactory::getDateTimeZone(self::TIMEZONE))
        );

        // From 2008 to 2025
        $this->assertNotHoliday(
            self::REGION,
            self::HOLIDAY,
            static::generateRandomYear(self::ABOLISHED_YEAR, self::RESTORATION_YEAR - 1)
        );

        // From 2026 and after
        $year = static::generateRandomYear(self::RESTORATION_YEAR);
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new \DateTime("{$year}-7-17", DateTimeZoneFactory::getDateTimeZone(self::TIMEZONE))
        );

        // Before 1949
        $this->assertNotHoliday(
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
            [self::LOCALE => '제헌절']
        );

        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            static::generateRandomYear(self::RESTORATION_YEAR),
            [self::LOCALE => '제헌절']
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
        return static::generateRandomDatesWithModifier(7, 17, function ($year, \DateTime $date): ?bool {
            if (1960 === $year) {
                $date->modify('next monday');

                return null;
            }

            if ($year < 2026 || ! self::isWeekend($date)) {
                return false;
            }

            $date->modify('next monday');

            return null;
        }, 20, self::ESTABLISHMENT_YEAR, self::TIMEZONE);
    }
}
