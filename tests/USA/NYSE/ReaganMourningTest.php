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

namespace Yasumi\tests\USA\NYSE;

use Yasumi\tests\USA\USABaseTestCase;

/**
 * Class to test day of closure of NYSE due to Reagan Mourning proclamation
 *
 * @author Art Kurbakov <admin at mgwebgroup dot com>
 */
class ReaganMourningTest extends USABaseTestCase
{
    /**
     * Name of provider to be tested.
     */
    public const REGION = 'USA/NYSE';

    /**
     * The year when the closure was observed.
     */
    public const OBSERVED_YEAR = 2004;

    /**
     * Tests day of closure on June 11th 2004
     *
     * @throws \Exception
     */
    public function testReaganMourning(): void
    {
        $this->assertHoliday(
            self::REGION,
            'ReaganMourning',
            self::OBSERVED_YEAR,
            new \DateTime('2004-06-11', new \DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests years before 2004
     *
     * @throws \Exception
     */
    public function testReaganMourningBefore2004(): void
    {
        $this->assertNotHoliday(
            self::REGION,
            'ReaganMourning',
            self::OBSERVED_YEAR - 1
        );
    }

    /**
     * Tests years after 2004
     *
     * @throws \Exception
     */
    public function testReaganMourningAfter2004(): void
    {
        $this->assertNotHoliday(
            self::REGION,
            'ReaganMourning',
            self::OBSERVED_YEAR + 1
        );
    }
}
