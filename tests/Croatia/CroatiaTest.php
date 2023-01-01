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

namespace Yasumi\tests\Croatia;

use Yasumi\Holiday;
use Yasumi\tests\ProviderTestCase;

/**
 * Class for testing holidays in Croatia.
 */
class CroatiaTest extends CroatiaBaseTestCase implements ProviderTestCase
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
        $this->year = $this->generateRandomYear(1941);
    }

    /**
     * Tests if all official holidays in Croatia are defined by the provider class.
     */
    public function testOfficialHolidays(): void
    {
        $holidays = [
            'newYearsDay',
            'internationalWorkersDay',
            'epiphany',
            'easter',
            'easterMonday',
            'corpusChristi',
            'assumptionOfMary',
            'allSaintsDay',
            'christmasDay',
            'stStephensDay',
        ];

        if ($this->year >= 1941) {
            $holidays[] = 'antifascistStruggleDay';
        }

        if ($this->year >= 1991) {
            $holidays[] = 'statehoodDay';
        }

        if ($this->year >= 1995) {
            $holidays[] = 'homelandThanksgiving';
        }

        if ($this->year >= 1991 && $this->year < 2020) {
            $holidays[] = 'independenceDay';
        }

        if ($this->year >= 2020) {
            $holidays[] = 'remembranceDay';
        }

        $this->assertDefinedHolidays($holidays, self::REGION, $this->year, Holiday::TYPE_OFFICIAL);
    }

    /**
     * Tests if all observed holidays in Croatia are defined by the provider class.
     */
    public function testObservedHolidays(): void
    {
        $this->assertDefinedHolidays([], self::REGION, $this->year, Holiday::TYPE_OBSERVANCE);
    }

    /**
     * Tests if all seasonal holidays in Croatia are defined by the provider class.
     */
    public function testSeasonalHolidays(): void
    {
        $this->assertDefinedHolidays([], self::REGION, $this->year, Holiday::TYPE_SEASON);
    }

    /**
     * Tests if all bank holidays in Croatia are defined by the provider class.
     */
    public function testBankHolidays(): void
    {
        $this->assertDefinedHolidays([], self::REGION, $this->year, Holiday::TYPE_BANK);
    }

    /**
     * Tests if all other holidays in Croatia are defined by the provider class.
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
