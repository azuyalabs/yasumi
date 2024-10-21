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

namespace Yasumi\tests\Germany\Berlin;

use Yasumi\Holiday;
use Yasumi\tests\HolidayTestCase;

/**
 * Class for testing Day of Liberation 2020 in Berlin (Germany).
 */
class DayOfLiberationTest extends BerlinBaseTestCase implements HolidayTestCase
{
    /**
     * The name of the holiday to be tested.
     */
    public const HOLIDAY = 'dayOfLiberation';

    /**
     * The years in which the holiday takes place.
     */
    public static $years = [2020,2025];

    /**
     * Test the holiday defined in this test.
     *
     * @throws \Exception
     */
    public function testHolidayInYear(): void
    {
        foreach(self::$years AS $year)
        {
            $this->assertHoliday(
                self::REGION,
                self::HOLIDAY,
                $year,
                new \DateTime($year . '-05-08', new \DateTimeZone(self::TIMEZONE))
            );
        }
    }

    /**
     * Test the holiday defined in this test in the years before.
     *
     * @throws \Exception
     */
    public function testHolidayBeforeYear(): void
    {
        reset(self::$years);
        $this->assertNotHoliday(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(1000, current(self::$years) - 1)
        );
    }

    /**
     * Test the holiday defined in this test in the years after.
     *
     * @throws \Exception
     */
    public function testHolidayAfterYear(): void
    {
        end(self::$years);
        $this->assertNotHoliday(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(current(self::$years) + 1)
        );
    }

    /**
     * Tests the translated name of the holiday defined in this test.
     */
    public function testTranslation(): void
    {
        reset(self::$years);
        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            current(self::$years),
            [self::LOCALE => 'Tag der Befreiung']
        );
    }

    /**
     * Tests type of the holiday defined in this test.
     */
    public function testHolidayType(): void
    {
        reset(self::$years);
        $this->assertHolidayType(
            self::REGION,
            self::HOLIDAY,
            current(self::$years),
            Holiday::TYPE_OFFICIAL
        );
    }
}
