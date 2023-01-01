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

namespace Yasumi\tests\Australia;

use Yasumi\Holiday;
use Yasumi\tests\ProviderTestCase;

/**
 * Class for testing holidays in Australia.
 */
class AustraliaTest extends AustraliaBaseTestCase implements ProviderTestCase
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
        $this->year = $this->generateRandomYear(1987);
    }

    /**
     * Tests if all official holidays in Australia are defined by the provider class.
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
        ];

        if (2022 == $this->year) {
            $expectedHolidays[] = 'nationalDayOfMourning';
        }

        $this->assertDefinedHolidays($expectedHolidays, $this->region, $this->year, Holiday::TYPE_OFFICIAL);
    }

    /**
     * Tests if all observed holidays in Australia are defined by the provider class.
     */
    public function testObservedHolidays(): void
    {
        $this->assertDefinedHolidays([], $this->region, $this->year, Holiday::TYPE_OBSERVANCE);
    }

    /**
     * Tests if all seasonal holidays in Australia are defined by the provider class.
     */
    public function testSeasonalHolidays(): void
    {
        $this->assertDefinedHolidays([], $this->region, $this->year, Holiday::TYPE_SEASON);
    }

    /**
     * Tests if all bank holidays in Australia are defined by the provider class.
     */
    public function testBankHolidays(): void
    {
        $this->assertDefinedHolidays([], $this->region, $this->year, Holiday::TYPE_BANK);
    }

    /**
     * Tests if all other holidays in Australia are defined by the provider class.
     */
    public function testOtherHolidays(): void
    {
        $this->assertDefinedHolidays([], $this->region, $this->year, Holiday::TYPE_OTHER);
    }

    /**
     * @throws \ReflectionException
     * @throws \Exception
     */
    public function testSources(): void
    {
        $this->assertSources($this->region, 1); // TODO: Investigate why not a constant is used for region.
    }
}
