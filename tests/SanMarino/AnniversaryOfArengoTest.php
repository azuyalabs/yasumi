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
use Yasumi\Provider\SanMarino;
use Yasumi\tests\HolidayTestCase;

/**
 * Class containing tests for the Anniversary of the Arengo in San Marino.
 *
 * Celebrated on 25 March, this holiday commemorates the reconvening of the Arengo (popular assembly)
 * in 1906, which granted democratic rights to San Marino's citizens.
 *
 * @see https://en.wikipedia.org/wiki/Arengo_(San_Marino)
 */
class AnniversaryOfArengoTest extends SanMarinoBaseTestCase implements HolidayTestCase
{
    /**
     * The name of the holiday.
     */
    public const HOLIDAY = 'anniversaryOfArengo';

    /**
     * Tests the Anniversary of the Arengo on or after 1906.
     *
     * @throws \Exception
     */
    public function testAnniversaryOfArengoOnAfter1906(): void
    {
        $year = static::generateRandomYear(SanMarino::ARENGO_YEAR);
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new \DateTime("{$year}-3-25", new \DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests the Anniversary of the Arengo before 1906.
     *
     * @throws \Exception
     */
    public function testAnniversaryOfArengoBefore1906(): void
    {
        $this->assertNotHoliday(
            self::REGION,
            self::HOLIDAY,
            static::generateRandomYear(1000, SanMarino::ARENGO_YEAR - 1)
        );
    }

    /**
     * Tests translated name of the Anniversary of the Arengo.
     *
     * @throws \Exception
     */
    public function testTranslation(): void
    {
        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            static::generateRandomYear(SanMarino::ARENGO_YEAR),
            [self::LOCALE => "Anniversario dell\u{2019}Arengo"]
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
            static::generateRandomYear(SanMarino::ARENGO_YEAR),
            Holiday::TYPE_OFFICIAL
        );
    }
}
