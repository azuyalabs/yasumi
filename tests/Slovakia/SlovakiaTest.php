<?php

declare(strict_types = 1);

/**
 * This file is part of the 'Yasumi' package.
 *
 * The easy PHP Library for calculating holidays.
 *
 * Copyright (c) 2015 - 2024 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <me at sachatelgenhof dot com>
 */

namespace Yasumi\tests\Slovakia;

use Yasumi\Holiday;
use Yasumi\tests\ProviderTestCase;

/**
 * Class for testing holidays in Slovakia.
 *
 * @author  Andrej Rypak (dakujem) <xrypak@gmail.com>
 */
class SlovakiaTest extends SlovakiaBaseTestCase implements ProviderTestCase
{
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
        // NOTE: 1993 is the year Slovakia was founded as an independent state
        $this->year = $this->generateRandomYear(1993, 2100);
    }

    /**
     * Tests if all official holidays in Slovakia are defined by the provider class.
     */
    public function testOfficialHolidays(): void
    {
        $this->assertDefinedHolidays([
            'slovakIndependenceDay',
            'slovakNationalUprisingDay',
            'saintsCyrilAndMethodiusDay',
            'struggleForFreedomAndDemocracyDay',
        ], self::REGION, $this->year, Holiday::TYPE_OFFICIAL);

        $this->assertDefinedHolidays([
            'slovakConstitutionDay',
        ], self::REGION, 2013, Holiday::TYPE_OFFICIAL);

        $this->assertDefinedHolidays([
            'declarationOfTheSlovakNation',
        ], self::REGION, 2018, Holiday::TYPE_OFFICIAL);
    }

    /**
     * Tests if all bank holidays in Slovakia are defined by the provider class.
     */
    public function testBankHolidays(): void
    {
        $this->assertDefinedHolidays([
            'epiphany',
            'internationalWorkersDay',
            'victoryInEuropeDay',
            'ourLadyOfSorrowsDay',
            'allSaintsDay',
            'christmasEve',
            'christmasDay',
            'secondChristmasDay',
            'goodFriday',
            'easterMonday',
        ], self::REGION, $this->year, Holiday::TYPE_BANK);
    }

    /**
     * Tests if all observed holidays in Slovakia are defined by the provider class.
     */
    public function testObservedHolidays(): void
    {
        $this->assertDefinedHolidays([], self::REGION, $this->year, Holiday::TYPE_OBSERVANCE);
    }

    /**
     * Tests if all seasonal holidays in Slovakia are defined by the provider class.
     */
    public function testSeasonalHolidays(): void
    {
        $this->assertDefinedHolidays([], self::REGION, $this->year, Holiday::TYPE_SEASON);
    }

    /**
     * Tests if all other holidays in Slovakia are defined by the provider class.
     */
    public function testOtherHolidays(): void
    {
        $this->assertDefinedHolidays([], self::REGION, $this->year, Holiday::TYPE_OTHER);
    }

    /**
     * @throws \ReflectionException
     * @throws \Exception
     */
    public function testSources(): void
    {
        $this->assertSources(self::REGION, 2);
    }
}
