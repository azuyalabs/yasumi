<?php

declare(strict_types=1);

/*
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 - 2023 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <me at sachatelgenhof dot com>
 */

namespace Yasumi\tests\Russia;

use Yasumi\Holiday;
use Yasumi\Provider\Russia;
use Yasumi\tests\ProviderTestCase;

/**
 * Class for testing holidays in Russia.
 *
 * @author Gedas Lukošius <gedas@lukosius.me>
 */
class RussiaTest extends RussiaBaseTestCase implements ProviderTestCase
{
    /**
     * Tests if all official holidays in Russia are defined by the provider class.
     *
     * @throws \Exception
     */
    public function testOfficialHolidays(): void
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
     * Tests if all observed holidays in Russia are defined by the provider class.
     *
     * @throws \Exception
     */
    public function testObservedHolidays(): void
    {
        $this->assertDefinedHolidays([], self::REGION, $this->generateRandomYear(), Holiday::TYPE_OBSERVANCE);
    }

    /**
     * Tests if all seasonal holidays in Russia are defined by the provider class.
     *
     * @throws \Exception
     */
    public function testSeasonalHolidays(): void
    {
        $this->assertDefinedHolidays([], self::REGION, $this->generateRandomYear(), Holiday::TYPE_SEASON);
    }

    /**
     * Tests if all bank holidays in Russia are defined by the provider class.
     *
     * @throws \Exception
     */
    public function testBankHolidays(): void
    {
        $this->assertDefinedHolidays([], self::REGION, $this->generateRandomYear(), Holiday::TYPE_BANK);
    }

    /**
     * Tests if all other holidays in Russia are defined by the provider class.
     *
     * @throws \Exception
     */
    public function testOtherHolidays(): void
    {
        $this->assertDefinedHolidays([], self::REGION, $this->generateRandomYear(), Holiday::TYPE_OTHER);
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
