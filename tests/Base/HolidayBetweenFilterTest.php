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

use DateTime;
use DateTimeImmutable;
use DateTimeZone;
use Exception;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use ReflectionException;
use Yasumi\tests\YasumiBase;
use Yasumi\Yasumi;

/**
 * Class HolidayBetweenFilterTest.
 *
 * Contains tests for testing the BetweenFilter class
 */
class HolidayBetweenFilterTest extends TestCase
{
    use YasumiBase;

    /**
     * Tests the basic usage of the BetweenFilter.
     *
     * @throws Exception
     * @throws ReflectionException
     */
    public function testHolidaysBetweenDateRange(): void
    {
        $timezone = 'Europe/Amsterdam';
        $holidays = Yasumi::create('Netherlands', 2016);

        $between = $holidays->between(
            new DateTime('03/25/2016', new DateTimeZone($timezone)),
            new DateTime('07/25/2016', new DateTimeZone($timezone))
        );

        $betweenHolidays = \iterator_to_array($between);

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

        $this->assertCount(13, $between);
        $this->assertNotCount(\count($holidays), $between);

        $this->assertEquals(13, $between->count());
        $this->assertNotEquals(\count($holidays), $between->count());
    }

    /**
     * Tests the basic usage of the BetweenFilter using DateTimeImmutable objects.
     *
     * @throws Exception
     * @throws ReflectionException
     */
    public function testHolidaysBetweenDateRangeWithDateTimeImmutable(): void
    {
        $timezone = 'Europe/Amsterdam';
        $holidays = Yasumi::create('Netherlands', 2016);

        $between = $holidays->between(
            new DateTimeImmutable('03/25/2016', new DateTimeZone($timezone)),
            new DateTimeImmutable('07/25/2016', new DateTimeZone($timezone))
        );

        $betweenHolidays = \iterator_to_array($between);

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

        $this->assertCount(13, $between);
        $this->assertNotCount(\count($holidays), $between);

        $this->assertEquals(13, $between->count());
        $this->assertNotEquals(\count($holidays), $between->count());
    }

    /**
     * Tests that BetweenFilter considers the date and ignores timezones and time of day.
     *
     * @throws Exception
     * @throws ReflectionException
     */
    public function testHolidaysBetweenDateRangeDifferentTimezone(): void
    {
        $holidays = Yasumi::create('Netherlands', 2016);

        $timezones = ['Pacific/Honolulu', 'Europe/Amsterdam', 'Asia/Tokyo'];

        foreach ($timezones as $timezone) {
            $between = $holidays->between(
                new DateTime('01/01/2016', new DateTimeZone($timezone)),
                new DateTime('01/01/2016', new DateTimeZone($timezone))
            );
            $this->assertCount(1, $between);

            $between = $holidays->between(
                new DateTime('01/01/2016 23:59:59', new DateTimeZone($timezone)),
                new DateTime('01/01/2016 23:59:59', new DateTimeZone($timezone))
            );
            $this->assertCount(1, $between);
        }
    }

    /**
     * Tests the BetweenFilter with date range where start and end date are exclusive of the comparison.
     *
     * @throws Exception
     * @throws ReflectionException
     */
    public function testHolidaysBetweenDateRangeExclusiveStartEndDate(): void
    {
        $timezone = 'Europe/Amsterdam';
        $holidays = Yasumi::create('Netherlands', 2016);

        $between = $holidays->between(
            new DateTime('01/01/2016', new DateTimeZone($timezone)),
            new DateTime('07/25/2016', new DateTimeZone($timezone)),
            false
        );

        $betweenHolidays = \iterator_to_array($between);

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

        $this->assertCount(19, $between);
        $this->assertNotCount(\count($holidays), $between);

        $this->assertEquals(19, $between->count());
        $this->assertNotEquals(\count($holidays), $between->count());
    }

    /**
     * Tests the BetweenFilter where the start date lies before the year of the Holiday Provider instance.
     *
     * @throws Exception
     * @throws ReflectionException
     */
    public function testHolidaysBetweenDateRangeWithStartBeforeInstanceYear(): void
    {
        $year = 2015;
        $timezone = 'Europe/Oslo';
        $holidays = Yasumi::create('Norway', $year);

        $between = $holidays->between(
            new DateTime('03/25/2011', new DateTimeZone($timezone)),
            new DateTime('05/17/' . $year, new DateTimeZone($timezone))
        );

        $betweenHolidays = \iterator_to_array($between);

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

        $this->assertCount(8, $between);
        $this->assertNotCount(\count($holidays), $between);

        $this->assertEquals(8, $between->count());
        $this->assertNotEquals(\count($holidays), $between->count());
    }

    /**
     * Tests the BetweenFilter where the end date lies beyond the year of the Holiday Provider instance.
     *
     * @throws Exception
     * @throws ReflectionException
     */
    public function testHolidaysBetweenDateRangeWithEndAfterInstanceYear(): void
    {
        $year = 2000;
        $timezone = 'Europe/Rome';
        $holidays = Yasumi::create('Italy', $year);

        $between = $holidays->between(
            new DateTime('03/25/' . $year, new DateTimeZone($timezone)),
            new DateTime('09/21/2021', new DateTimeZone($timezone))
        );

        $betweenHolidays = \iterator_to_array($between);

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

        $this->assertCount(10, $between);
        $this->assertNotCount(\count($holidays), $between);

        $this->assertEquals(10, $between->count());
        $this->assertNotEquals(\count($holidays), $between->count());
    }

    /**
     * Tests that an InvalidArgumentException is thrown in case an invalid holiday provider is given.
     *
     * @throws Exception
     * @throws ReflectionException
     */
    public function testWrongDates(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $year = 2017;
        $timezone = 'America/New_York';
        $holidays = Yasumi::create('USA', $year);

        $holidays->between(
            new DateTime('12/31/' . $year, new DateTimeZone($timezone)),
            new DateTime('01/01/' . $year, new DateTimeZone($timezone))
        );
    }

    /**
     * Tests the BetweenFilter so that a substituted holiday is only counted once.
     *
     * This test covers the scenario that the requested date range covers all know holidays.
     *
     * @throws Exception
     * @throws ReflectionException
     */
    public function testCountBetweenWithSubstitutes(): void
    {
        // There are official 12 holidays in Ireland in the year 2018, with 1 substituted holiday.
        $year = 2018;
        $timezone = 'Europe/Dublin';
        $holidays = Yasumi::create('Ireland', $year);

        $between = $holidays->between(
            new DateTime('01/01/' . $year, new DateTimeZone($timezone)),
            new DateTime('12/31/' . $year, new DateTimeZone($timezone))
        );

        $betweenHolidays = \iterator_to_array($between);

        // Assert array definitions
        $this->assertArrayHasKey('newYearsDay', $betweenHolidays);
        $this->assertArrayHasKey('stPatricksDay', $betweenHolidays);
        $this->assertArrayHasKey('easter', $betweenHolidays);
        $this->assertArrayHasKey('easterMonday', $betweenHolidays);
        $this->assertArrayHasKey('mayDay', $betweenHolidays);
        $this->assertArrayHasKey('juneHoliday', $betweenHolidays);
        $this->assertArrayHasKey('augustHoliday', $betweenHolidays);
        $this->assertArrayHasKey('octoberHoliday', $betweenHolidays);
        $this->assertArrayHasKey('christmasDay', $betweenHolidays);
        $this->assertArrayHasKey('stStephensDay', $betweenHolidays);
        $this->assertArrayHasKey('pentecost', $betweenHolidays);
        $this->assertArrayHasKey('goodFriday', $betweenHolidays);
        $this->assertArrayNotHasKey('pentecostMonday', $betweenHolidays);

        $this->assertCount(12, $between);
        $this->assertEquals(12, $between->count());
    }

    /**
     * Tests the BetweenFilter so that a substituted holiday is only counted once.
     *
     * This test covers the scenario that the requested date range excludes a substituted holiday.
     *
     * @throws Exception
     * @throws ReflectionException
     */
    public function testCountBetweenExcludingSubstituteHoliday(): void
    {
        // There are 2 official holidays in Ireland in the given date range, with 1 substituted holiday.
        $year = 2018;
        $timezone = 'Europe/Dublin';
        $holidays = Yasumi::create('Ireland', $year);

        $between = $holidays->between(
            new DateTime('01/01/' . $year, new DateTimeZone($timezone)),
            new DateTime('03/20/' . $year, new DateTimeZone($timezone))
        );

        $betweenHolidays = \iterator_to_array($between);

        // Assert array definitions
        $this->assertArrayHasKey('newYearsDay', $betweenHolidays);
        $this->assertArrayHasKey('stPatricksDay', $betweenHolidays);
        $this->assertArrayNotHasKey('mayDay', $betweenHolidays);
        $this->assertArrayNotHasKey('juneHoliday', $betweenHolidays);
        $this->assertArrayNotHasKey('augustHoliday', $betweenHolidays);
        $this->assertArrayNotHasKey('octoberHoliday', $betweenHolidays);
        $this->assertArrayNotHasKey('christmasDay', $betweenHolidays);
        $this->assertArrayNotHasKey('stStephensDay', $betweenHolidays);
        $this->assertArrayNotHasKey('pentecost', $betweenHolidays);
        $this->assertArrayNotHasKey('goodFriday', $betweenHolidays);
        $this->assertArrayNotHasKey('easter', $betweenHolidays);
        $this->assertArrayNotHasKey('easterMonday', $betweenHolidays);
        $this->assertArrayNotHasKey('pentecostMonday', $betweenHolidays);

        $this->assertCount(2, $between);
        $this->assertNotCount(\count($holidays), $between);

        $this->assertEquals(2, $between->count());
        $this->assertNotEquals(\count($holidays), $between->count());
    }

    /**
     * Tests the BetweenFilter so that a substituted holiday is only counted once.
     *
     * This test covers the scenario that the requested date range excludes a substituted holiday, but includes
     * the original substituted holiday.
     *
     * @throws Exception
     * @throws ReflectionException
     */
    public function testCountBetweenExcludingSubstituteHolidayIncludingOriginalHoliday(): void
    {
        // There are 2 official holidays in Ireland in the given date range, with 1 substituted holiday.
        $year = 2018;
        $timezone = 'Europe/Dublin';
        $holidays = Yasumi::create('Ireland', $year);

        $between = $holidays->between(
            new DateTime('01/01/' . $year, new DateTimeZone($timezone)),
            new DateTime('03/18/' . $year, new DateTimeZone($timezone))
        );

        $betweenHolidays = \iterator_to_array($between);

        // Assert array definitions
        $this->assertArrayHasKey('newYearsDay', $betweenHolidays);
        $this->assertArrayHasKey('stPatricksDay', $betweenHolidays);
        $this->assertArrayNotHasKey('easterMonday', $betweenHolidays);
        $this->assertArrayNotHasKey('mayDay', $betweenHolidays);
        $this->assertArrayNotHasKey('juneHoliday', $betweenHolidays);
        $this->assertArrayNotHasKey('augustHoliday', $betweenHolidays);
        $this->assertArrayNotHasKey('octoberHoliday', $betweenHolidays);
        $this->assertArrayNotHasKey('christmasDay', $betweenHolidays);
        $this->assertArrayNotHasKey('stStephensDay', $betweenHolidays);
        $this->assertArrayNotHasKey('pentecost', $betweenHolidays);
        $this->assertArrayNotHasKey('goodFriday', $betweenHolidays);
        $this->assertArrayNotHasKey('easter', $betweenHolidays);
        $this->assertArrayNotHasKey('easterMonday', $betweenHolidays);
        $this->assertArrayNotHasKey('pentecostMonday', $betweenHolidays);

        $this->assertCount(2, $between);
        $this->assertNotCount(\count($holidays), $between);

        $this->assertEquals(2, $between->count());
        $this->assertNotEquals(\count($holidays), $between->count());
    }

    /**
     * Tests the BetweenFilter so that a substituted holiday is only counted once.
     *
     * This test covers the scenario that the requested date range excludes a substituted holiday and also
     * the original substituted holiday.
     *
     * @throws Exception
     * @throws ReflectionException
     */
    public function testCountBetweenExcludingSubstituteHolidayAndOriginalHoliday(): void
    {
        // There is 1 official holidays in Ireland in the given date range.
        $year = 2018;
        $timezone = 'Europe/Dublin';
        $holidays = Yasumi::create('Ireland', $year);

        $between = $holidays->between(
            new DateTime('01/01/' . $year, new DateTimeZone($timezone)),
            new DateTime('03/16/' . $year, new DateTimeZone($timezone))
        );

        $betweenHolidays = \iterator_to_array($between);

        // Assert array definitions
        $this->assertArrayHasKey('newYearsDay', $betweenHolidays);
        $this->assertArrayNotHasKey('stPatricksDay', $betweenHolidays);
        $this->assertArrayNotHasKey('mayDay', $betweenHolidays);
        $this->assertArrayNotHasKey('juneHoliday', $betweenHolidays);
        $this->assertArrayNotHasKey('augustHoliday', $betweenHolidays);
        $this->assertArrayNotHasKey('octoberHoliday', $betweenHolidays);
        $this->assertArrayNotHasKey('christmasDay', $betweenHolidays);
        $this->assertArrayNotHasKey('stStephensDay', $betweenHolidays);
        $this->assertArrayNotHasKey('pentecost', $betweenHolidays);
        $this->assertArrayNotHasKey('goodFriday', $betweenHolidays);
        $this->assertArrayNotHasKey('easter', $betweenHolidays);
        $this->assertArrayNotHasKey('easterMonday', $betweenHolidays);
        $this->assertArrayNotHasKey('pentecostMonday', $betweenHolidays);

        $this->assertCount(1, $between);
        $this->assertNotCount(\count($holidays), $between);

        $this->assertEquals(1, $between->count());
        $this->assertNotEquals(\count($holidays), $between->count());
    }
}
