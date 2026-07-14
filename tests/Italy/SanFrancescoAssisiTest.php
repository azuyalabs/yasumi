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

namespace Yasumi\tests\Italy;

use Yasumi\Holiday;
use Yasumi\tests\HolidayTestCase;

/**
 * Class containing tests for the Feast of Saint Francis of Assisi in Italy.
 *
 * Established as a national public holiday by Law n. 151 of 8 October 2025
 * (GU n. 236 del 10-10-2025), in force from 1 January 2026.
 * Amends Article 2 of Law 27 maggio 1949, n. 260.
 *
 * @see https://www.normattiva.it/uri-res/N2Ls?urn:nir:stato:legge:2025-10-08;151
 */
class SanFrancescoAssisiTest extends ItalyBaseTestCase implements HolidayTestCase
{
    /**
     * The name of the holiday.
     */
    public const HOLIDAY = 'sanFrancescoAssisi';

    /**
     * The year in which the holiday was first established.
     */
    public const ESTABLISHMENT_YEAR = 2026;

    /**
     * Tests the Feast of Saint Francis of Assisi on or after 2026.
     *
     * @throws \Exception
     */
    public function testSanFrancescoAssisiOnAfter2026(): void
    {
        $year = static::generateRandomYear(self::ESTABLISHMENT_YEAR);
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new \DateTime("{$year}-10-4", new \DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests that the Feast of Saint Francis of Assisi is not present before 2026.
     *
     * @throws \Exception
     */
    public function testSanFrancescoAssisiBefore2026(): void
    {
        $this->assertNotHoliday(
            self::REGION,
            self::HOLIDAY,
            static::generateRandomYear(1000, self::ESTABLISHMENT_YEAR - 1)
        );
    }

    /**
     * Tests the translated name of the Feast of Saint Francis of Assisi.
     *
     * @throws \Exception
     */
    public function testTranslation(): void
    {
        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            static::generateRandomYear(self::ESTABLISHMENT_YEAR),
            [self::LOCALE => 'Festa di San Francesco d’Assisi']
        );
    }

    /**
     * Tests the type of the holiday defined in this test.
     *
     * @throws \Exception
     */
    public function testHolidayType(): void
    {
        $this->assertHolidayType(
            self::REGION,
            self::HOLIDAY,
            static::generateRandomYear(self::ESTABLISHMENT_YEAR),
            Holiday::TYPE_OFFICIAL
        );
    }
}
