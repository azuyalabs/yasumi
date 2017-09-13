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

namespace Yasumi\tests\Ireland;

use Yasumi\Holiday;

/**
 * Class for testing holidays in Ireland.
 */
class IrelandTest extends IrelandBaseTestCase
{
    /**
     * @var int year random year number used for all tests in this Test Case
     */
    protected $year;

    /**
     * Tests if all official holidays in Ireland are defined by the provider class
     */
    public function testOfficialHolidays()
    {
        $officialHolidays = ['easter', 'easterMonday', 'augustHoliday', 'christmasDay', 'stStephensDay'];
        if ($this->year >= 1974) {
            $officialHolidays[] = 'newYearsDay';
            $officialHolidays[] = 'juneHoliday';
        }

        if ($this->year >= 1903) {
            $officialHolidays[] = 'stPatricksDay';
        }

        if ($this->year >= 1994) {
            $officialHolidays[] = 'mayDay';
        }

        if ($this->year <= 1973) {
            $officialHolidays[] = 'pentecostMonday';
        }

        if ($this->year >= 1977) {
            $officialHolidays[] = 'octoberHoliday';
        }

        $this->assertDefinedHolidays($officialHolidays, self::REGION, $this->year, Holiday::TYPE_OFFICIAL);
    }

    /**
     * Tests if all observed holidays in Ireland are defined by the provider class
     */
    public function testObservedHolidays()
    {
        $this->assertDefinedHolidays(['goodFriday', 'pentecost'], self::REGION, $this->year, Holiday::TYPE_OBSERVANCE);
    }

    /**
     * Tests if all seasonal holidays in Ireland are defined by the provider class
     */
    public function testSeasonalHolidays()
    {
        $this->assertDefinedHolidays([], self::REGION, $this->year, Holiday::TYPE_SEASON);
    }

    /**
     * Tests if all bank holidays in Ireland are defined by the provider class
     */
    public function testBankHolidays()
    {
        $this->assertDefinedHolidays([], self::REGION, $this->year, Holiday::TYPE_BANK);
    }

    /**
     * Tests if all other holidays in Ireland are defined by the provider class
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
        $this->year = $this->generateRandomYear(1974);
    }
}
