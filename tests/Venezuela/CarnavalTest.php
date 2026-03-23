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

namespace Yasumi\tests\Venezuela;

use Yasumi\Holiday;
use Yasumi\Provider\ChristianHolidays;
use Yasumi\tests\HolidayTestCase;

/**
 * Class for testing Carnival holidays in Venezuela.
 */
class CarnavalTest extends VenezuelaBaseTestCase implements HolidayTestCase
{
    use ChristianHolidays;

    /**
     * The year in which the holiday was first established.
     */
    public const ESTABLISHMENT_YEAR = 1700;

    /**
     * Tests Carnival Monday on or after 1700.
     *
     * @throws \Exception
     */
    public function testCarnavalMondayAfter1700(): void
    {
        $year = static::generateRandomYear(self::ESTABLISHMENT_YEAR);
        $easter = $this->calculateEaster($year, self::TIMEZONE);
        $expected = (clone $easter)->sub(new \DateInterval('P48D'));

        $this->assertHoliday(
            self::REGION,
            'carnavalMonday',
            $year,
            $expected
        );
    }

    /**
     * Tests Carnival Tuesday on or after 1700.
     *
     * @throws \Exception
     */
    public function testCarnavalTuesdayAfter1700(): void
    {
        $year = static::generateRandomYear(self::ESTABLISHMENT_YEAR);
        $easter = $this->calculateEaster($year, self::TIMEZONE);
        $expected = (clone $easter)->sub(new \DateInterval('P47D'));

        $this->assertHoliday(
            self::REGION,
            'carnavalTuesday',
            $year,
            $expected
        );
    }

    /**
     * Tests Carnival Monday before 1700.
     *
     * @throws \Exception
     */
    public function testCarnavalMondayBefore1700(): void
    {
        $year = static::generateRandomYear(1000, self::ESTABLISHMENT_YEAR - 1);
        $this->assertNotHoliday(self::REGION, 'carnavalMonday', $year);
    }

    /**
     * Tests Carnival Tuesday before 1700.
     *
     * @throws \Exception
     */
    public function testCarnavalTuesdayBefore1700(): void
    {
        $year = static::generateRandomYear(1000, self::ESTABLISHMENT_YEAR - 1);
        $this->assertNotHoliday(self::REGION, 'carnavalTuesday', $year);
    }

    /**
     * Tests the translated name of the holiday defined in this test.
     *
     * @throws \Exception
     */
    public function testTranslation(): void
    {
        $year = static::generateRandomYear(self::ESTABLISHMENT_YEAR);
        $this->assertTranslatedHolidayName(
            self::REGION,
            'carnavalMonday',
            $year,
            [self::LOCALE => 'Lunes de Carnaval']
        );
        $this->assertTranslatedHolidayName(
            self::REGION,
            'carnavalTuesday',
            $year,
            [self::LOCALE => 'Martes de Carnaval']
        );
    }

    /**
     * Tests type of the holiday defined in this test.
     *
     * @throws \Exception
     */
    public function testHolidayType(): void
    {
        $year = static::generateRandomYear(self::ESTABLISHMENT_YEAR);
        $this->assertHolidayType(self::REGION, 'carnavalMonday', $year, Holiday::TYPE_OFFICIAL);
        $this->assertHolidayType(self::REGION, 'carnavalTuesday', $year, Holiday::TYPE_OFFICIAL);
    }
}
