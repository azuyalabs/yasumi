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

namespace Yasumi\tests\France;

use Yasumi\Holiday;
use Yasumi\Provider\France;
use Yasumi\tests\ProviderTestCase;

/**
 * Class for testing holidays in France.
 */
class FranceTest extends FranceBaseTestCase implements ProviderTestCase
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
        $this->year = $this->generateRandomYear(1945);
    }

    /**
     * Tests if all official holidays in France are defined by the provider class.
     */
    public function testOfficialHolidays(): void
    {
        $holidays =
            [
                'newYearsDay',
                'victoryInEuropeDay',
                'easterMonday',
                'internationalWorkersDay',
                'ascensionDay',
                'assumptionOfMary',
                'allSaintsDay',
                'armisticeDay',
                'christmasDay',
                'bastilleDay',
            ];

        if ($this->year < France::EST_YEAR_DAY_OF_SOLIDARITY_WITH_ELDERLY) {
            $holidays[] = 'pentecostMonday';
        }

        $this->assertDefinedHolidays($holidays, self::REGION, $this->year, Holiday::TYPE_OFFICIAL);
    }

    /**
     * Tests if all observed holidays in France are defined by the provider class.
     */
    public function testObservedHolidays(): void
    {
        $holidays = [];

        if ($this->year >= France::EST_YEAR_DAY_OF_SOLIDARITY_WITH_ELDERLY) {
            $holidays[] = 'pentecostMonday';
        }

        $this->assertDefinedHolidays($holidays, self::REGION, $this->year, Holiday::TYPE_OBSERVANCE);
    }

    /**
     * Tests if all seasonal holidays in France are defined by the provider class.
     */
    public function testSeasonalHolidays(): void
    {
        $this->assertDefinedHolidays([], self::REGION, $this->year, Holiday::TYPE_SEASON);
    }

    /**
     * Tests if all bank holidays in France are defined by the provider class.
     */
    public function testBankHolidays(): void
    {
        $this->assertDefinedHolidays([], self::REGION, $this->year, Holiday::TYPE_BANK);
    }

    /**
     * Tests if all other holidays in France are defined by the provider class.
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
