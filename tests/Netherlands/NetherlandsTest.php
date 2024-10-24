<?php

declare(strict_types = 1);

/**
 * This file is part of the 'Yasumi' package.
 *
 * The easy PHP Library for calculating holidays.
 *
 * Copyright (c) 2015 - 2024 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <me at sachatelgenhof dot com>
 */

namespace Yasumi\tests\Netherlands;

use Yasumi\Holiday;
use Yasumi\tests\ProviderTestCase;

/**
 * Class for testing holidays in Netherlands.
 */
class NetherlandsTest extends NetherlandsBaseTestCase implements ProviderTestCase
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
        $this->year = $this->generateRandomYear(2014);
    }

    /**
     * Tests if all official holidays in Netherlands are defined by the provider class.
     */
    public function testOfficialHolidays(): void
    {
        $this->assertDefinedHolidays([
            'newYearsDay',
            'easter',
            'easterMonday',
            'kingsDay',
            'ascensionDay',
            'pentecost',
            'pentecostMonday',
            'christmasDay',
            'secondChristmasDay',
        ], self::REGION, $this->year, Holiday::TYPE_OFFICIAL);

        $this->assertDefinedHolidays(['liberationDay'], self::REGION, 2015, Holiday::TYPE_OFFICIAL);
        $this->assertDefinedHolidays(['liberationDay'], self::REGION, 2020, Holiday::TYPE_OFFICIAL);
    }

    /**
     * Tests if all observed holidays in Netherlands are defined by the provider class.
     */
    public function testObservedHolidays(): void
    {
        $this->assertDefinedHolidays([
            'stMartinsDay',
            'goodFriday',
            'ashWednesday',
            'commemorationDay',
            'halloween',
            'stNicholasDay',
            'carnivalDay',
            'secondCarnivalDay',
            'thirdCarnivalDay',
        ], self::REGION, $this->year, Holiday::TYPE_OBSERVANCE);

        $this->assertDefinedHolidays([
            'liberationDay',
        ], self::REGION, $this->generateRandomYear(2011, 2014), Holiday::TYPE_OBSERVANCE);
    }

    /**
     * Tests if all bank holidays in Netherlands are defined by the provider class.
     */
    public function testBankHolidays(): void
    {
        $this->assertDefinedHolidays([], self::REGION, $this->year, Holiday::TYPE_BANK);
    }

    /**
     * Tests if all other holidays in Netherlands are defined by the provider class.
     */
    public function testOtherHolidays(): void
    {
        $this->assertDefinedHolidays([
            'internationalWorkersDay',
            'valentinesDay',
            'worldAnimalDay',
            'fathersDay',
            'mothersDay',
            'epiphany',
            'princesDay',
        ], self::REGION, $this->year, Holiday::TYPE_OTHER);
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
