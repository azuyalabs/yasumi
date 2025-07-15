<?php

declare(strict_types = 1);

/**
 * This file is part of the 'Yasumi' package.
 *
 * The easy PHP Library for calculating holidays.
 *
 * Copyright (c) 2015 - 2025 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <me at sachatelgenhof dot com>
 * @author Art Kurbakov <admin at mgwebgroup dot com>
 */

namespace Yasumi\tests\USA\NYSE;

use Yasumi\tests\USA\USABaseTestCase;

/**
 * Class to test day of closure of NYSE due to Jimmy Carter mourning proclamation
 */
class CarterMourningTest extends USABaseTestCase
{
    /**
     * Name of provider to be tested.
     */
    public const REGION = 'USA/NYSE';

    /**
     * The year when the closure was observed.
     */
    public const OBSERVED_YEAR = 2025;

    /**
     * Tests day of closure on January 9th 2025
     *
     * @throws \Exception
     */
    public function testCarterMourning(): void
    {
        $this->assertHoliday(
            self::REGION,
            'CarterMourning',
            self::OBSERVED_YEAR,
            new \DateTime('2025-01-09', new \DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests years before 2025
     *
     * @throws \Exception
     */
    public function testCarterMourningBefore2025(): void
    {
        $this->assertNotHoliday(
            self::REGION,
            'CarterMourning',
            self::OBSERVED_YEAR - 1
        );
    }

    /**
     * Tests years after 2025
     *
     * @throws \Exception
     */
    public function testCarterMourningAfter2025(): void
    {
        $this->assertNotHoliday(
            self::REGION,
            'CarterMourning',
            self::OBSERVED_YEAR + 1
        );
    }
}
