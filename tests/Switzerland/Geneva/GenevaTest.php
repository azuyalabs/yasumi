<?php
/**
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 - 2017 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <stelgenhof@gmail.com>
 */

namespace Yasumi\tests\Switzerland\Geneva;

use Yasumi\Holiday;

/**
 * Class for testing holidays in Geneva (Switzerland).
 */
class GenevaTest extends GenevaBaseTestCase
{
    /**
     * @var int year random year number used for all tests in this Test Case
     */
    protected $year;

    /**
     * Tests if all official holidays in Geneva (Switzerland) are defined by the provider class
     */
    public function testOfficialHolidays()
    {
        $officialHolidays = [];
        if ($this->year >= 1994) {
            $officialHolidays[] = 'swissNationalDay';
        }
        $this->assertDefinedHolidays($officialHolidays, self::REGION, $this->year, Holiday::TYPE_OFFICIAL);
    }

    /**
     * Tests if all regional holidays in Geneva (Switzerland) are defined by the provider class
     */
    public function testRegionalHolidays()
    {
        $regionalHolidays = [
            'goodFriday',
            'newYearsDay',
            'christmasDay',
            'ascensionDay',
            'easterMonday',
            'pentecostMonday',

        ];

        if (($this->year >= 1840 && $this->year <= 1869) || $this->year >= 1966) {
            $regionalHolidays[] = 'jeuneGenevois';
        } elseif ($this->year > 1869 && $this->year < 1966) {
            $regionalHolidays[] = 'jeuneGenevois';
        }

        if ($this->year > 1813) {
            $regionalHolidays[] = 'restaurationGenevoise';
        }

        $this->assertDefinedHolidays($regionalHolidays, self::REGION, $this->year, Holiday::TYPE_OTHER);
    }

    /**
     * Tests if all observed holidays in Geneva (Switzerland) are defined by the provider class
     */
    public function testObservedHolidays()
    {
        $observedHolidays = [];
        if (($this->year >= 1899 && $this->year < 1994) || $this->year = 1891) {
            $observedHolidays[] = 'swissNationalDay';
        }

        $this->assertDefinedHolidays($observedHolidays, self::REGION, $this->year, Holiday::TYPE_OBSERVANCE);
    }

    /**
     * Tests if all seasonal holidays in Geneva (Switzerland) are defined by the provider class
     */
    public function testSeasonalHolidays()
    {
        $this->assertDefinedHolidays([], self::REGION, $this->year, Holiday::TYPE_SEASON);
    }

    /**
     * Tests if all bank holidays in Geneva (Switzerland) are defined by the provider class
     */
    public function testBankHolidays()
    {
        $this->assertDefinedHolidays([], self::REGION, $this->year, Holiday::TYPE_BANK);
    }

    /**
     * Tests if all other holidays in Geneva (Switzerland) are defined by the provider class
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
        $this->year = $this->generateRandomYear(1945);
    }
}
