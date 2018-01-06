<?php
/**
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 - 2018 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <stelgenhof@gmail.com>
 */

namespace Yasumi\tests\Hungary;

use Yasumi\Holiday;

/**
 * Class for testing holidays in Hungary.
 */
class HungaryTest extends HungaryBaseTestCase
{
    /**
     * @var int year random year number used for all tests in this Test Case
     */
    protected $year;

    /**
     * Tests if all official holidays in Hungary are defined by the provider class
     */
    public function testOfficialHolidays()
    {
        $officialHolidays = [
            'newYearsDay',
            'easter',
            'easterMonday',
            'allSaintsDay',
            'internationalWorkersDay',
            'pentecostMonday',
            'christmasDay',
            'secondChristmasDay',
        ];

        if ($this->year >= 1891) {
            $officialHolidays[] = 'stateFoundation';
        }

        if ($this->year >= 1927) {
            $officialHolidays[] = 'memorialDay1848';
        }

        if ($this->year >= 1991) {
            $officialHolidays[] = 'memorialDay1956';
        }

        if ($this->year >= 2017) {
            $officialHolidays[] = 'goodFriday';
        }

        $this->assertDefinedHolidays($officialHolidays, self::REGION, $this->year, Holiday::TYPE_OFFICIAL);
    }

    /**
     * Tests if all observed holidays in Hungary are defined by the provider class
     */
    public function testObservedHolidays()
    {
        $this->assertDefinedHolidays(['pentecost'], self::REGION, $this->year, Holiday::TYPE_OBSERVANCE);
    }

    /**
     * Tests if all seasonal holidays in Hungary are defined by the provider class
     */
    public function testSeasonalHolidays()
    {
        $this->assertDefinedHolidays([], self::REGION, $this->year, Holiday::TYPE_SEASON);
    }

    /**
     * Tests if all bank holidays in Hungary are defined by the provider class
     */
    public function testBankHolidays()
    {
        $this->assertDefinedHolidays([], self::REGION, $this->year, Holiday::TYPE_BANK);
    }

    /**
     * Tests if all other holidays in Hungary are defined by the provider class
     */
    public function testOtherHolidays()
    {
        $this->assertDefinedHolidays([], self::REGION, $this->year, Holiday::TYPE_OTHER);
    }

    /**
     * Initial setup of this Test Case
     */
    protected function setUp()
    {
        $this->year = $this->generateRandomYear(1955);
    }
}
