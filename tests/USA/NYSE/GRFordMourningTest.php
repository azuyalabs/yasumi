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
 * Class to test day of closure of NYSE due to G.R. Ford Mourning proclamation
 *
 * @author Art Kurbakov <admin at mgwebgroup dot com>
 */
class GRFordMourningTest extends USABaseTestCase
{
    /**
     * Name of provider to be tested.
     */
    public const REGION = 'USA/NYSE';

    /**
     * The year when the closure was observed.
     */
    public const OBSERVED_YEAR = 2007;

    /**
     * Tests day of closure on January 2nd 2007
     *
     * @throws \Exception
     */
    public function testGRFordMourning(): void
    {
        $this->assertHoliday(
            self::REGION,
            'GRFordMourning',
            self::OBSERVED_YEAR,
            new \DateTime('2007-01-02', new \DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests years before 2007
     *
     * @throws \Exception
     */
    public function testGRFordMourningBefore2007(): void
    {
        $this->assertNotHoliday(
            self::REGION,
            'GRFordMourning',
            self::OBSERVED_YEAR - 1
        );
    }

    /**
     * Tests years after 2007
     *
     * @throws \Exception
     */
    public function testGRFordMourningAfter2007(): void
    {
        $this->assertNotHoliday(
            self::REGION,
            'GRFordMourning',
            self::OBSERVED_YEAR + 1
        );
    }
}
