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

namespace Yasumi\tests\France\HautRhin;

use Yasumi\Holiday;

/**
 * Class for testing holidays in Haut-Rhin (France).
 */
class HautRhinTest extends HautRhinBaseTestCase
{
    /**
     * @var int year random year number used for all tests in this Test Case
     */
    protected $year;

    /**
     * Tests if all official holidays in Haut-Rhin are defined by the provider class
     */
    public function testOfficialHolidays()
    {
        $this->assertDefinedHolidays([
            'newYearsDay',
            'victoryInEuropeDay',
            'goodFriday',
            'easterMonday',
            'internationalWorkersDay',
            'ascensionDay',
            'pentecostMonday',
            'assumptionOfMary',
            'allSaintsDay',
            'armisticeDay',
            'christmasDay',
            'stStephensDay',
            'bastilleDay'
        ], self::REGION, $this->year, Holiday::TYPE_OFFICIAL);
    }

    /**
     * Tests if all observed holidays in Haut-Rhin (France) are defined by the provider class
     */
    public function testObservedHolidays()
    {
        $this->assertDefinedHolidays([], self::REGION, $this->year, Holiday::TYPE_OBSERVANCE);
    }

    /**
     * Tests if all seasonal holidays in Haut-Rhin (France) are defined by the provider class
     */
    public function testSeasonalHolidays()
    {
        $this->assertDefinedHolidays([], self::REGION, $this->year, Holiday::TYPE_SEASON);
    }

    /**
     * Tests if all bank holidays in Haut-Rhin (France) are defined by the provider class
     */
    public function testBankHolidays()
    {
        $this->assertDefinedHolidays([], self::REGION, $this->year, Holiday::TYPE_BANK);
    }

    /**
     * Tests if all other holidays in Haut-Rhin (France) are defined by the provider class
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
        $this->year = $this->generateRandomYear(1945);
    }
}
