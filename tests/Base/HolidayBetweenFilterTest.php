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

namespace Yasumi\tests\Base;

use DateTime;
use DateTimeZone;
use InvalidArgumentException;
use PHPUnit_Framework_TestCase;
use Yasumi\tests\YasumiBase;
use Yasumi\Yasumi;

/**
 * Class HolidayBetweenFilterTest.
 *
 * Contains tests for testing the BetweenFilter class
 */
class HolidayBetweenFilterTest extends PHPUnit_Framework_TestCase
{
    use YasumiBase;

    /**
     * Tests the basic usage of the BetweenFilter.
     */
    public function testHolidaysBetweenDateRange()
    {
        $timezone = 'Europe/Amsterdam';
        $holidays = Yasumi::create('Netherlands', 2016);

        $between = $holidays->between(
            new DateTime('03/25/2016', new DateTimeZone($timezone)),
            new DateTime('07/25/2016', new DateTimeZone($timezone))
        );

        $betweenHolidays = iterator_to_array($between);

        $this->assertArrayHasKey('goodFriday', $betweenHolidays);
        $this->assertArrayHasKey('easter', $betweenHolidays);
        $this->assertArrayHasKey('summerTime', $betweenHolidays);
        $this->assertArrayHasKey('easterMonday', $betweenHolidays);
        $this->assertArrayHasKey('kingsDay', $betweenHolidays);
        $this->assertArrayHasKey('internationalWorkersDay', $betweenHolidays);
        $this->assertArrayHasKey('commemorationDay', $betweenHolidays);
        $this->assertArrayHasKey('ascensionDay', $betweenHolidays);
        $this->assertArrayHasKey('liberationDay', $betweenHolidays);
        $this->assertArrayHasKey('mothersDay', $betweenHolidays);
        $this->assertArrayHasKey('pentecost', $betweenHolidays);
        $this->assertArrayHasKey('pentecostMonday', $betweenHolidays);
        $this->assertArrayHasKey('fathersDay', $betweenHolidays);

        $this->assertArrayNotHasKey('newYearsDay', $betweenHolidays);
        $this->assertArrayNotHasKey('epiphany', $betweenHolidays);
        $this->assertArrayNotHasKey('carnivalDay', $betweenHolidays);
        $this->assertArrayNotHasKey('secondCarnivalDay', $betweenHolidays);
        $this->assertArrayNotHasKey('thirdCarnivalDay', $betweenHolidays);
        $this->assertArrayNotHasKey('ashWednesday', $betweenHolidays);
        $this->assertArrayNotHasKey('valentinesDay', $betweenHolidays);
        $this->assertArrayNotHasKey('princesDay', $betweenHolidays);
        $this->assertArrayNotHasKey('worldAnimalDay', $betweenHolidays);
        $this->assertArrayNotHasKey('winterTime', $betweenHolidays);
        $this->assertArrayNotHasKey('halloween', $betweenHolidays);
        $this->assertArrayNotHasKey('stMartinsDay', $betweenHolidays);
        $this->assertArrayNotHasKey('stNicholasDay', $betweenHolidays);
        $this->assertArrayNotHasKey('christmasDay', $betweenHolidays);
        $this->assertArrayNotHasKey('secondChristmasDay', $betweenHolidays);

        $this->assertCount(13, $betweenHolidays);
    }

    /**
     * Tests the BetweenFilter with date range where start and end date are exclusive of the comparison.
     */
    public function testHolidaysBetweenDateRangeExclusiveStartEndDate()
    {
        $timezone = 'Europe/Amsterdam';
        $holidays = Yasumi::create('Netherlands', 2016);

        $between = $holidays->between(
            new DateTime('01/01/2016', new DateTimeZone($timezone)),
            new DateTime('07/25/2016', new DateTimeZone($timezone)),
            false
        );

        $betweenHolidays = iterator_to_array($between);

        $this->assertArrayHasKey('epiphany', $betweenHolidays);
        $this->assertArrayHasKey('carnivalDay', $betweenHolidays);
        $this->assertArrayHasKey('secondCarnivalDay', $betweenHolidays);
        $this->assertArrayHasKey('thirdCarnivalDay', $betweenHolidays);
        $this->assertArrayHasKey('ashWednesday', $betweenHolidays);
        $this->assertArrayHasKey('valentinesDay', $betweenHolidays);
        $this->assertArrayHasKey('goodFriday', $betweenHolidays);
        $this->assertArrayHasKey('easter', $betweenHolidays);
        $this->assertArrayHasKey('summerTime', $betweenHolidays);
        $this->assertArrayHasKey('easterMonday', $betweenHolidays);
        $this->assertArrayHasKey('kingsDay', $betweenHolidays);
        $this->assertArrayHasKey('internationalWorkersDay', $betweenHolidays);
        $this->assertArrayHasKey('commemorationDay', $betweenHolidays);
        $this->assertArrayHasKey('ascensionDay', $betweenHolidays);
        $this->assertArrayHasKey('liberationDay', $betweenHolidays);
        $this->assertArrayHasKey('mothersDay', $betweenHolidays);
        $this->assertArrayHasKey('pentecost', $betweenHolidays);
        $this->assertArrayHasKey('pentecostMonday', $betweenHolidays);
        $this->assertArrayHasKey('fathersDay', $betweenHolidays);

        $this->assertArrayNotHasKey('newYearsDay', $betweenHolidays);
        $this->assertArrayNotHasKey('princesDay', $betweenHolidays);
        $this->assertArrayNotHasKey('worldAnimalDay', $betweenHolidays);
        $this->assertArrayNotHasKey('winterTime', $betweenHolidays);
        $this->assertArrayNotHasKey('halloween', $betweenHolidays);
        $this->assertArrayNotHasKey('stMartinsDay', $betweenHolidays);
        $this->assertArrayNotHasKey('stNicholasDay', $betweenHolidays);
        $this->assertArrayNotHasKey('christmasDay', $betweenHolidays);
        $this->assertArrayNotHasKey('secondChristmasDay', $betweenHolidays);

        $this->assertCount(28, $holidays);
        $this->assertCount(19, $betweenHolidays);
    }

    /**
     * Tests the BetweenFilter where the start date lies before the year of the Holiday Provider instance.
     */
    public function testHolidaysBetweenDateRangeWithStartBeforeInstanceYear()
    {
        $year     = 2015;
        $timezone = 'Europe/Oslo';
        $holidays = Yasumi::create('Norway', $year);

        $between = $holidays->between(
            new DateTime('03/25/2011', new DateTimeZone($timezone)),
            new DateTime('05/17/' . $year, new DateTimeZone($timezone))
        );

        $betweenHolidays = iterator_to_array($between);

        $this->assertArrayHasKey('newYearsDay', $betweenHolidays);
        $this->assertArrayHasKey('maundyThursday', $betweenHolidays);
        $this->assertArrayHasKey('goodFriday', $betweenHolidays);
        $this->assertArrayHasKey('easter', $betweenHolidays);
        $this->assertArrayHasKey('easterMonday', $betweenHolidays);
        $this->assertArrayHasKey('internationalWorkersDay', $betweenHolidays);
        $this->assertArrayHasKey('ascensionDay', $betweenHolidays);
        $this->assertArrayHasKey('constitutionDay', $betweenHolidays);

        $this->assertArrayNotHasKey('pentecost', $betweenHolidays);
        $this->assertArrayNotHasKey('pentecostMonday', $betweenHolidays);
        $this->assertArrayNotHasKey('christmasDay', $betweenHolidays);
        $this->assertArrayNotHasKey('secondChristmasDay', $betweenHolidays);

        $this->assertCount(12, $holidays);
        $this->assertCount(8, $betweenHolidays);
    }

    /**
     * Tests the BetweenFilter where the end date lies beyond the year of the Holiday Provider instance.
     */
    public function testHolidaysBetweenDateRangeWithEndAfterInstanceYear()
    {
        $year     = 2000;
        $timezone = 'Europe/Rome';
        $holidays = Yasumi::create('Italy', $year);

        $between = $holidays->between(
            new DateTime('03/25/' . $year, new DateTimeZone($timezone)),
            new DateTime('09/21/2021', new DateTimeZone($timezone))
        );

        $betweenHolidays = iterator_to_array($between);

        $this->assertArrayNotHasKey('newYearsDay', $betweenHolidays);
        $this->assertArrayNotHasKey('epiphany', $betweenHolidays);


        $this->assertArrayHasKey('easter', $betweenHolidays);
        $this->assertArrayHasKey('easterMonday', $betweenHolidays);
        $this->assertArrayHasKey('liberationDay', $betweenHolidays);
        $this->assertArrayHasKey('internationalWorkersDay', $betweenHolidays);
        $this->assertArrayHasKey('republicDay', $betweenHolidays);
        $this->assertArrayHasKey('assumptionOfMary', $betweenHolidays);
        $this->assertArrayHasKey('allSaintsDay', $betweenHolidays);
        $this->assertArrayHasKey('immaculateConception', $betweenHolidays);
        $this->assertArrayHasKey('christmasDay', $betweenHolidays);
        $this->assertArrayHasKey('stStephensDay', $betweenHolidays);

        $this->assertCount(12, $holidays);
        $this->assertCount(10, $betweenHolidays);
    }

    /**
     * Tests that an InvalidArgumentException is thrown in case an invalid holiday provider is given.
     *
     * @expectedException InvalidArgumentException
     */
    public function testWrongDates()
    {
        $year     = 2017;
        $timezone = 'America/New_York';
        $holidays = Yasumi::create('USA', $year);

        $holidays->between(
            new DateTime('12/31/' . $year, new DateTimeZone($timezone)),
            new DateTime('01/01/' . $year, new DateTimeZone($timezone))
        );
    }
}
