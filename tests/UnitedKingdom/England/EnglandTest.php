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

namespace Yasumi\tests\UnitedKingdom\England;

use Yasumi\Holiday;
use Yasumi\tests\ProviderTestCase;

/**
 * Class for testing holidays in England.
 */
class EnglandTest extends EnglandBaseTestCase implements ProviderTestCase
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
        $this->year = $this->generateRandomYear(1978);
    }

    /**
     * Tests if all official holidays in England are defined by the provider class.
     */
    public function testOfficialHolidays(): void
    {
        $this->assertDefinedHolidays([
            'goodFriday',
            'christmasDay',
        ], self::REGION, $this->year, Holiday::TYPE_OFFICIAL);
    }

    /**
     * Tests if all observed holidays in England are defined by the provider class.
     */
    public function testObservedHolidays(): void
    {
        $this->assertDefinedHolidays([], self::REGION, $this->year, Holiday::TYPE_OBSERVANCE);
    }

    /**
     * Tests if all seasonal holidays in England are defined by the provider class.
     */
    public function testSeasonalHolidays(): void
    {
        $this->assertDefinedHolidays([], self::REGION, $this->year, Holiday::TYPE_SEASON);
    }

    /**
     * Tests if all bank holidays in England are defined by the provider class.
     */
    public function testBankHolidays(): void
    {
        $holidays = [
            'easterMonday',
            'secondChristmasDay',
        ];

        $year = $this->generateRandomYear();

        if (1965 >= $this->year) {
            $holidays[] = 'springBankHoliday';
        }

        if (1974 > $this->year) {
            $holidays[] = 'newYearsDay';
        }

        if (1978 >= $this->year) {
            $holidays[] = 'mayDayBankHoliday';
        }

        if (2022 === $year) {
            $holidays[] = 'queenElizabethFuneralBankHoliday';
        }

        if (2023 === $year) {
            $holidays[] = 'kingCharlesCoronationBankHoliday';
        }

        $this->assertDefinedHolidays($holidays, self::REGION, $year, Holiday::TYPE_BANK);
    }

    /**
     * Tests if all other holidays in England are defined by the provider class.
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
        $this->assertSources(self::REGION, 1);
    }
}
