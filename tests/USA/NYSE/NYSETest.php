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

use Yasumi\Holiday;
use Yasumi\tests\ProviderTestCase;
use Yasumi\tests\USA\USABaseTestCase;

/**
 * Class for testing closure days for NYSE
 *
 * @author Art Kurbakov <admin at mgwebgroup dot com>
 */
class NYSETest extends USABaseTestCase implements ProviderTestCase
{
    /**
     * Country (name) to be tested.
     */
    public const REGION = 'USA/NYSE';

    /**
     * @var int year random year number used for all tests in this Test Case
     */
    protected int $year;

    /**
     * Initial setup of this Test Case.
     *
     * @throws \Exception
     */
    protected function setUp(): void
    {
        $this->year = $this->generateRandomYear(2000);
    }

    /**
     * Tests if all official holidays in the USA are defined by the provider class.
     */
    public function testOfficialHolidays(): void
    {
        $holidays = [
            'newYearsDay',
            'martinLutherKingDay',
            'washingtonsBirthday',
            'goodFriday',
            'memorialDay',
            'independenceDay',
            'labourDay',
            'thanksgivingDay',
            'christmasDay',
        ];

        if (2001 === $this->year) {
            $holidays[] = 'WTCAttack1';
            $holidays[] = 'WTCAttack2';
            $holidays[] = 'WTCAttack3';
            $holidays[] = 'WTCAttack4';
        }

        if (2004 === $this->year) {
            $holidays[] = 'ReaganMourning';
        }

        if (2007 === $this->year) {
            $holidays[] = 'GRFordMourning';
        }

        if (2012 === $this->year) {
            $holidays[] = 'hurricaneSandy1';
            $holidays[] = 'hurricaneSandy2';
        }

        if (2018 === $this->year) {
            $holidays[] = 'HWBushMourning';
        }

        if (2021 > $this->year) {
            $holidays[] = 'juneteenth';
        }

        if (2025 > $this->year) {
            $holidays[] = 'CarterMourning';
        }

        $this->assertDefinedHolidays($holidays, self::REGION, $this->year, Holiday::TYPE_OFFICIAL);
    }

    /**
     * @throws \ReflectionException
     * @throws \Exception
     */
    public function testSources(): void
    {
        $this->assertSources(self::REGION, 5);
    }
}
