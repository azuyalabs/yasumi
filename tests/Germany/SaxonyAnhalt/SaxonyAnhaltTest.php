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

namespace Yasumi\tests\Germany\SaxonyAnhalt;

use Yasumi\Holiday;

/**
 * Class for testing holidays in Saxony-Anhalt (Germany)
 */
class SaxonyAnhaltTest extends SaxonyAnhaltBaseTestCase
{
    /**
     * @var int year random year number used for all tests in this Test Case
     */
    protected $year;

    /**
     * Tests if all national holidays in Saxony-Anhalt (Germany) are defined by the provider class
     */
    public function testNationalHolidays()
    {
        $holidays = [
            'newYearsDay',
            'epiphany',
            'goodFriday',
            'easter',
            'easterMonday',
            'internationalWorkersDay',
            'ascensionDay',
            'pentecost',
            'pentecostMonday',
            'christmasDay',
            'secondChristmasDay'
        ];

        if ($this->year >= 1990) {
            $holidays[] = 'germanUnityDay';
        }

        if ($this->year >= 1517) {
            $holidays[] = 'reformationDay';
        }

        $this->assertDefinedHolidays($holidays, self::REGION, $this->year, Holiday::TYPE_NATIONAL);
    }

    /**
     * Tests if all observed holidays in Saxony-Anhalt (Germany) are defined by the provider class
     */
    public function testObservedHolidays()
    {
        $this->assertDefinedHolidays([], self::REGION, $this->year, Holiday::TYPE_OBSERVANCE);
    }

    /**
     * Tests if all seasonal holidays in Saxony-Anhalt (Germany) are defined by the provider class
     */
    public function testSeasonalHolidays()
    {
        $this->assertDefinedHolidays([], self::REGION, $this->year, Holiday::TYPE_SEASON);
    }

    /**
     * Tests if all bank holidays in Saxony-Anhalt (Germany) are defined by the provider class
     */
    public function testBankHolidays()
    {
        $this->assertDefinedHolidays([], self::REGION, $this->year, Holiday::TYPE_BANK);
    }

    /**
     * Tests if all other holidays in Saxony-Anhalt (Germany) are defined by the provider class
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
        $this->year = $this->generateRandomYear();
    }
}
