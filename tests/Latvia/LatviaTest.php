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

namespace Yasumi\tests\Latvia;

use Yasumi\Holiday;
use Yasumi\Provider\Latvia;

/**
 * Class for testing holidays in Latvia.
 *
 * @author Gedas Lukošius <gedas@lukosius.me>
 */
class LatviaTest extends LatviaBaseTestCase
{
    /**
     * Tests if all official holidays in Latvia are defined by the provider class
     */
    public function testOfficialHolidays()
    {
        $holidays = [
            'newYearsDay',
            'goodFriday',
            'easter',
            'easterMonday',
            'internationalWorkersDay',
            'midsummerEveDay',
            'stJohnsDay',
            'christmasEve',
            'christmasDay',
            'secondChristmasDay',
            'newYearsEve'
        ];

        $year = $this->generateRandomYear();

        if ($year >= Latvia::RESTORATION_OF_INDEPENDENCE_YEAR) {
            $holidays[] = 'restorationOfIndependenceOfLatviaDay';
        }

        if ($year >= Latvia::PROCLAMATION_OF_INDEPENDENCE_YEAR) {
            $holidays[] = 'proclamationOfTheRepublicOfLatviaDay';
        }

        $this->assertDefinedHolidays($holidays, self::REGION, $year, Holiday::TYPE_OFFICIAL);
    }

    /**
     * Tests if all observed holidays in Latvia are defined by the provider class
     */
    public function testObservedHolidays()
    {
        $this->assertDefinedHolidays([], self::REGION, $this->generateRandomYear(), Holiday::TYPE_OBSERVANCE);
    }

    /**
     * Tests if all seasonal holidays in Latvia are defined by the provider class
     */
    public function testSeasonalHolidays()
    {
        $this->assertDefinedHolidays([], self::REGION, $this->generateRandomYear(), Holiday::TYPE_SEASON);
    }

    /**
     * Tests if all bank holidays in Latvia are defined by the provider class
     */
    public function testBankHolidays()
    {
        $this->assertDefinedHolidays([], self::REGION, $this->generateRandomYear(), Holiday::TYPE_BANK);
    }

    /**
     * Tests if all other holidays in Latvia are defined by the provider class
     */
    public function testOtherHolidays()
    {
        $this->assertDefinedHolidays([], self::REGION, $this->generateRandomYear(), Holiday::TYPE_OTHER);
    }
}
