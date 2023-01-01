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

namespace Yasumi\tests\Germany\MecklenburgWesternPomerania;

use Yasumi\Holiday;
use Yasumi\tests\ProviderTestCase;

/**
 * Class for testing holidays in Mecklenburg-Western Pomerania (Germany).
 */
class MecklenburgWesternPomeraniaTest extends MecklenburgWesternPomeraniaBaseTestCase implements ProviderTestCase
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
        $this->year = $this->generateRandomYear();
    }

    /**
     * Tests if all official holidays in Mecklenburg-Western Pomerania (Germany) are defined by the provider class.
     */
    public function testOfficialHolidays(): void
    {
        $holidays = [
            'newYearsDay',
            'goodFriday',
            'easterMonday',
            'internationalWorkersDay',
            'ascensionDay',
            'pentecostMonday',
            'christmasDay',
            'secondChristmasDay',
        ];

        if ($this->year >= 1990) {
            $holidays[] = 'germanUnityDay';
        }

        if ($this->year >= 1517) {
            $holidays[] = 'reformationDay';
        }

        $this->assertDefinedHolidays($holidays, self::REGION, $this->year, Holiday::TYPE_OFFICIAL);
    }

    /**
     * Tests if all observed holidays in Mecklenburg-Western Pomerania (Germany) are defined by the provider class.
     */
    public function testObservedHolidays(): void
    {
        $this->assertDefinedHolidays([], self::REGION, $this->year, Holiday::TYPE_OBSERVANCE);
    }

    /**
     * Tests if all seasonal holidays in Mecklenburg-Western Pomerania (Germany) are defined by the provider class.
     */
    public function testSeasonalHolidays(): void
    {
        $this->assertDefinedHolidays([], self::REGION, $this->year, Holiday::TYPE_SEASON);
    }

    /**
     * Tests if all bank holidays in Mecklenburg-Western Pomerania (Germany) are defined by the provider class.
     */
    public function testBankHolidays(): void
    {
        $this->assertDefinedHolidays([], self::REGION, $this->year, Holiday::TYPE_BANK);
    }

    /**
     * Tests if all other holidays in Mecklenburg-Western Pomerania (Germany) are defined by the provider class.
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
