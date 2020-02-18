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

namespace Yasumi\tests\Base;

use PHPUnit\Framework\TestCase;
use ReflectionException;
use Yasumi\Filters\BankHolidaysFilter;
use Yasumi\Filters\ObservedHolidaysFilter;
use Yasumi\Filters\OfficialHolidaysFilter;
use Yasumi\Filters\OtherHolidaysFilter;
use Yasumi\Filters\SeasonalHolidaysFilter;
use Yasumi\tests\YasumiBase;
use Yasumi\Yasumi;

/**
 * Class HolidayFiltersTest.
 *
 * Contains tests for testing the filter classes
 */
class HolidayFiltersTest extends TestCase
{
    use YasumiBase;

    /**
     * Tests the Official Holidays filter
     * @throws ReflectionException
     */
    public function testOfficialHolidaysFilter(): void
    {
        // There are 11 official holidays in Ireland in the year 2018, with 1 substituted holiday.
        $holidays = Yasumi::create('Ireland', 2018);

        $filteredHolidays = new OfficialHolidaysFilter($holidays->getIterator());
        $filteredHolidaysArray = \iterator_to_array($filteredHolidays);

        // Assert array definitions
        $this->assertArrayHasKey('newYearsDay', $filteredHolidaysArray);
        $this->assertArrayHasKey('stPatricksDay', $filteredHolidaysArray);
        $this->assertArrayHasKey('easter', $filteredHolidaysArray);
        $this->assertArrayHasKey('easterMonday', $filteredHolidaysArray);
        $this->assertArrayHasKey('mayDay', $filteredHolidaysArray);
        $this->assertArrayHasKey('juneHoliday', $filteredHolidaysArray);
        $this->assertArrayHasKey('augustHoliday', $filteredHolidaysArray);
        $this->assertArrayHasKey('octoberHoliday', $filteredHolidaysArray);
        $this->assertArrayHasKey('christmasDay', $filteredHolidaysArray);
        $this->assertArrayHasKey('stStephensDay', $filteredHolidaysArray);
        $this->assertArrayNotHasKey('pentecost', $filteredHolidaysArray);
        $this->assertArrayNotHasKey('pentecostMonday', $filteredHolidaysArray);
        $this->assertArrayNotHasKey('goodFriday', $filteredHolidaysArray);

        // Assert number of results returned
        $this->assertCount(10, $filteredHolidays);
        $this->assertNotCount(\count($holidays), $filteredHolidays);
        $this->assertEquals(10, $filteredHolidays->count());
        $this->assertNotEquals(\count($holidays), $filteredHolidays->count());
    }

    /**
     * Tests the Observed Holidays filter
     * @throws ReflectionException
     */
    public function testObservedHolidaysFilter(): void
    {
        // There are 2 observed holidays in Ireland in the year 2018.
        $holidays = Yasumi::create('Ireland', 2018);

        $filteredHolidays = new ObservedHolidaysFilter($holidays->getIterator());
        $filteredHolidaysArray = \iterator_to_array($filteredHolidays);

        // Assert array definitions
        $this->assertArrayNotHasKey('newYearsDay', $filteredHolidaysArray);
        $this->assertArrayNotHasKey('stPatricksDay', $filteredHolidaysArray);
        $this->assertArrayNotHasKey('easter', $filteredHolidaysArray);
        $this->assertArrayNotHasKey('easterMonday', $filteredHolidaysArray);
        $this->assertArrayNotHasKey('pentecostMonday', $filteredHolidaysArray);
        $this->assertArrayNotHasKey('mayDay', $filteredHolidaysArray);
        $this->assertArrayNotHasKey('juneHoliday', $filteredHolidaysArray);
        $this->assertArrayNotHasKey('augustHoliday', $filteredHolidaysArray);
        $this->assertArrayNotHasKey('octoberHoliday', $filteredHolidaysArray);
        $this->assertArrayNotHasKey('christmasDay', $filteredHolidaysArray);
        $this->assertArrayNotHasKey('stStephensDay', $filteredHolidaysArray);
        $this->assertArrayHasKey('pentecost', $filteredHolidaysArray);
        $this->assertArrayHasKey('goodFriday', $filteredHolidaysArray);

        // Assert number of results returned
        $this->assertCount(2, $filteredHolidays);
        $this->assertNotCount(\count($holidays), $filteredHolidays);
        $this->assertEquals(2, $filteredHolidays->count());
        $this->assertNotEquals(\count($holidays), $filteredHolidays->count());
    }

    /**
     * Tests Bank Holidays
     * @throws ReflectionException
     */
    public function testBankHolidaysFilter(): void
    {
        // There are no bank holidays in Ireland in the year 2018.
        $holidays = Yasumi::create('Ireland', 2018);

        $filteredHolidays = new BankHolidaysFilter($holidays->getIterator());
        $filteredHolidaysArray = \iterator_to_array($filteredHolidays);

        // Assert array definitions
        $this->assertArrayNotHasKey('newYearsDay', $filteredHolidaysArray);
        $this->assertArrayNotHasKey('stPatricksDay', $filteredHolidaysArray);
        $this->assertArrayNotHasKey('easter', $filteredHolidaysArray);
        $this->assertArrayNotHasKey('easterMonday', $filteredHolidaysArray);
        $this->assertArrayNotHasKey('mayDay', $filteredHolidaysArray);
        $this->assertArrayNotHasKey('juneHoliday', $filteredHolidaysArray);
        $this->assertArrayNotHasKey('augustHoliday', $filteredHolidaysArray);
        $this->assertArrayNotHasKey('octoberHoliday', $filteredHolidaysArray);
        $this->assertArrayNotHasKey('christmasDay', $filteredHolidaysArray);
        $this->assertArrayNotHasKey('stStephensDay', $filteredHolidaysArray);
        $this->assertArrayNotHasKey('pentecost', $filteredHolidaysArray);
        $this->assertArrayNotHasKey('pentecostMonday', $filteredHolidaysArray);
        $this->assertArrayNotHasKey('goodFriday', $filteredHolidaysArray);

        // Assert number of results returned
        $this->assertCount(0, $filteredHolidays);
        $this->assertNotCount(\count($holidays), $filteredHolidays);
        $this->assertEquals(0, $filteredHolidays->count());
        $this->assertNotEquals(\count($holidays), $filteredHolidays->count());
    }

    /**
     * Tests Seasonal Holidays
     * @throws ReflectionException
     */
    public function testSeasonalHolidaysFilter(): void
    {
        $holidays = Yasumi::create('Netherlands', 2017);

        $filteredHolidays = new SeasonalHolidaysFilter($holidays->getIterator());
        $filteredHolidaysArray = \iterator_to_array($filteredHolidays);

        // Assert array definitions
        $this->assertArrayHasKey('summerTime', $filteredHolidaysArray);
        $this->assertArrayHasKey('winterTime', $filteredHolidaysArray);
        $this->assertArrayNotHasKey('newYearsDay', $filteredHolidaysArray);
        $this->assertArrayNotHasKey('easter', $filteredHolidaysArray);
        $this->assertArrayNotHasKey('easterMonday', $filteredHolidaysArray);
        $this->assertArrayNotHasKey('kingsDay', $filteredHolidaysArray);
        $this->assertArrayNotHasKey('ascensionDay', $filteredHolidaysArray);
        $this->assertArrayNotHasKey('pentecost', $filteredHolidaysArray);
        $this->assertArrayNotHasKey('pentecostMonday', $filteredHolidaysArray);
        $this->assertArrayNotHasKey('christmasDay', $filteredHolidaysArray);
        $this->assertArrayNotHasKey('secondChristmasDay', $filteredHolidaysArray);
        $this->assertArrayNotHasKey('stMartinsDay', $filteredHolidaysArray);
        $this->assertArrayNotHasKey('goodFriday', $filteredHolidaysArray);
        $this->assertArrayNotHasKey('ashWednesday', $filteredHolidaysArray);
        $this->assertArrayNotHasKey('commemorationDay', $filteredHolidaysArray);
        $this->assertArrayNotHasKey('liberationDay', $filteredHolidaysArray);
        $this->assertArrayNotHasKey('halloween', $filteredHolidaysArray);
        $this->assertArrayNotHasKey('stNicholasDay', $filteredHolidaysArray);
        $this->assertArrayNotHasKey('carnivalDay', $filteredHolidaysArray);
        $this->assertArrayNotHasKey('secondCarnivalDay', $filteredHolidaysArray);
        $this->assertArrayNotHasKey('thirdCarnivalDay', $filteredHolidaysArray);
        $this->assertArrayNotHasKey('internationalWorkersDay', $filteredHolidaysArray);
        $this->assertArrayNotHasKey('valentinesDay', $filteredHolidaysArray);
        $this->assertArrayNotHasKey('worldAnimalDay', $filteredHolidaysArray);
        $this->assertArrayNotHasKey('fathersDay', $filteredHolidaysArray);
        $this->assertArrayNotHasKey('mothersDay', $filteredHolidaysArray);
        $this->assertArrayNotHasKey('epiphany', $filteredHolidaysArray);
        $this->assertArrayNotHasKey('princesDay', $filteredHolidaysArray);

        // Assert number of results returned
        $this->assertCount(2, $filteredHolidays);
        $this->assertNotCount(\count($holidays), $filteredHolidays);
        $this->assertEquals(2, $filteredHolidays->count());
        $this->assertNotEquals(\count($holidays), $filteredHolidays->count());
    }

    /**
     * Tests other type of Holidays
     * @throws ReflectionException
     */
    public function testOtherHolidaysFilter(): void
    {
        $holidays = Yasumi::create('Netherlands', 2017);

        $filteredHolidays = new OtherHolidaysFilter($holidays->getIterator());
        $filteredHolidaysArray = \iterator_to_array($filteredHolidays);

        // Assert array definitions
        $this->assertArrayHasKey('internationalWorkersDay', $filteredHolidaysArray);
        $this->assertArrayHasKey('valentinesDay', $filteredHolidaysArray);
        $this->assertArrayHasKey('worldAnimalDay', $filteredHolidaysArray);
        $this->assertArrayHasKey('fathersDay', $filteredHolidaysArray);
        $this->assertArrayHasKey('mothersDay', $filteredHolidaysArray);
        $this->assertArrayHasKey('epiphany', $filteredHolidaysArray);
        $this->assertArrayHasKey('princesDay', $filteredHolidaysArray);
        $this->assertArrayNotHasKey('summerTime', $filteredHolidaysArray);
        $this->assertArrayNotHasKey('winterTime', $filteredHolidaysArray);
        $this->assertArrayNotHasKey('newYearsDay', $filteredHolidaysArray);
        $this->assertArrayNotHasKey('easter', $filteredHolidaysArray);
        $this->assertArrayNotHasKey('easterMonday', $filteredHolidaysArray);
        $this->assertArrayNotHasKey('kingsDay', $filteredHolidaysArray);
        $this->assertArrayNotHasKey('ascensionDay', $filteredHolidaysArray);
        $this->assertArrayNotHasKey('pentecost', $filteredHolidaysArray);
        $this->assertArrayNotHasKey('pentecostMonday', $filteredHolidaysArray);
        $this->assertArrayNotHasKey('christmasDay', $filteredHolidaysArray);
        $this->assertArrayNotHasKey('secondChristmasDay', $filteredHolidaysArray);
        $this->assertArrayNotHasKey('stMartinsDay', $filteredHolidaysArray);
        $this->assertArrayNotHasKey('goodFriday', $filteredHolidaysArray);
        $this->assertArrayNotHasKey('ashWednesday', $filteredHolidaysArray);
        $this->assertArrayNotHasKey('commemorationDay', $filteredHolidaysArray);
        $this->assertArrayNotHasKey('liberationDay', $filteredHolidaysArray);
        $this->assertArrayNotHasKey('halloween', $filteredHolidaysArray);
        $this->assertArrayNotHasKey('stNicholasDay', $filteredHolidaysArray);
        $this->assertArrayNotHasKey('carnivalDay', $filteredHolidaysArray);
        $this->assertArrayNotHasKey('secondCarnivalDay', $filteredHolidaysArray);
        $this->assertArrayNotHasKey('thirdCarnivalDay', $filteredHolidaysArray);

        // Assert number of results returned
        $this->assertCount(7, $filteredHolidays);
        $this->assertNotCount(\count($holidays), $filteredHolidays);
        $this->assertEquals(7, $filteredHolidays->count());
        $this->assertNotEquals(\count($holidays), $filteredHolidays->count());
    }
}
