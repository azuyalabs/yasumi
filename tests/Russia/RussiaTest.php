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

namespace Yasumi\tests\Russia;

use Yasumi\Holiday;
use Yasumi\Provider\Russia;

/**
 * Class for testing holidays in Russia.
 *
 * @author Gedas Lukošius <gedas@lukosius.me>
 */
class RussiaTest extends RussiaBaseTestCase
{
    /**
     * Tests if all official holidays in Russia are defined by the provider class
     */
    public function testOfficialHolidays()
    {
        $holidays = [
            'newYearsDay',
            'newYearHolidaysDay2',
            'newYearHolidaysDay3',
            'newYearHolidaysDay4',
            'newYearHolidaysDay5',
            'newYearHolidaysDay6',
            'newYearHolidaysDay8',
            'orthodoxChristmasDay',
            'internationalWomensDay',
            'springAndLabourDay',
            'victoryDay',
        ];

        $year = $this->generateRandomYear();

        if ($year >= Russia::DEFENCE_OF_THE_FATHERLAND_START_YEAR) {
            $holidays[] = 'defenceOfTheFatherlandDay';
        }

        if ($year >= Russia::RUSSIA_DAY_START_YEAR) {
            $holidays[] = 'russiaDay';
        }

        if ($year >= Russia::UNITY_DAY_START_YEAR) {
            $holidays[] = 'unityDay';
        }

        $this->assertDefinedHolidays($holidays, self::REGION, $year, Holiday::TYPE_OFFICIAL);
    }

    /**
     * Tests if all observed holidays in Russia are defined by the provider class
     */
    public function testObservedHolidays()
    {
        $this->assertDefinedHolidays([], self::REGION, $this->generateRandomYear(), Holiday::TYPE_OBSERVANCE);
    }

    /**
     * Tests if all seasonal holidays in Russia are defined by the provider class
     */
    public function testSeasonalHolidays()
    {
        $this->assertDefinedHolidays([], self::REGION, $this->generateRandomYear(), Holiday::TYPE_SEASON);
    }

    /**
     * Tests if all bank holidays in Russia are defined by the provider class
     */
    public function testBankHolidays()
    {
        $this->assertDefinedHolidays([], self::REGION, $this->generateRandomYear(), Holiday::TYPE_BANK);
    }

    /**
     * Tests if all other holidays in Russia are defined by the provider class
     */
    public function testOtherHolidays()
    {
        $this->assertDefinedHolidays([], self::REGION, $this->generateRandomYear(), Holiday::TYPE_OTHER);
    }
}
