<?php

/**
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 - 2018 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <stelgenhof@gmail.com>
 */

namespace Yasumi\tests\SouthAfrica;

use Yasumi\Holiday;

/**
 * Class for testing holidays in South Africa.
 *
 * @package Yasumi\tests\SouthAfrica
 * @author  Sacha Telgenhof <stelgenhof@gmail.com>
 */
class SouthAfricaTest extends SouthAfricaBaseTestCase
{
    /**
     * @var int year random year number used for all tests in this Test Case
     */
    protected $year;

    /**
     * Tests if all official holidays in SouthAfrica are defined by the provider class
     */
    public function testOfficialHolidays()
    {
        $officialHolidays = [
            'newYearsDay',
            'humanRightsDay',
            'goodFriday',
            'familyDay',
            'freedomDay',
            'internationalWorkersDay',
            'youthDay',
            'nationalWomensDay',
            'heritageDay',
            'reconciliationDay',
            'christmasDay',
            'secondChristmasDay'
        ];

        if ($this->year === 2016) {
            $officialHolidays[] = '2016MunicipalElectionsDay';
            $officialHolidays[] = 'substituteDayOfGoodwill';
        }

        $this->assertDefinedHolidays($officialHolidays, self::REGION, $this->year, Holiday::TYPE_OFFICIAL);
    }

    /**
     * Tests if all bank holidays in South Africa are defined by the provider class
     */
    public function testBankHolidays()
    {
        $this->assertDefinedHolidays([], self::REGION, $this->year, Holiday::TYPE_BANK);
    }

    /**
     * Tests if all observed holidays in South Africa are defined by the provider class
     */
    public function testObservedHolidays()
    {
        $this->assertDefinedHolidays([], self::REGION, $this->year, Holiday::TYPE_OBSERVANCE);
    }

    /**
     * Tests if all seasonal holidays in South Africa are defined by the provider class
     */
    public function testSeasonalHolidays()
    {
        $this->assertDefinedHolidays([], self::REGION, $this->year, Holiday::TYPE_SEASON);
    }

    /**
     * Tests if all other holidays in South Africa are defined by the provider class
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
        $this->year = $this->generateRandomYear(1994);
    }
}
