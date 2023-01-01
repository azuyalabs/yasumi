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

namespace Yasumi\tests\Denmark;

use Yasumi\Holiday;
use Yasumi\tests\ProviderTestCase;

/**
 * Class for testing holidays in Denmark.
 */
class DenmarkTest extends DenmarkBaseTestCase implements ProviderTestCase
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
        $this->year = $this->generateRandomYear(1849);
    }

    /**
     * Tests if all official holidays in Denmark are defined by the provider class.
     */
    public function testOfficialHolidays(): void
    {
        $this->assertDefinedHolidays([
            'newYearsDay',
            'maundyThursday',
            'goodFriday',
            'easter',
            'easterMonday',
            'greatPrayerDay',
            'ascensionDay',
            'pentecost',
            'pentecostMonday',
            'christmasDay',
            'secondChristmasDay',
        ], self::REGION, $this->year, Holiday::TYPE_OFFICIAL);
    }

    /**
     * Tests if all observed holidays in Denmark are defined by the provider class.
     */
    public function testObservedHolidays(): void
    {
        $this->assertDefinedHolidays([
            'internationalWorkersDay',
            'constitutionDay',
            'christmasEve',
            'newYearsEve',
        ], self::REGION, $this->year, Holiday::TYPE_OBSERVANCE);
    }

    /**
     * Tests if all seasonal holidays in Denmark are defined by the provider class.
     *
     * @throws \Exception
     */
    public function testSeasonalHolidays(): void
    {
        $year = $this->generateRandomYear(1980, 2037);
        $this->assertDefinedHolidays(['summerTime', 'winterTime'], self::REGION, $year, Holiday::TYPE_SEASON);
    }

    /**
     * Tests if all bank holidays in Denmark are defined by the provider class.
     */
    public function testBankHolidays(): void
    {
        $this->assertDefinedHolidays([], self::REGION, $this->year, Holiday::TYPE_BANK);
    }

    /**
     * Tests if all other holidays in Denmark are defined by the provider class.
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
