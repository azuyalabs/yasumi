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

namespace Yasumi\tests\Venezuela;

use Yasumi\Holiday;
use Yasumi\Provider\Venezuela;
use Yasumi\tests\ProviderTestCase;

/**
 * Class for testing holidays in Venezuela.
 */
class VenezuelaTest extends VenezuelaBaseTestCase implements ProviderTestCase
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
        $this->year = static::generateRandomYear(Venezuela::INDEPENDENCE_YEAR);
    }

    /**
     * Tests if all official holidays in Venezuela are defined by the provider class.
     */
    public function testOfficialHolidays(): void
    {
        $holidays = [
            'newYearsDay',
            'carnivalMonday',
            'carnivalTuesday',
            'maundyThursday',
            'goodFriday',
            'internationalWorkersDay',
            'christmasEve',
            'christmasDay',
            'newYearsEve',
        ];

        if ($this->year >= Venezuela::DECLARATION_OF_INDEPENDENCE_YEAR) {
            $holidays[] = 'declarationOfIndependenceDay';
        }

        if ($this->year >= Venezuela::BATTLE_OF_CARABOBO_YEAR) {
            $holidays[] = 'battleOfCaraboboDay';
        }

        if ($this->year >= Venezuela::INDEPENDENCE_YEAR) {
            $holidays[] = 'independenceDay';
        }

        if ($this->year >= Venezuela::BOLIVAR_BIRTH_YEAR) {
            $holidays[] = 'bolivarBirthdayDay';
        }

        if ($this->year >= Venezuela::COLUMBUS_YEAR) {
            $holidays[] = 'indigenousResistanceDay';
        }

        $this->assertDefinedHolidays($holidays, self::REGION, $this->year, Holiday::TYPE_OFFICIAL);
    }

    /**
     * Tests if all observed holidays in Venezuela are defined by the provider class.
     */
    public function testObservedHolidays(): void
    {
        $this->assertDefinedHolidays([], self::REGION, $this->year, Holiday::TYPE_OBSERVANCE);
    }

    /**
     * Tests if all seasonal holidays in Venezuela are defined by the provider class.
     */
    public function testSeasonalHolidays(): void
    {
        $this->assertDefinedHolidays([], self::REGION, $this->year, Holiday::TYPE_SEASON);
    }

    /**
     * Tests if all other holidays in Venezuela are defined by the provider class.
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
