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

namespace Yasumi\tests\Bulgaria;

use Yasumi\Holiday;
use Yasumi\tests\ProviderTestCase;

class BulgariaTest extends BulgariaBaseTestCase implements ProviderTestCase
{
    protected int $year;

    protected function setUp(): void
    {
        $this->year = $this->generateRandomYear();
    }

    public function testOfficialHolidays(): void
    {
        $holidays = [
            'newYearsDay',
            'internationalWorkersDay',
            'stGeorgesDay',
            'christmasDay',
            'christmasEve',
            'secondChristmasDay',
            'orthodoxEaster',
            'orthodoxGoodFriday',
            'orthodoxEasterMonday',
        ];

        if ($this->year >= 1885) {
            $holidays[] = 'unificationDay';
        }

        if ($this->year >= 1908) {
            $holidays[] = 'independenceDay';
        }

        if ($this->year >= 1990) {
            $holidays[] = 'liberationDay';
            $holidays[] = 'educationCultureSlavonicLiteratureDay';
        }

        $this->assertDefinedHolidays($holidays, self::REGION, $this->year, Holiday::TYPE_OFFICIAL);
    }

    public function testObservedHolidays(): void
    {
        $this->assertDefinedHolidays([], self::REGION, $this->year, Holiday::TYPE_OBSERVANCE);
    }

    public function testSeasonalHolidays(): void
    {
        $this->assertDefinedHolidays([], self::REGION, $this->year, Holiday::TYPE_SEASON);
    }

    public function testBankHolidays(): void
    {
        $this->assertDefinedHolidays([], self::REGION, $this->year, Holiday::TYPE_BANK);
    }

    public function testOtherHolidays(): void
    {
        $this->assertDefinedHolidays([], self::REGION, $this->year, Holiday::TYPE_OTHER);
    }

    public function testSources(): void
    {
        $this->assertSources(self::REGION, 2);
    }
}
