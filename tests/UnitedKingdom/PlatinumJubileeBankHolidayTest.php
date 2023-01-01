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

namespace Yasumi\tests\UnitedKingdom;

use Yasumi\Holiday;
use Yasumi\tests\HolidayTestCase;

/**
 * Class for testing the Platinum Jubilee Bank Holiday in the United Kingdom.
 */
class PlatinumJubileeBankHolidayTest extends UnitedKingdomBaseTestCase implements HolidayTestCase
{
    /**
     * The name of the holiday.
     */
    public const HOLIDAY = 'platinumJubileeBankHoliday';

    /**
     * The year in which the holiday occurred.
     */
    public const ACTIVE_YEAR = 2022;

    /**
     * The date on which the holiday occurred.
     */
    public const ACTIVE_DATE = '2022-6-3';

    /**
     * Tests the holiday defined in this test.
     *
     * @throws \Exception
     */
    public function testHoliday(): void
    {
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            self::ACTIVE_YEAR,
            new \DateTime(self::ACTIVE_DATE, new \DateTimeZone(self::TIMEZONE))
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
            self::REGION,
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
            self::REGION,
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
            self::REGION,
            self::HOLIDAY,
            self::ACTIVE_YEAR,
            [self::LOCALE => 'Platinum Jubilee Bank Holiday']
        );
    }

    /**
     * Tests type of the holiday defined in this test.
     */
    public function testHolidayType(): void
    {
        $this->assertHolidayType(
            self::REGION,
            self::HOLIDAY,
            self::ACTIVE_YEAR,
            Holiday::TYPE_BANK
        );
    }
}
