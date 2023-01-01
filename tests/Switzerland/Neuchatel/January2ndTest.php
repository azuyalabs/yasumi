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

namespace Yasumi\tests\Switzerland\Neuchatel;

use Yasumi\Holiday;
use Yasumi\tests\HolidayTestCase;

/**
 * Class for testing January 2nd in Neuchatel (Switzerland).
 */
class January2ndTest extends NeuchatelBaseTestCase implements HolidayTestCase
{
    /**
     * The name of the holiday.
     */
    public const HOLIDAY = 'january2nd';

    /**
     * One of the year the holiday is observed.
     */
    public const OBSERVANCE_YEAR = 2023;

    /**
     * Tests January 2nd.
     *
     * @throws \Exception
     */
    public function testJanuary2nd(): void
    {
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            self::OBSERVANCE_YEAR,
            new \DateTime(self::OBSERVANCE_YEAR.'-1-02', new \DateTimeZone(self::TIMEZONE))
        );
        $this->assertNotHoliday(
            self::REGION,
            self::HOLIDAY,
            2020
        );
        $this->assertNotHoliday(
            self::REGION,
            self::HOLIDAY,
            2021
        );
        $this->assertNotHoliday(
            self::REGION,
            self::HOLIDAY,
            2022
        );
        $this->assertNotHoliday(
            self::REGION,
            self::HOLIDAY,
            2024
        );
    }

    /**
     * Tests translated name of January 2nd.
     */
    public function testTranslation(): void
    {
        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            self::OBSERVANCE_YEAR,
            [self::LOCALE => '2 janvier']
        );
    }

    /**
     * Tests type of the holiday defined in this test.
     */
    public function testHolidayType(): void
    {
        $this->assertHolidayType(self::REGION, self::HOLIDAY, self::OBSERVANCE_YEAR, Holiday::TYPE_OTHER);
    }
}
