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

namespace Yasumi\tests\Ukraine;

use ReflectionException;
use Yasumi\Holiday;

/**
 * Class UkraineTest
 * @package Yasumi\tests\Ukraine
 */
class UkraineTest extends UkraineBaseTestCase
{
    /**
     * @var int year random year number used for all tests in this Test Case
     */
    protected $year;

    /**
     * Tests if all official holidays in Ukraine are defined by the provider class
     * @throws ReflectionException
     */
    public function testOfficialHolidays(): void
    {
        $holidays = [
            'newYearsDay',
            'internationalWorkersDay',
            'christmasDay',
            'easter',
            'pentecost',
            'internationalWomensDay',
            'victoryDay',
        ];

        if ($this->year >= 1996) {
            $holidays[] = 'constitutionDay';
        }

        if ($this->year >= 1991) {
            $holidays[] = 'independenceDay';
        }

        if ($this->year >= 2015) {
            $holidays[] = 'defenderOfUkraineDay';
        }

        if ($this->year < 2018) {
            $holidays[] = 'secondInternationalWorkersDay';
        }

        if ($this->year >= 2017) {
            $holidays[] = 'catholicChristmasDay';
        }

        $this->assertDefinedHolidays(
            $holidays,
            self::REGION,
            $this->year,
            Holiday::TYPE_OFFICIAL
        );
    }

    /**
     * Tests if all observed holidays in Ukraine are defined by the provider class
     * @throws ReflectionException
     */
    public function testObservedHolidays(): void
    {
        $this->assertDefinedHolidays([], self::REGION, $this->year, Holiday::TYPE_OBSERVANCE);
    }

    /**
     * Tests if all seasonal holidays in Ukraine are defined by the provider class
     * @throws ReflectionException
     */
    public function testSeasonalHolidays(): void
    {
        $this->assertDefinedHolidays([], self::REGION, $this->year, Holiday::TYPE_SEASON);
    }

    /**
     * Tests if all bank holidays in Ukraine are defined by the provider class
     * @throws ReflectionException
     */
    public function testBankHolidays(): void
    {
        $this->assertDefinedHolidays([], self::REGION, $this->year, Holiday::TYPE_BANK);
    }

    /**
     * Tests if all other holidays in Ukraine are defined by the provider class
     * @throws ReflectionException
     */
    public function testOtherHolidays(): void
    {
        $this->assertDefinedHolidays([], self::REGION, $this->year, Holiday::TYPE_OTHER);
    }

    /**
     * Initial setup of this Test Case
     */
    protected function setUp(): void
    {
        $this->year = $this->generateRandomYear();
    }
}
