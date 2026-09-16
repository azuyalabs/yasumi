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

namespace Yasumi\tests\Peru;

use Yasumi\Holiday;
use Yasumi\Provider\Peru;
use Yasumi\tests\ProviderTestCase;

/**
 * Class for testing holidays in Peru.
 */
class PeruTest extends PeruBaseTestCase implements ProviderTestCase
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
        $this->year = static::generateRandomYear(Peru::INDEPENDENCE_YEAR);
    }

    /**
     * Tests if all official holidays in Peru are defined by the provider class.
     */
    public function testOfficialHolidays(): void
    {
        $holidays = [
            'newYearsDay',
            'maundyThursday',
            'goodFriday',
            'internationalWorkersDay',
            'saintPeterAndPaulDay',
            'saintRoseOfLimaDay',
            'allSaintsDay',
            'immaculateConceptionDay',
            'christmasDay',
        ];

        if ($this->year >= Peru::INDEPENDENCE_YEAR) {
            $holidays[] = 'independenceDay';
            $holidays[] = 'independenceCelebrationDay';
        }

        if ($this->year >= Peru::BATTLE_OF_ARICA_YEAR) {
            $holidays[] = 'battleOfAricaDay';
        }

        if ($this->year >= Peru::AIR_FORCE_YEAR) {
            $holidays[] = 'airForceDay';
        }

        if ($this->year >= Peru::BATTLE_OF_JUNIN_YEAR) {
            $holidays[] = 'battleOfJuninDay';
        }

        if ($this->year >= Peru::BATTLE_OF_ANGAMOS_YEAR) {
            $holidays[] = 'battleOfAngamosDay';
        }

        if ($this->year >= Peru::BATTLE_OF_AYACUCHO_YEAR) {
            $holidays[] = 'battleOfAyacuchoDay';
        }

        $this->assertDefinedHolidays($holidays, self::REGION, $this->year, Holiday::TYPE_OFFICIAL);
    }

    /**
     * Tests if all observed holidays in Peru are defined by the provider class.
     */
    public function testObservedHolidays(): void
    {
        $this->assertDefinedHolidays([], self::REGION, $this->year, Holiday::TYPE_OBSERVANCE);
    }

    /**
     * Tests if all seasonal holidays in Peru are defined by the provider class.
     */
    public function testSeasonalHolidays(): void
    {
        $this->assertDefinedHolidays([], self::REGION, $this->year, Holiday::TYPE_SEASON);
    }

    /**
     * Tests if all other holidays in Peru are defined by the provider class.
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
