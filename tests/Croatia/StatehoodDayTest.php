<?php

declare(strict_types = 1);

/**
 * This file is part of the 'Yasumi' package.
 *
 * The easy PHP Library for calculating holidays.
 *
 * Copyright (c) 2015 - 2024 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <me at sachatelgenhof dot com>
 */

namespace Yasumi\tests\Croatia;

use Yasumi\Holiday;
use Yasumi\tests\HolidayTestCase;

/**
 * Class containing tests for Statehood Day in Croatia.
 */
class StatehoodDayTest extends CroatiaBaseTestCase implements HolidayTestCase
{
    /**
     * The name of the holiday.
     */
    public const HOLIDAY = 'statehoodDay';

    /**
     * The year in which the holiday was first established.
     */
    public const ESTABLISHMENT_YEAR = 1991;

    /**
     * The year in which the holiday celebration date has changed.
     */
    public const DATE_CHANGE_YEAR = 2020;

    /**
     * Tests Statehood Day.
     *
     * @throws \Exception
     */
    public function testStatehoodDay(): void
    {
        $year = $this->generateRandomYear(self::ESTABLISHMENT_YEAR, self::DATE_CHANGE_YEAR - 1);
        $expectedDate = "{$year}-6-25";
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new \DateTime($expectedDate, new \DateTimeZone(self::TIMEZONE))
        );

        $year = $this->generateRandomYear(self::DATE_CHANGE_YEAR);
        $expectedDate = "{$year}-5-30";
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new \DateTime($expectedDate, new \DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests Statehood Day before 1991.
     *
     * @throws \Exception
     */
    public function testStatehoodDayBefore1991(): void
    {
        $this->assertNotHoliday(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(1000, self::ESTABLISHMENT_YEAR - 1)
        );
    }

    /**
     * Tests translated name of Statehood Day.
     *
     * @throws \Exception
     */
    public function testTranslation(): void
    {
        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(self::ESTABLISHMENT_YEAR),
            [self::LOCALE => 'Dan državnosti']
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
            $this->generateRandomYear(self::ESTABLISHMENT_YEAR),
            Holiday::TYPE_OFFICIAL
        );
    }
}
