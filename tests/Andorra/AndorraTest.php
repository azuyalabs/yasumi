<?php

declare(strict_types = 1);

/**
 * This file is part of the 'Yasumi' package.
 *
 * The easy PHP Library for calculating holidays.
 *
 * Copyright (c) 2015 - 2026 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <me at sachatelgenhof dot com>
 */

namespace Yasumi\tests\Andorra;

use Yasumi\Holiday;
use Yasumi\Provider\Andorra;
use Yasumi\tests\ProviderTestCase;

/**
 * Class for testing holidays in Andorra.
 */
class AndorraTest extends AndorraBaseTestCase implements ProviderTestCase
{
    /**
     * @var int year random year number used for all tests in this Test Case
     */
    protected int $year;

    /**
     * Tests if all official holidays in Andorra are defined by the provider class.
     *
     * @throws \Exception
     */
    public function testOfficialHolidays(): void
    {
        $year = $this->generateRandomYear();

        $holidays = [
            'newYearsDay',
            'epiphany',
            'carnival',
            'goodFriday',
            'easterMonday',
            'internationalWorkersDay',
            'pentecostMonday',
            'assumptionOfMary',
            'meritxellDay',
            'allSaintsDay',
            'immaculateConception',
            'christmasDay',
            'stStephensDay',
        ];

        if ($year >= Andorra::CONSTITUTION_YEAR) {
            $holidays[] = 'constitutionDay';
        }

        $this->assertDefinedHolidays($holidays, self::REGION, $year, Holiday::TYPE_OFFICIAL);
    }

    /**
     * Tests if all observed holidays in Andorra are defined by the provider class.
     *
     * @throws \Exception
     */
    public function testObservedHolidays(): void
    {
        $this->assertDefinedHolidays([], self::REGION, $this->generateRandomYear(), Holiday::TYPE_OBSERVANCE);
    }

    /**
     * Tests if all seasonal holidays in Andorra are defined by the provider class.
     *
     * @throws \Exception
     */
    public function testSeasonalHolidays(): void
    {
        $this->assertDefinedHolidays([], self::REGION, $this->generateRandomYear(), Holiday::TYPE_SEASON);
    }

    /**
     * Tests if all bank holidays in Andorra are defined by the provider class.
     *
     * @throws \Exception
     */
    public function testBankHolidays(): void
    {
        $this->assertDefinedHolidays([], self::REGION, $this->generateRandomYear(), Holiday::TYPE_BANK);
    }

    /**
     * Tests if all other holidays in Andorra are defined by the provider class.
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
