<?php declare(strict_types=1);

/**
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 - 2020 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <me@sachatelgenhof.com>
 */

namespace Yasumi\tests\Estonia;

use ReflectionException;
use Yasumi\Holiday;
use Yasumi\Provider\Estonia;

/**
 * Class for testing holidays in Estonia.
 *
 * @author Gedas Lukošius <gedas@lukosius.me>
 */
class EstoniaTest extends EstoniaBaseTestCase
{
    /**
     * Tests if all official holidays in Estonia are defined by the provider class
     * @throws ReflectionException
     */
    public function testOfficialHolidays(): void
    {
        $holidays = [
            'christmasDay',
            'christmasEve',
            'easter',
            'goodFriday',
            'internationalWorkersDay',
            'newYearsDay',
            'pentecost',
            'secondChristmasDay',
            'stJohnsDay',
        ];

        $year = $this->generateRandomYear();

        if ($year >= Estonia::DECLARATION_OF_INDEPENDENCE_YEAR) {
            $holidays[] = 'independenceDay';
        }

        if ($year >= Estonia::VICTORY_DAY_START_YEAR) {
            $holidays[] = 'victoryDay';
        }

        if ($year >= Estonia::RESTORATION_OF_INDEPENDENCE_YEAR) {
            $holidays[] = 'restorationOfIndependenceDay';
        }

        $this->assertDefinedHolidays($holidays, self::REGION, $year, Holiday::TYPE_OFFICIAL);
    }

    /**
     * Tests if all observed holidays in Estonia are defined by the provider class
     * @throws ReflectionException
     */
    public function testObservedHolidays(): void
    {
        $this->assertDefinedHolidays([], self::REGION, $this->generateRandomYear(), Holiday::TYPE_OBSERVANCE);
    }

    /**
     * Tests if all seasonal holidays in Estonia are defined by the provider class
     * @throws ReflectionException
     */
    public function testSeasonalHolidays(): void
    {
        $this->assertDefinedHolidays([], self::REGION, $this->generateRandomYear(), Holiday::TYPE_SEASON);
    }

    /**
     * Tests if all bank holidays in Estonia are defined by the provider class
     * @throws ReflectionException
     */
    public function testBankHolidays(): void
    {
        $this->assertDefinedHolidays([], self::REGION, $this->generateRandomYear(), Holiday::TYPE_BANK);
    }

    /**
     * Tests if all other holidays in Estonia are defined by the provider class
     * @throws ReflectionException
     */
    public function testOtherHolidays(): void
    {
        $this->assertDefinedHolidays([], self::REGION, $this->generateRandomYear(), Holiday::TYPE_OTHER);
    }
}
