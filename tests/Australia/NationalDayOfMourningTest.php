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

namespace Yasumi\tests\Australia;

use Yasumi\Holiday;
use Yasumi\tests\HolidayTestCase;

/**
 * Class for testing National Day of Mourning in Australia.
 */
class NationalDayOfMourningTest extends AustraliaBaseTestCase implements HolidayTestCase
{
    /**
     * The name of the holiday.
     */
    public const HOLIDAY = 'nationalDayOfMourning';

    /**
     * The year in which the holiday was first established.
     */
    public const ACTIVE_YEAR = 2022;

    /**
     * The date on which the holiday occurred.
     */
    public const ACTIVE_DATE = '2022-9-22';

    /**
     * Tests the holiday defined in this test.
     *
     * @throws \Exception
     */
    public function testHoliday(): void
    {
        $this->assertHoliday(
            $this->region,
            self::HOLIDAY,
            self::ACTIVE_YEAR,
            new \DateTime(self::ACTIVE_DATE, new \DateTimeZone($this->timezone))
        );
    }

    /**
     * Tests the holiday defined in this test before the year in which it occurred.
     *
     * @throws \Exception
     */
    public function testHolidayBeforeActive(): void
    {
        $this->assertNotHoliday(
            $this->region,
            self::HOLIDAY,
            $this->generateRandomYear(1000, self::ACTIVE_YEAR - 1)
        );
    }

    /**
     * Tests the holiday defined in this test after the year in which it occurred.
     *
     * @throws \Exception
     */
    public function testHolidayAfterActive(): void
    {
        $this->assertNotHoliday(
            $this->region,
            self::HOLIDAY,
            $this->generateRandomYear(self::ACTIVE_YEAR + 1)
        );
    }

    /**
     * Tests the translated name of the holiday defined in this test.
     */
    public function testTranslation(): void
    {
        $this->assertTranslatedHolidayName(
            $this->region,
            self::HOLIDAY,
            self::ACTIVE_YEAR,
            [self::LOCALE => 'National Day of Mourning']
        );
    }

    /**
     * Tests type of the holiday defined in this test.
     */
    public function testHolidayType(): void
    {
        $this->assertHolidayType(
            $this->region,
            self::HOLIDAY,
            self::ACTIVE_YEAR,
            Holiday::TYPE_OFFICIAL
        );
    }
}
