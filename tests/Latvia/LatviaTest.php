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

namespace Yasumi\tests\Latvia;

use Yasumi\Holiday;
use Yasumi\Provider\Latvia;
use Yasumi\tests\ProviderTestCase;

/**
 * Class for testing holidays in Latvia.
 *
 * @author Gedas Lukošius <gedas@lukosius.me>
 */
class LatviaTest extends LatviaBaseTestCase implements ProviderTestCase
{
    /**
     * Tests if all official holidays in Latvia are defined by the provider class.
     *
     * @throws \Exception
     */
    public function testOfficialHolidays(): void
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
            'newYearsEve',
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
     * Tests if all observed holidays in Latvia are defined by the provider class.
     *
     * @throws \Exception
     */
    public function testObservedHolidays(): void
    {
        $this->assertDefinedHolidays([], self::REGION, $this->generateRandomYear(), Holiday::TYPE_OBSERVANCE);
    }

    /**
     * Tests if all seasonal holidays in Latvia are defined by the provider class.
     *
     * @throws \Exception
     */
    public function testSeasonalHolidays(): void
    {
        $this->assertDefinedHolidays([], self::REGION, $this->generateRandomYear(), Holiday::TYPE_SEASON);
    }

    /**
     * Tests if all bank holidays in Latvia are defined by the provider class.
     *
     * @throws \Exception
     */
    public function testBankHolidays(): void
    {
        $this->assertDefinedHolidays([], self::REGION, $this->generateRandomYear(), Holiday::TYPE_BANK);
    }

    /**
     * Tests if all other holidays in Latvia are defined by the provider class.
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
