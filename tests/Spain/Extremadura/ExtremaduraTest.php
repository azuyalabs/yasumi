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

namespace Yasumi\tests\Spain\Extremadura;

use Yasumi\Holiday;

/**
 * Class for testing holidays in Extremadura (Spain).
 */
class ExtremaduraTest extends ExtremaduraBaseTestCase
{
    /**
     * @var int year random year number used for all tests in this Test Case
     */
    protected $year;

    /**
     * Tests if all official holidays in Extremadura (Spain) are defined by the provider class
     */
    public function testOfficialHolidays()
    {
        $this->assertDefinedHolidays([
            'newYearsDay',
            'epiphany',
            'goodFriday',
            'easter',
            'internationalWorkersDay',
            'assumptionOfMary',
            'extremaduraDay',
            'nationalDay',
            'allSaintsDay',
            'constitutionDay',
            'immaculateConception',
            'christmasDay'
        ], self::REGION, $this->year, Holiday::TYPE_OFFICIAL);
    }

    /**
     * Tests if all observed holidays in Extremadura are defined by the provider class
     */
    public function testObservedHolidays()
    {
        $this->assertDefinedHolidays(['maundyThursday'], self::REGION, $this->year, Holiday::TYPE_OBSERVANCE);
    }

    /**
     * Tests if all seasonal holidays in Extremadura are defined by the provider class
     */
    public function testSeasonalHolidays()
    {
        $this->assertDefinedHolidays([], self::REGION, $this->year, Holiday::TYPE_SEASON);
    }

    /**
     * Tests if all bank holidays in Extremadura are defined by the provider class
     */
    public function testBankHolidays()
    {
        $this->assertDefinedHolidays([], self::REGION, $this->year, Holiday::TYPE_BANK);
    }

    /**
     * Tests if all other holidays in Extremadura are defined by the provider class
     */
    public function testOtherHolidays()
    {
        $this->assertDefinedHolidays(['valentinesDay'], self::REGION, $this->year, Holiday::TYPE_OTHER);
    }

    /**
     * Initial setup of this Test Case
     */
    protected function setUp()
    {
        $this->year = $this->generateRandomYear(1984);
    }
}
