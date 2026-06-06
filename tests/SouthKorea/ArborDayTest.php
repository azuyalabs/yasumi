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

use Yasumi\Holiday;
use Yasumi\Provider\DateTimeZoneFactory;
use Yasumi\tests\HolidayTestCase;

/**
 * Class for testing day after Arbor Day in South Korea.
 */
class ArborDayTest extends SouthKoreaBaseTestCase implements HolidayTestCase
{
    /**
     * The year in which the holiday was first established.
     */
    public const ESTABLISHMENT_YEAR = 1949;

    /**
     * The name of the holiday.
     */
    public const HOLIDAY = 'arborDay';

    /**
     * The year in which the holiday was abolished.
     */
    public const ABOLISHED_YEAR = 2006;

    /**
     * Tests the holiday defined in this test.
     *
     * @throws \Exception
     */
    public function testHoliday(): void
    {
        // From 1949 to 2005
        $year = static::generateRandomYear(self::ESTABLISHMENT_YEAR, self::ABOLISHED_YEAR - 1);
        $date = (1960 === $year) ? "{$year}-3-21" : "{$year}-4-5";

        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new \DateTime($date, DateTimeZoneFactory::getDateTimeZone(self::TIMEZONE))
        );

        // From 2006 and after
        $this->assertNotHoliday(
            self::REGION,
            self::HOLIDAY,
            static::generateRandomYear(self::ABOLISHED_YEAR)
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
    public function testSubstituteHoliday(): void
    {
        $year = static::generateRandomYear(self::ESTABLISHMENT_YEAR, self::ABOLISHED_YEAR - 1);

        if (1959 === $year) {
            $this->assertSubstituteHoliday(
                self::REGION,
                self::HOLIDAY,
                $year,
                new \DateTime('1959-04-06', DateTimeZoneFactory::getDateTimeZone(self::TIMEZONE))
            );
        } else {
            $this->assertNotSubstituteHoliday(
                self::REGION,
                static::HOLIDAY,
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
        $year = static::generateRandomYear(self::ESTABLISHMENT_YEAR, self::ABOLISHED_YEAR - 1);
        $translation = (1960 === $year) ? '사방의 날' : '식목일';

        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            $year,
            [self::LOCALE => $translation]
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
}
