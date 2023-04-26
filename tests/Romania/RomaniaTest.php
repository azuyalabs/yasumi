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

namespace Yasumi\tests\Romania;

use Yasumi\Holiday;
use Yasumi\tests\ProviderTestCase;

/**
 * Class RomaniaTest.
 */
class RomaniaTest extends RomaniaBaseTestCase implements ProviderTestCase
{
    /**
     * @var int year random year number used for all tests in this Test Case
     */
    protected int $year;

    /**
     * Initial setup of this Test Case.
     *
     * @throws \Exception
     */
    protected function setUp(): void
    {
        $this->year = $this->generateRandomYear(2015, 2025);
    }

    /**
     * Tests if all official holidays in Romania are defined by the provider class.
     */
    public function testOfficialHolidays(): void
    {
        $national_holidays = [
            'newYearsDay',
            'dayAfterNewYearsDay',
            'unitedPrincipalitiesDay',
            'internationalWorkersDay',
            'easter',
            'easterMonday',
            'pentecost',
            'pentecostMonday',
            'assumptionOfMary',
            'stAndrewsDay',
            'nationalDay',
            'christmasDay',
            'secondChristmasDay',
        ];

        if ($this->year >= 2017) {
            $national_holidays[] = 'childrensDay';
        }

        $this->assertDefinedHolidays($national_holidays, self::REGION, $this->year, Holiday::TYPE_OFFICIAL);
    }

    /**
     * Tests if all observed holidays in Romania are defined by the provider class.
     */
    public function testObservedHolidays(): void
    {
        $ObservedHolidays = [];

        if ($this->year >= 2016) {
            $ObservedHolidays[] = 'constantinBrancusiDay';
        }

        if ($this->year >= 1950 && $this->year <= 2016) {
            $ObservedHolidays[] = 'childrensDay';
        }

        $this->assertDefinedHolidays($ObservedHolidays, self::REGION, $this->year, Holiday::TYPE_OBSERVANCE);
    }

    /**
     * Tests if all seasonal holidays in Romania are defined by the provider class.
     */
    public function testSeasonalHolidays(): void
    {
        $this->assertDefinedHolidays([], self::REGION, $this->year, Holiday::TYPE_SEASON);
    }

    /**
     * Tests if all bank holidays in Romania are defined by the provider class.
     */
    public function testBankHolidays(): void
    {
        $this->assertDefinedHolidays([], self::REGION, $this->year, Holiday::TYPE_BANK);
    }

    /**
     * Tests if all other holidays in Romania are defined by the provider class.
     */
    public function testOtherHolidays(): void
    {
        $this->assertDefinedHolidays([], self::REGION, $this->year, Holiday::TYPE_OTHER);
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
