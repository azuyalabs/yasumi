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

namespace Yasumi\tests\Lithuania;

use Yasumi\Holiday;
use Yasumi\Provider\Lithuania;

/**
 * Class for testing holidays in Lithuania.
 *
 * @author Gedas Lukošius <gedas@lukosius.me>
 */
class LithuaniaTest extends LithuaniaBaseTestCase
{
    /**
     * Tests if all official holidays in Lithuania are defined by the provider class
     */
    public function testOfficialHolidays()
    {
        $holidays = [
            'newYearsDay',
            'easter',
            'easterMonday',
            'internationalWorkersDay',
            'stJohnsDay',
            'assumptionOfMary',
            'allSaintsDay',
            'christmasEve',
            'christmasDay',
            'secondChristmasDay',
        ];

        $year = $this->generateRandomYear();

        if ($year >= Lithuania::RESTORATION_OF_THE_STATE_YEAR) {
            $holidays[] = 'restorationOfTheStateOfLithuaniaDay';
        }

        if ($year >= Lithuania::RESTORATION_OF_INDEPENDENCE_YEAR) {
            $holidays[] = 'restorationOfIndependenceOfLithuaniaDay';
        }

        if ($year >= Lithuania::STATEHOOD_YEAR) {
            $holidays[] = 'statehoodDay';
        }

        $this->assertDefinedHolidays($holidays, self::REGION, $year, Holiday::TYPE_OFFICIAL);
    }

    /**
     * Tests if all observed holidays in Lithuania are defined by the provider class
     */
    public function testObservedHolidays()
    {
        $this->assertDefinedHolidays([], self::REGION, $this->generateRandomYear(), Holiday::TYPE_OBSERVANCE);
    }

    /**
     * Tests if all seasonal holidays in Lithuania are defined by the provider class
     */
    public function testSeasonalHolidays()
    {
        $this->assertDefinedHolidays([], self::REGION, $this->generateRandomYear(), Holiday::TYPE_SEASON);
    }

    /**
     * Tests if all bank holidays in Lithuania are defined by the provider class
     */
    public function testBankHolidays()
    {
        $this->assertDefinedHolidays([], self::REGION, $this->generateRandomYear(), Holiday::TYPE_BANK);
    }

    /**
     * Tests if all other holidays in Lithuania are defined by the provider class
     */
    public function testOtherHolidays()
    {
        $this->assertDefinedHolidays([], self::REGION, $this->generateRandomYear(), Holiday::TYPE_OTHER);
    }
}
