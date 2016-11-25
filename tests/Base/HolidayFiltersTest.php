<?php
/**
 *  This file is part of the Yasumi package.
 *
 *  Copyright (c) 2015 - 2016 AzuyaLabs
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
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
        $holidays         = Yasumi::create('Netherlands', 2015);
        $officialHolidays = iterator_to_array(new OfficialHolidaysFilter($holidays->getIterator()));

        $this->assertArrayHasKey('newYearsDay', $officialHolidays);
        $this->assertArrayHasKey('easter', $officialHolidays);
        $this->assertArrayHasKey('easterMonday', $officialHolidays);
        $this->assertArrayHasKey('kingsDay', $officialHolidays);
        $this->assertArrayHasKey('ascensionDay', $officialHolidays);
        $this->assertArrayHasKey('pentecost', $officialHolidays);
        $this->assertArrayHasKey('pentecostMonday', $officialHolidays);
        $this->assertArrayHasKey('christmasDay', $officialHolidays);
        $this->assertArrayHasKey('secondChristmasDay', $officialHolidays);

        $this->assertCount(9, $officialHolidays);
    }

    /**
     * Tests Official Holidays Filter for holidays that are not official holidays
     */
    public function testOfficialHolidaysFilterNotOfficialHolidays()
    {
        $holidays         = Yasumi::create('Netherlands', 2015);
        $officialHolidays = iterator_to_array(new OfficialHolidaysFilter($holidays->getIterator()));

        $this->assertArrayNotHasKey('goodFriday', $officialHolidays);
        $this->assertArrayNotHasKey('epiphany', $officialHolidays);
    }

    /**
     * Tests Observed Holidays
     */
    public function testObservedHolidaysFilter()
    {
        $holidays         = Yasumi::create('Netherlands', 2015);
        $observedHolidays = iterator_to_array(new ObservedHolidaysFilter($holidays->getIterator()));

        $this->assertArrayHasKey('carnivalDay', $observedHolidays);
        $this->assertArrayHasKey('secondCarnivalDay', $observedHolidays);
        $this->assertArrayHasKey('thirdCarnivalDay', $observedHolidays);
        $this->assertArrayHasKey('ashWednesday', $observedHolidays);
        $this->assertArrayHasKey('goodFriday', $observedHolidays);
        $this->assertArrayHasKey('stMartinsDay', $observedHolidays);
        $this->assertArrayHasKey('halloween', $observedHolidays);
        $this->assertArrayHasKey('stNicholasDay', $observedHolidays);
        $this->assertArrayHasKey('commemorationDay', $observedHolidays);
        $this->assertArrayHasKey('liberationDay', $observedHolidays);

        $this->assertCount(10, $observedHolidays);
    }

    /**
     * Tests Observed Holidays Filter for holidays that are not observed holidays
     */
    public function testObservedHolidaysFilterNotObservedHolidays()
    {
        $holidays         = Yasumi::create('Netherlands', 2015);
        $observedHolidays = iterator_to_array(new ObservedHolidaysFilter($holidays->getIterator()));

        $this->assertArrayNotHasKey('newYearsDay', $observedHolidays);
        $this->assertArrayNotHasKey('internationalWorkersDay', $observedHolidays);
    }

    /**
     * Tests Bank Holidays
     */
    public function testBankHolidaysFilter()
    {
        $holidays     = Yasumi::create('Netherlands', 2015);
        $bankHolidays = iterator_to_array(new BankHolidaysFilter($holidays->getIterator()));

        $this->assertCount(0, $bankHolidays);
    }

    /**
     * Tests Bank Holidays Filter for holidays that are not bank holidays
     */
    public function testBankHolidaysFilterNotBankHolidays()
    {
        $holidays     = Yasumi::create('Netherlands', 2015);
        $bankHolidays = iterator_to_array(new BankHolidaysFilter($holidays->getIterator()));

        $this->assertArrayNotHasKey('newYearsDay', $bankHolidays);
        $this->assertArrayNotHasKey('internationalWorkersDay', $bankHolidays);
    }

    /**
     * Tests Seasonal Holidays
     */
    public function testSeasonalHolidaysFilter()
    {
        $holidays         = Yasumi::create('Netherlands', 2015);
        $seasonalHolidays = iterator_to_array(new SeasonalHolidaysFilter($holidays->getIterator()));

        $this->assertArrayHasKey('summerTime', $seasonalHolidays);
        $this->assertArrayHasKey('winterTime', $seasonalHolidays);

        $this->assertCount(2, $seasonalHolidays);
    }

    /**
     * Tests Seasonal Holidays Filter for holidays that are not seasonal holidays
     */
    public function testSeasonalHolidaysFilterNotSeasonalHolidays()
    {
        $holidays         = Yasumi::create('Netherlands', 2015);
        $seasonalHolidays = iterator_to_array(new SeasonalHolidaysFilter($holidays->getIterator()));

        $this->assertArrayNotHasKey('newYearsDay', $seasonalHolidays);
        $this->assertArrayNotHasKey('internationalWorkersDay', $seasonalHolidays);
    }

    /**
     * Tests other type of Holidays
     */
    public function testOtherHolidaysFilter()
    {
        $holidays      = Yasumi::create('Netherlands', 2015);
        $otherHolidays = iterator_to_array(new OtherHolidaysFilter($holidays->getIterator()));

        $this->assertArrayHasKey('valentinesDay', $otherHolidays);
        $this->assertArrayHasKey('worldAnimalDay', $otherHolidays);
        $this->assertArrayHasKey('fathersDay', $otherHolidays);
        $this->assertArrayHasKey('mothersDay', $otherHolidays);
        $this->assertArrayHasKey('epiphany', $otherHolidays);
        $this->assertArrayHasKey('princesDay', $otherHolidays);
        $this->assertArrayHasKey('internationalWorkersDay', $otherHolidays);

        $this->assertCount(7, $otherHolidays);
    }

    /**
     * Tests other type of Holidays for holidays that are not other type of holidays
     */
    public function testOtherHolidaysFilterNotOtherHolidays()
    {
        $holidays      = Yasumi::create('Netherlands', 2015);
        $otherHolidays = iterator_to_array(new OtherHolidaysFilter($holidays->getIterator()));

        $this->assertArrayNotHasKey('newYearsDay', $otherHolidays);
        $this->assertArrayNotHasKey('pentecost', $otherHolidays);
    }
}
