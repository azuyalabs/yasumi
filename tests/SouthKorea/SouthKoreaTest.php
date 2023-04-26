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

namespace Yasumi\tests\SouthKorea;

use Yasumi\Holiday;
use Yasumi\Provider\SouthKorea;
use Yasumi\tests\ProviderTestCase;

/**
 * Class for testing holidays in South Korea.
 */
class SouthKoreaTest extends SouthKoreaBaseTestCase implements ProviderTestCase
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
        $this->year = $this->generateRandomYear(1949, 2050);
    }

    /**
     * Tests if all official holidays in South Korea are defined by the provider class.
     */
    public function testOfficialHolidays(): void
    {
        $officialHolidays = [];
        if ($this->year >= 1949) {
            $officialHolidays[] = 'independenceMovementDay';
            $officialHolidays[] = 'liberationDay';
            $officialHolidays[] = 'nationalFoundationDay';
            $officialHolidays[] = 'christmasDay';
            if (ArborDayTest::YEAR_NOT_CELEBRATED !== $this->year && $this->year < ArborDayTest::REMOVED_YEAR + 1) {
                $officialHolidays[] = 'arborDay';
            }
            if ($this->year <= 1990 || $this->year > 2012) {
                $officialHolidays[] = 'hangulDay';
            }
            if ($this->year < 2008) {
                $officialHolidays[] = 'constitutionDay';
            }
        }
        if ($this->year >= 1950) {
            $officialHolidays[] = 'newYearsDay';
            if ($this->year <= 1990) {
                $officialHolidays[] = 'twoDaysLaterNewYearsDay';
            }
            if ($this->year <= 1998) {
                $officialHolidays[] = 'dayAfterNewYearsDay';
            }
        }
        if ($this->year >= 1956 && $this->year <= 1990) {
            $officialHolidays[] = 'armedForcesDay';
        }
        if ($this->year >= 1966) {
            $officialHolidays[] = 'memorialDay';
        }

        // specific cases (Seollal, Buddha's Birthday and Chuseok)
        if ($this->year >= 1949 && isset(SouthKorea::LUNAR_HOLIDAY['chuseok'][$this->year])) {
            $officialHolidays[] = 'chuseok';
            if ($this->year >= 1986) {
                $officialHolidays[] = 'dayAfterChuseok';
            }
            if ($this->year >= 1989) {
                $officialHolidays[] = 'dayBeforeChuseok';
            }
        }
        if ($this->year >= 1975 && isset(SouthKorea::LUNAR_HOLIDAY['buddhasBirthday'][$this->year])) {
            $officialHolidays[] = 'buddhasBirthday';
        }
        if ($this->year >= 1985 && isset(SouthKorea::LUNAR_HOLIDAY['seollal'][$this->year])) {
            $officialHolidays[] = 'seollal';
            if ($this->year > 1989) {
                $officialHolidays[] = 'dayBeforeSeollal';
                $officialHolidays[] = 'dayAfterSeollal';
            }
        }

        $this->assertDefinedHolidays($officialHolidays, self::REGION, $this->year, Holiday::TYPE_OFFICIAL);
    }

    /**
     * Tests if all observed holidays in South Korea are defined by the provider class.
     */
    public function testObservedHolidays(): void
    {
        $this->assertDefinedHolidays([], self::REGION, $this->year, Holiday::TYPE_OBSERVANCE);
    }

    /**
     * Tests if all seasonal holidays in South Korea are defined by the provider class.
     */
    public function testSeasonalHolidays(): void
    {
        $this->assertDefinedHolidays([], self::REGION, $this->year, Holiday::TYPE_SEASON);
    }

    /**
     * Tests if all bank holidays in South Korea are defined by the provider class.
     */
    public function testBankHolidays(): void
    {
        $this->assertDefinedHolidays([], self::REGION, $this->year, Holiday::TYPE_BANK);
    }

    /**
     * Tests if all other holidays in South Korea are defined by the provider class.
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
        $this->assertSources(self::REGION, 3);
    }
}
