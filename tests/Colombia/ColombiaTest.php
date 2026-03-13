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

namespace Yasumi\tests\Colombia;

use Yasumi\Holiday;
use Yasumi\Provider\Colombia;
use Yasumi\tests\ProviderTestCase;

/**
 * Class for testing holidays in Colombia.
 */
class ColombiaTest extends ColombiaBaseTestCase implements ProviderTestCase
{
    /** @var int year random year number used for all tests in this Test Case */
    protected int $year;

    /**
     * Initial setup of this Test Case.
     *
     * @throws \Exception
     */
    protected function setUp(): void
    {
        $this->year = static::generateRandomYear(Colombia::INDEPENDENCE_YEAR);
    }

    /**
     * Tests if all official holidays in Colombia are defined by the provider class.
     */
    public function testOfficialHolidays(): void
    {
        $holidays = [
            'newYearsDay',
            'epiphany',
            'stJosephsDay',
            'maundyThursday',
            'goodFriday',
            'internationalWorkersDay',
            'ascensionDay',
            'corpusChristi',
            'sacredHeartDay',
            'saintsPeterAndPaulDay',
            'assumptionOfMary',
            'columbusDay',
            'allSaintsDay',
            'independenceOfCartagenaDay',
            'immaculateConception',
            'christmasDay',
        ];

        if ($this->year >= Colombia::INDEPENDENCE_YEAR) {
            $holidays[] = 'independenceDay';
        }

        if ($this->year >= Colombia::BATTLE_OF_BOYACA_YEAR) {
            $holidays[] = 'battleOfBoyacaDay';
        }

        $this->assertDefinedHolidays($holidays, self::REGION, $this->year, Holiday::TYPE_OFFICIAL);
    }

    /**
     * Tests if all observed holidays in Colombia are defined by the provider class.
     */
    public function testObservedHolidays(): void
    {
        $this->assertDefinedHolidays([], self::REGION, $this->year, Holiday::TYPE_OBSERVANCE);
    }

    /**
     * Tests if all seasonal holidays in Colombia are defined by the provider class.
     */
    public function testSeasonalHolidays(): void
    {
        $this->assertDefinedHolidays([], self::REGION, $this->year, Holiday::TYPE_SEASON);
    }

    /**
     * Tests if all other holidays in Colombia are defined by the provider class.
     */
    public function testOtherHolidays(): void
    {
        $this->assertDefinedHolidays([], self::REGION, $this->year, Holiday::TYPE_OTHER);
    }

    /** @throws \Exception */
    public function testSources(): void
    {
        $this->assertSources(self::REGION, 4);
    }
}
