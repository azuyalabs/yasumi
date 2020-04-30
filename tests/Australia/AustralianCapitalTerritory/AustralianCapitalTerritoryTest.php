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

namespace Yasumi\tests\Australia\AustralianCapitalTerritory;

use ReflectionException;
use Yasumi\Holiday;

/**
 * Class for testing holidays in Australian Capital Territory (Australia).
 */
class AustralianCapitalTerritoryTest extends AustralianCapitalTerritoryBaseTestCase
{
    /**
     * @var int year random year number used for all tests in this Test Case
     */
    protected $year;

    /**
     * Tests if all official holidays in Australian Capital Territory (Australia) are defined by the provider class
     * @throws ReflectionException
     */
    public function testOfficialHolidays(): void
    {
        $this->assertDefinedHolidays([
            'newYearsDay',
            'goodFriday',
            'easterMonday',
            'christmasDay',
            'secondChristmasDay',
            'australiaDay',
            'anzacDay',
            'easter',
            'easterSaturday',
            'queensBirthday',
            'labourDay',
            'canberraDay',
            'reconciliationDay',
        ], $this->region, $this->year, Holiday::TYPE_OFFICIAL);
    }

    /**
     * Initial setup of this Test Case
     */
    protected function setUp(): void
    {
        $this->year = $this->generateRandomYear(2018, 2100);
    }
}
