<?php

declare(strict_types = 1);

/**
 * This file is part of the 'Yasumi' package.
 *
 * The easy PHP Library for calculating holidays.
 *
 * Copyright (c) 2025 Magic Web Group
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Art Kurbakov <admin at mgwebgroup dot com>
 */

namespace Yasumi\tests\USA\NYSE;

use Yasumi\Holiday;
use Yasumi\tests\HolidayTestCase;
use Yasumi\tests\USA\USABaseTestCase;
use DateTime;
use DateTimeZone;

/**
 * Class to test day of closure of NYSE due to H.W. Bush Mourning proclamation
 */
class HWBushMourningTest extends USABaseTestCase
{
    /**
     * Name of provider to be tested.
     */
    public const REGION = 'USA/NYSE';

    /**
     * The year when the closure was observed.
     */
    public const OBSERVED_YEAR = 2018;

    /**
     * Tests day of closure on December 5th 2018
     *
     * @throws \Exception
     */
    public function testHWBushMourning(): void
    {
        $this->assertHoliday(
            self::REGION,
            'HWBushMourning',
            self::OBSERVED_YEAR,
            new DateTime("2018-12-05", new DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests years before 2018
     *
     * @throws \Exception
     */
    public function testHWBushMourningBefore2018(): void
    {
        $this->assertNotHoliday(
           	self::REGION,
            'HWBushMourning',
            self::OBSERVED_YEAR - 1
        );
    }

    /**
     * Tests years after 2018
     *
     * @throws \Exception
     */
    public function testHWBushMourningAfter2018(): void
    {
        $this->assertNotHoliday(
           	self::REGION,
            'HWBushMourning',
            self::OBSERVED_YEAR + 1
        );
    }
}
