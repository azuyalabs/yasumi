<?php

declare(strict_types=1);
/*
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 - 2023 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <me at sachatelgenhof dot com>
 */

namespace Yasumi\tests\USA;

use Yasumi\Holiday;
use Yasumi\tests\HolidayTestCase;

/**
 * Class for testing New Years Day in the USA.
 */
class NewYearsDayTest extends USABaseTestCase implements HolidayTestCase
{
    /**
     * The name of the holiday.
     */
    public const HOLIDAY = 'newYearsDay';

    /**
     * Tests New Years Day.
     *
     * @throws \Exception
     */
    public function testNewYearsDay(): void
    {
        $year = 1997;
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new \DateTime("$year-1-1", new \DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests New Years Day when substituted on Monday (when New Years Day falls on Sunday).
     *
     * @throws \Exception
     */
    public function testNewYearsDaySubstitutedMonday(): void
    {
        $year = 2445;
        $this->assertHoliday(
            self::REGION,
            'substituteHoliday:newYearsDay',
            $year,
            new \DateTime("$year-1-2", new \DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests New Years Day when substituted on Friday (when New Years Day falls on Saturday).
     *
     * @throws \Exception
     */
    public function testNewYearsDaySubstitutedFriday(): void
    {
        $year = 1938;
        $subYear = $year - 1;
        $this->assertHoliday(
            self::REGION,
            'substituteHoliday:newYearsDay',
            $year,
            new \DateTime("$subYear-12-31", new \DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests translated name of the holiday defined in this test.
     *
     * @throws \Exception
     */
    public function testTranslation(): void
    {
        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(),
            [self::LOCALE => 'New Year’s Day']
        );
    }

    /**
     * Tests type of the holiday defined in this test.
     *
     * @throws \Exception
     */
    public function testHolidayType(): void
    {
        $this->assertHolidayType(self::REGION, self::HOLIDAY, $this->generateRandomYear(), Holiday::TYPE_OFFICIAL);
    }
}
