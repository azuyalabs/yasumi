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
 * Class for testing day after Armed Forces Day in South Korea.
 */
class ArmedForcesDayTest extends SouthKoreaBaseTestCase implements HolidayTestCase
{
    /**
     * The name of the holiday.
     */
    public const HOLIDAY = 'armedForcesDay';

    /**
     * The year in which the holiday was first established.
     */
    public const ESTABLISHMENT_YEAR = 1976;

    /**
     * The year in which the holiday was abolished.
     */
    public const ABOLISHED_YEAR = 1991;

    /**
     * Tests the holiday defined in this test.
     *
     * @throws \Exception
     */
    public function testHoliday(): void
    {
        // From 1976 to 1990
        $year = static::generateRandomYear(self::ESTABLISHMENT_YEAR, self::ABOLISHED_YEAR - 1);
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new \DateTime("{$year}-10-1", DateTimeZoneFactory::getDateTimeZone(self::TIMEZONE))
        );

        // Before 1976
        $this->assertNotHoliday(
            self::REGION,
            self::HOLIDAY,
            static::generateRandomYear(null, self::ESTABLISHMENT_YEAR - 1)
        );

        // From 1991 and later
        $this->assertNotHoliday(
            self::REGION,
            self::HOLIDAY,
            static::generateRandomYear(self::ABOLISHED_YEAR)
        );

        // Before 1976
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
    public function testSubstituteHoliday(int $year, ?string $expected): void
    {
        if ($expected) {
            $this->assertSubstituteHoliday(
                self::REGION,
                self::HOLIDAY,
                $year,
                new \DateTime($expected, DateTimeZoneFactory::getDateTimeZone(self::TIMEZONE))
            );
        } else {
            $this->assertNotSubstituteHoliday(
                self::REGION,
                self::HOLIDAY,
                $year
            );
        }
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
            [self::LOCALE => '국군의 날']
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
    }

    public static function SubstituteHolidayDataProvider(): \Generator
    {
        for ($i = 0; $i < 20; ++$i) {
            $year = static::generateRandomYear(self::ESTABLISHMENT_YEAR);
            switch ($year) {
                case 1989: yield [$year, '1989-10-02'];
                    break;
                default: yield [$year, null];
                    break;
            }
        }
    }
}
