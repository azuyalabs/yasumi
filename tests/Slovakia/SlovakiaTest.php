<?php

/**
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 - 2017 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <stelgenhof@gmail.com>
 */


namespace Yasumi\tests\Slovakia;

use Yasumi\Holiday;

/**
 * Class for testing holidays in Slovakia.
 *
 *
 * @package Yasumi\tests\Slovakia
 * @author  Andrej Rypak (dakujem) <xrypak@gmail.com>
 */
class SlovakiaTest extends SlovakiaBaseTestCase
{
    /**
     * @var int year random year number used for all tests in this Test Case
     */
    protected $year;


    /**
     * Tests if all official holidays in Slovakia are defined by the provider class
     */
    public function testOfficialHolidays()
    {
        $this->assertDefinedHolidays([
            'newYearsDay',
            'slovakConstitutionDay',
            'slovakNationalUprisingDay',
            'saintsCyrilAndMethodiusDay',
            'struggleForFreedomAndDemocracyDay',
        ], self::REGION, $this->year, Holiday::TYPE_OFFICIAL);
    }


    /**
     * Tests if all bank holidays in Slovakia are defined by the provider class
     */
    public function testBankHolidays()
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
     * Tests if all observed holidays in Slovakia are defined by the provider class
     */
    public function testObservedHolidays()
    {
        $this->assertDefinedHolidays([], self::REGION, $this->year, Holiday::TYPE_OBSERVANCE);
    }


    /**
     * Tests if all seasonal holidays in Slovakia are defined by the provider class
     */
    public function testSeasonalHolidays()
    {
        $this->assertDefinedHolidays([], self::REGION, $this->year, Holiday::TYPE_SEASON);
    }


    /**
     * Tests if all other holidays in Slovakia are defined by the provider class
     */
    public function testOtherHolidays()
    {
        $this->assertDefinedHolidays([], self::REGION, $this->year, Holiday::TYPE_OTHER);
    }


    /**
     * Initial setup of this Test Case
     */
    protected function setUp()
    {
        // NOTE: 1993 is the year Slovakia was founded as an independent state
        $this->year = $this->generateRandomYear(1993, 2100);
    }
}
