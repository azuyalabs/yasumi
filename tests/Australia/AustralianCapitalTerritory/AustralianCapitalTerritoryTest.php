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

namespace Yasumi\tests\Australia\AustralianCapitalTerritory;

use Yasumi\Holiday;
use Yasumi\tests\ProviderTestCase;

/**
 * Class for testing holidays in Australian Capital Territory (Australia).
 */
class AustralianCapitalTerritoryTest extends AustralianCapitalTerritoryBaseTestCase implements ProviderTestCase
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
        $this->year = $this->generateRandomYear(2018, 2100);
    }

    /**
     * Tests if all official holidays in Australian Capital Territory (Australia) are defined by the provider class.
     */
    public function testOfficialHolidays(): void
    {
        $expectedHolidays = [
            'newYearsDay',
            'goodFriday',
            'easterMonday',
            'christmasDay',
            'secondChristmasDay',
            'australiaDay',
            'anzacDay',
            'easter',
            'easterSaturday',
            'queensBirthday',
            'labourDay',
            'canberraDay',
            'reconciliationDay',
        ];

        if (2022 == $this->year) {
            $expectedHolidays[] = 'nationalDayOfMourning';
        }

        $this->assertDefinedHolidays($expectedHolidays, $this->region, $this->year, Holiday::TYPE_OFFICIAL);
    }

    /**
     * @throws \ReflectionException
     * @throws \Exception
     */
    public function testSources(): void
    {
        $this->assertSources($this->region, 1);
    }
}
