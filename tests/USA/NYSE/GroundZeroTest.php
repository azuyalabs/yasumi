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
 * Class to test 4 days of closure of NYSE due to September 11th attacks
 *
 * @author Art Kurbakov <admin at mgwebgroup dot com>
 */
class GroundZeroTest extends USABaseTestCase
{
    /**
     * Name of provider to be tested.
     */
    public const REGION = 'USA/NYSE';

    /**
     * The year when the closure was observed.
     */
    public const OBSERVED_YEAR = 2001;

    /**
     * Tests 4 days of closure on September 11th 2001
     *
     * @throws \Exception
     */
    public function testGroundZero(): void
    {
        $this->assertHoliday(
            self::REGION,
            'groundZero1',
            self::OBSERVED_YEAR,
            new \DateTime('2001-09-11', new \DateTimeZone(self::TIMEZONE))
        );

        $this->assertHoliday(
            self::REGION,
            'groundZero2',
            self::OBSERVED_YEAR,
            new \DateTime('2001-09-12', new \DateTimeZone(self::TIMEZONE))
        );

        $this->assertHoliday(
            self::REGION,
            'groundZero3',
            self::OBSERVED_YEAR,
            new \DateTime('2001-09-13', new \DateTimeZone(self::TIMEZONE))
        );

        $this->assertHoliday(
            self::REGION,
            'groundZero4',
            self::OBSERVED_YEAR,
            new \DateTime('2001-09-14', new \DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests years before 2001
     *
     * @throws \Exception
     */
    public function testGroundZeroBefore2001(): void
    {
        $this->assertNotHoliday(
            self::REGION,
            'groundZero1',
            self::OBSERVED_YEAR - 1
        );

        $this->assertNotHoliday(
            self::REGION,
            'groundZero2',
            self::OBSERVED_YEAR - 1
        );

        $this->assertNotHoliday(
            self::REGION,
            'groundZero3',
            self::OBSERVED_YEAR - 1
        );

        $this->assertNotHoliday(
            self::REGION,
            'groundZero4',
            self::OBSERVED_YEAR - 1
        );
    }

    /**
     * Tests years after 2001
     *
     * @throws \Exception
     */
    public function testGroundZeroAfter2001(): void
    {
        $this->assertNotHoliday(
            self::REGION,
            'groundZero1',
            self::OBSERVED_YEAR + 1
        );

        $this->assertNotHoliday(
            self::REGION,
            'groundZero2',
            self::OBSERVED_YEAR + 1
        );

        $this->assertNotHoliday(
            self::REGION,
            'groundZero3',
            self::OBSERVED_YEAR + 1
        );

        $this->assertNotHoliday(
            self::REGION,
            'groundZero4',
            self::OBSERVED_YEAR + 1
        );
    }
}
