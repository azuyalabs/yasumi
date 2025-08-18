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
 */

namespace Yasumi\tests\USA\NYSE;

use Yasumi\tests\USA\USABaseTestCase;

/**
 * Class to test 2 days of closure of NYSE due to Hurricane Sandy
 *
 * @author Art Kurbakov <admin at mgwebgroup dot com>
 */
class HurricaneSandyTest extends USABaseTestCase
{
    /**
     * Name of provider to be tested.
     */
    public const REGION = 'USA/NYSE';

    /**
     * The year when the closure was observed.
     */
    public const OBSERVED_YEAR = 2012;

    /**
     * Tests both days of closure of October 29-30th, 2012
     *
     * @throws \Exception
     */
    public function testHurricaneSandyDays(): void
    {
        $this->assertHoliday(
            self::REGION,
            'hurricaneSandy1',
            self::OBSERVED_YEAR,
            new \DateTime('2012-10-29', new \DateTimeZone(self::TIMEZONE))
        );

        $this->assertHoliday(
            self::REGION,
            'hurricaneSandy2',
            self::OBSERVED_YEAR,
            new \DateTime('2012-10-30', new \DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests years before 2012
     *
     * @throws \Exception
     */
    public function testHurricaneSandyBefore2012(): void
    {
        $this->assertNotHoliday(
            self::REGION,
            'hurricaneSandy1',
            self::OBSERVED_YEAR - 1
        );

        $this->assertNotHoliday(
            self::REGION,
            'hurricaneSandy2',
            self::OBSERVED_YEAR - 1
        );
    }

    /**
     * Tests years after 2012
     *
     * @throws \Exception
     */
    public function testHurricaneSandyAfter2012(): void
    {
        $this->assertNotHoliday(
            self::REGION,
            'hurricaneSandy1',
            self::OBSERVED_YEAR + 1
        );

        $this->assertNotHoliday(
            self::REGION,
            'hurricaneSandy2',
            self::OBSERVED_YEAR + 1
        );
    }
}
