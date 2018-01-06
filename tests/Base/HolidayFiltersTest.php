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

namespace Yasumi\tests\Base;

use PHPUnit_Framework_TestCase;
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
class HolidayFiltersTest extends PHPUnit_Framework_TestCase
{
    use YasumiBase;

    /**
     * Tests Official Holidays
     */
    public function testOfficialHolidaysFilter()
    {
        $holidays = Yasumi::create('Netherlands', 2017);

        $filteredHolidays      = new OfficialHolidaysFilter($holidays->getIterator());
        $filteredHolidaysArray = iterator_to_array($filteredHolidays);

        // Assert array definitions
        $this->assertArrayHasKey('newYearsDay', $filteredHolidaysArray);
        $this->assertArrayHasKey('easter', $filteredHolidaysArray);
        $this->assertArrayHasKey('easterMonday', $filteredHolidaysArray);
        $this->assertArrayHasKey('kingsDay', $filteredHolidaysArray);
        $this->assertArrayHasKey('ascensionDay', $filteredHolidaysArray);
        $this->assertArrayHasKey('pentecost', $filteredHolidaysArray);
        $this->assertArrayHasKey('pentecostMonday', $filteredHolidaysArray);
        $this->assertArrayHasKey('christmasDay', $filteredHolidaysArray);
        $this->assertArrayHasKey('secondChristmasDay', $filteredHolidaysArray);
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
        $this->assertArrayNotHasKey('summerTime', $filteredHolidaysArray);
        $this->assertArrayNotHasKey('winterTime', $filteredHolidaysArray);

        // Assert number of results returned
        $this->assertCount(9, $filteredHolidays);
        $this->assertNotCount(count($holidays), $filteredHolidays);
        $this->assertEquals(9, $filteredHolidays->count());
        $this->assertNotEquals(count($holidays), $filteredHolidays->count());
    }

    /**
     * Tests Observed Holidays
     */
    public function testObservedHolidaysFilter()
    {
        $holidays = Yasumi::create('Netherlands', 2017);

        $filteredHolidays      = new ObservedHolidaysFilter($holidays->getIterator());
        $filteredHolidaysArray = iterator_to_array($filteredHolidays);

        // Assert array definitions
        $this->assertArrayHasKey('stMartinsDay', $filteredHolidaysArray);
        $this->assertArrayHasKey('goodFriday', $filteredHolidaysArray);
        $this->assertArrayHasKey('ashWednesday', $filteredHolidaysArray);
        $this->assertArrayHasKey('commemorationDay', $filteredHolidaysArray);
        $this->assertArrayHasKey('liberationDay', $filteredHolidaysArray);
        $this->assertArrayHasKey('halloween', $filteredHolidaysArray);
        $this->assertArrayHasKey('stNicholasDay', $filteredHolidaysArray);
        $this->assertArrayHasKey('carnivalDay', $filteredHolidaysArray);
        $this->assertArrayHasKey('secondCarnivalDay', $filteredHolidaysArray);
        $this->assertArrayHasKey('thirdCarnivalDay', $filteredHolidaysArray);
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
        $this->assertArrayNotHasKey('internationalWorkersDay', $filteredHolidaysArray);
        $this->assertArrayNotHasKey('valentinesDay', $filteredHolidaysArray);
        $this->assertArrayNotHasKey('worldAnimalDay', $filteredHolidaysArray);
        $this->assertArrayNotHasKey('fathersDay', $filteredHolidaysArray);
        $this->assertArrayNotHasKey('mothersDay', $filteredHolidaysArray);
        $this->assertArrayNotHasKey('epiphany', $filteredHolidaysArray);
        $this->assertArrayNotHasKey('princesDay', $filteredHolidaysArray);

        // Assert number of results returned
        $this->assertCount(10, $filteredHolidays);
        $this->assertNotCount(count($holidays), $filteredHolidays);
        $this->assertEquals(10, $filteredHolidays->count());
        $this->assertNotEquals(count($holidays), $filteredHolidays->count());
    }

    /**
     * Tests Bank Holidays
     */
    public function testBankHolidaysFilter()
    {
        $holidays = Yasumi::create('Netherlands', 2017);

        $filteredHolidays      = new BankHolidaysFilter($holidays->getIterator());
        $filteredHolidaysArray = iterator_to_array($filteredHolidays);

        // Assert array definitions
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
        $this->assertArrayNotHasKey('internationalWorkersDay', $filteredHolidaysArray);
        $this->assertArrayNotHasKey('valentinesDay', $filteredHolidaysArray);
        $this->assertArrayNotHasKey('worldAnimalDay', $filteredHolidaysArray);
        $this->assertArrayNotHasKey('fathersDay', $filteredHolidaysArray);
        $this->assertArrayNotHasKey('mothersDay', $filteredHolidaysArray);
        $this->assertArrayNotHasKey('epiphany', $filteredHolidaysArray);
        $this->assertArrayNotHasKey('princesDay', $filteredHolidaysArray);

        // Assert number of results returned
        $this->assertCount(0, $filteredHolidays);
        $this->assertNotCount(count($holidays), $filteredHolidays);
        $this->assertEquals(0, $filteredHolidays->count());
        $this->assertNotEquals(count($holidays), $filteredHolidays->count());
    }

    /**
     * Tests Seasonal Holidays
     */
    public function testSeasonalHolidaysFilter()
    {
        $holidays = Yasumi::create('Netherlands', 2017);

        $filteredHolidays      = new SeasonalHolidaysFilter($holidays->getIterator());
        $filteredHolidaysArray = iterator_to_array($filteredHolidays);

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
        $this->assertNotCount(count($holidays), $filteredHolidays);
        $this->assertEquals(2, $filteredHolidays->count());
        $this->assertNotEquals(count($holidays), $filteredHolidays->count());
    }

    /**
     * Tests other type of Holidays
     */
    public function testOtherHolidaysFilter()
    {
        $holidays = Yasumi::create('Netherlands', 2017);

        $filteredHolidays      = new OtherHolidaysFilter($holidays->getIterator());
        $filteredHolidaysArray = iterator_to_array($filteredHolidays);

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
        $this->assertNotCount(count($holidays), $filteredHolidays);
        $this->assertEquals(7, $filteredHolidays->count());
        $this->assertNotEquals(count($holidays), $filteredHolidays->count());
    }
}
