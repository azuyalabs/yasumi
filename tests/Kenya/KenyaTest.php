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

namespace Yasumi\tests\Kenya;

use Yasumi\Holiday;
use Yasumi\Provider\Kenya;
use Yasumi\tests\ProviderTestCase;

/**
 * Class for testing holidays in Kenya.
 */
class KenyaTest extends KenyaBaseTestCase implements ProviderTestCase
{
    /** @var int year random year number used for all tests in this Test Case */
    protected int $year;

    /**
     * Initial setup of this Test Case.
     *
     * @throws \Exception
     */
    protected function setUp(): void
    {
        $this->year = static::generateRandomYear(Kenya::ESTABLISHMENT_YEAR);
    }

    /**
     * Tests if all official holidays in Kenya are defined by the provider class.
     */
    public function testOfficialHolidays(): void
    {
        $holidays = [
            'newYearsDay',
            'goodFriday',
            'easterMonday',
            'internationalWorkersDay',
            'madarakaDay',
            'jamhuriDay',
            'christmasDay',
            'secondChristmasDay',
        ];

        $holidays[] = $this->year <= 2009 ? 'kenyattaDay' : 'mashujaaDay';

        if (($this->year >= 1989 && $this->year <= 2009) || 2018 === $this->year || 2019 === $this->year) {
            $holidays[] = 'moiDay';
        } elseif ($this->year >= 2020 && $this->year <= 2023) {
            $holidays[] = 'utamaduniDay';
        } elseif ($this->year >= 2024) {
            $holidays[] = 'mazingiraDay';
        }

        $this->assertDefinedHolidays($holidays, self::REGION, $this->year, Holiday::TYPE_OFFICIAL);
    }

    /**
     * Tests if all observed holidays in Kenya are defined by the provider class.
     */
    public function testObservedHolidays(): void
    {
        $this->assertDefinedHolidays([], self::REGION, $this->year, Holiday::TYPE_OBSERVANCE);
    }

    /**
     * Tests if all seasonal holidays in Kenya are defined by the provider class.
     */
    public function testSeasonalHolidays(): void
    {
        $this->assertDefinedHolidays([], self::REGION, $this->year, Holiday::TYPE_SEASON);
    }

    /**
     * Tests if all bank holidays in Kenya are defined by the provider class.
     */
    public function testBankHolidays(): void
    {
        $this->assertDefinedHolidays([], self::REGION, $this->year, Holiday::TYPE_BANK);
    }

    /**
     * Tests if all other holidays in Kenya are defined by the provider class.
     */
    public function testOtherHolidays(): void
    {
        $this->assertDefinedHolidays([], self::REGION, $this->year, Holiday::TYPE_OTHER);
    }

    /** @throws \Exception */
    public function testSources(): void
    {
        $this->assertSources(self::REGION, 2);
    }
}
