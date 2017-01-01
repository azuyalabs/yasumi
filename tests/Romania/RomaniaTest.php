<?php
/**
 *  This file is part of the Yasumi package.
 *
 *  Copyright (c) 2015 - 2017 AzuyaLabs
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <stelgenhof@gmail.com>
 */

namespace Yasumi\tests\Romania;

use Yasumi\Holiday;

/**
 * Class RomaniaTest
 * @package Yasumi\tests\Romania
 */
class RomaniaTest extends RomaniaBaseTestCase
{
    /**
     * @var int year random year number used for all tests in this Test Case
     */
    protected $year;

    /**
     * Tests if all national holidays in Romania are defined by the provider class
     */
    public function testNationalHolidays()
    {
        $this->assertDefinedHolidays([
            'newYearsDay',
            'dayAfterNewYearsDay',
            'unitedPrincipalitiesDay',
            'internationalWorkersDay',
            'easter',
            'easterMonday',
            'christmasDay',
            'secondChristmasDay',
            'pentecost',
            'pentecostMonday',
            'assumptionOfMary',
            //'stAndrewDay',
            //'nationalDay',
        ], self::REGION, $this->year, Holiday::TYPE_NATIONAL);
    }

    /**
     * Tests if all observed holidays in Romania are defined by the provider class
     */
    public function testObservedHolidays()
    {
        $this->assertDefinedHolidays([
                'constantinBrancusiDay',
            ], self::REGION, $this->year, Holiday::TYPE_OBSERVANCE);
    }

    /**
     * Tests if all seasonal holidays in Romania are defined by the provider class
     */
    public function testSeasonalHolidays()
    {
        $this->assertDefinedHolidays([], self::REGION, $this->year, Holiday::TYPE_SEASON);
    }

    /**
     * Tests if all bank holidays in Romania are defined by the provider class
     */
    public function testBankHolidays()
    {
        $this->assertDefinedHolidays([], self::REGION, $this->year, Holiday::TYPE_BANK);
    }

    /**
     * Tests if all other holidays in Romania are defined by the provider class
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
        $this->year = $this->generateRandomYear(2015, 2025);
    }
}
