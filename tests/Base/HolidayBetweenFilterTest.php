<?php

declare(strict_types=1);
/*
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 - 2023 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <me at sachatelgenhof dot com>
 */

namespace Yasumi\tests\Base;

use PHPUnit\Framework\TestCase;
use Yasumi\tests\YasumiBase;
use Yasumi\Yasumi;

class HolidayBetweenFilterTest extends TestCase
{
    use YasumiBase;

    /** @throws \Exception */
    public function testHolidaysBetweenDateRange(): void
    {
        $timezone = 'Europe/Amsterdam';
        $holidays = Yasumi::create('Netherlands', 2016);

        $between = $holidays->between(
            new \DateTime('03/25/2016', new \DateTimeZone($timezone)),
            new \DateTime('07/25/2016', new \DateTimeZone($timezone))
        );

        $betweenHolidays = iterator_to_array($between);

        self::assertArrayHasKey('goodFriday', $betweenHolidays);
        self::assertArrayHasKey('easter', $betweenHolidays);
        self::assertArrayHasKey('summerTime', $betweenHolidays);
        self::assertArrayHasKey('easterMonday', $betweenHolidays);
        self::assertArrayHasKey('kingsDay', $betweenHolidays);
        self::assertArrayHasKey('internationalWorkersDay', $betweenHolidays);
        self::assertArrayHasKey('commemorationDay', $betweenHolidays);
        self::assertArrayHasKey('ascensionDay', $betweenHolidays);
        self::assertArrayHasKey('liberationDay', $betweenHolidays);
        self::assertArrayHasKey('mothersDay', $betweenHolidays);
        self::assertArrayHasKey('pentecost', $betweenHolidays);
        self::assertArrayHasKey('pentecostMonday', $betweenHolidays);
        self::assertArrayHasKey('fathersDay', $betweenHolidays);

        self::assertArrayNotHasKey('newYearsDay', $betweenHolidays);
        self::assertArrayNotHasKey('epiphany', $betweenHolidays);
        self::assertArrayNotHasKey('carnivalDay', $betweenHolidays);
        self::assertArrayNotHasKey('secondCarnivalDay', $betweenHolidays);
        self::assertArrayNotHasKey('thirdCarnivalDay', $betweenHolidays);
        self::assertArrayNotHasKey('ashWednesday', $betweenHolidays);
        self::assertArrayNotHasKey('valentinesDay', $betweenHolidays);
        self::assertArrayNotHasKey('princesDay', $betweenHolidays);
        self::assertArrayNotHasKey('worldAnimalDay', $betweenHolidays);
        self::assertArrayNotHasKey('winterTime', $betweenHolidays);
        self::assertArrayNotHasKey('halloween', $betweenHolidays);
        self::assertArrayNotHasKey('stMartinsDay', $betweenHolidays);
        self::assertArrayNotHasKey('stNicholasDay', $betweenHolidays);
        self::assertArrayNotHasKey('christmasDay', $betweenHolidays);
        self::assertArrayNotHasKey('secondChristmasDay', $betweenHolidays);

        self::assertCount(13, $between);
        self::assertNotCount(\count($holidays), $between);

        self::assertEquals(13, $between->count());
        self::assertNotEquals(\count($holidays), $between->count());
    }

    /** @throws \Exception */
    public function testHolidaysBetweenDateRangeWithDateTimeImmutable(): void
    {
        $timezone = 'Europe/Amsterdam';
        $holidays = Yasumi::create('Netherlands', 2016);

        $between = $holidays->between(
            new \DateTimeImmutable('03/25/2016', new \DateTimeZone($timezone)),
            new \DateTimeImmutable('07/25/2016', new \DateTimeZone($timezone))
        );

        $betweenHolidays = iterator_to_array($between);

        self::assertArrayHasKey('goodFriday', $betweenHolidays);
        self::assertArrayHasKey('easter', $betweenHolidays);
        self::assertArrayHasKey('summerTime', $betweenHolidays);
        self::assertArrayHasKey('easterMonday', $betweenHolidays);
        self::assertArrayHasKey('kingsDay', $betweenHolidays);
        self::assertArrayHasKey('internationalWorkersDay', $betweenHolidays);
        self::assertArrayHasKey('commemorationDay', $betweenHolidays);
        self::assertArrayHasKey('ascensionDay', $betweenHolidays);
        self::assertArrayHasKey('liberationDay', $betweenHolidays);
        self::assertArrayHasKey('mothersDay', $betweenHolidays);
        self::assertArrayHasKey('pentecost', $betweenHolidays);
        self::assertArrayHasKey('pentecostMonday', $betweenHolidays);
        self::assertArrayHasKey('fathersDay', $betweenHolidays);

        self::assertArrayNotHasKey('newYearsDay', $betweenHolidays);
        self::assertArrayNotHasKey('epiphany', $betweenHolidays);
        self::assertArrayNotHasKey('carnivalDay', $betweenHolidays);
        self::assertArrayNotHasKey('secondCarnivalDay', $betweenHolidays);
        self::assertArrayNotHasKey('thirdCarnivalDay', $betweenHolidays);
        self::assertArrayNotHasKey('ashWednesday', $betweenHolidays);
        self::assertArrayNotHasKey('valentinesDay', $betweenHolidays);
        self::assertArrayNotHasKey('princesDay', $betweenHolidays);
        self::assertArrayNotHasKey('worldAnimalDay', $betweenHolidays);
        self::assertArrayNotHasKey('winterTime', $betweenHolidays);
        self::assertArrayNotHasKey('halloween', $betweenHolidays);
        self::assertArrayNotHasKey('stMartinsDay', $betweenHolidays);
        self::assertArrayNotHasKey('stNicholasDay', $betweenHolidays);
        self::assertArrayNotHasKey('christmasDay', $betweenHolidays);
        self::assertArrayNotHasKey('secondChristmasDay', $betweenHolidays);

        self::assertCount(13, $between);
        self::assertNotCount(\count($holidays), $between);

        self::assertEquals(13, $between->count());
        self::assertNotEquals(\count($holidays), $between->count());
    }

    /** @throws \Exception */
    public function testHolidaysBetweenDateRangeDifferentTimezone(): void
    {
        $holidays = Yasumi::create('Netherlands', 2016);

        $timezones = ['Pacific/Honolulu', 'Europe/Amsterdam', 'Asia/Tokyo'];

        foreach ($timezones as $timezone) {
            $between = $holidays->between(
                new \DateTime('01/01/2016', new \DateTimeZone($timezone)),
                new \DateTime('01/01/2016', new \DateTimeZone($timezone))
            );
            self::assertCount(1, $between);

            $between = $holidays->between(
                new \DateTime('01/01/2016 23:59:59', new \DateTimeZone($timezone)),
                new \DateTime('01/01/2016 23:59:59', new \DateTimeZone($timezone))
            );
            self::assertCount(1, $between);
        }
    }

    /** @throws \Exception */
    public function testHolidaysBetweenDateRangeExclusiveStartEndDate(): void
    {
        $timezone = 'Europe/Amsterdam';
        $holidays = Yasumi::create('Netherlands', 2016);

        $between = $holidays->between(
            new \DateTime('01/01/2016', new \DateTimeZone($timezone)),
            new \DateTime('07/25/2016', new \DateTimeZone($timezone)),
            false
        );

        $betweenHolidays = iterator_to_array($between);

        self::assertArrayHasKey('epiphany', $betweenHolidays);
        self::assertArrayHasKey('carnivalDay', $betweenHolidays);
        self::assertArrayHasKey('secondCarnivalDay', $betweenHolidays);
        self::assertArrayHasKey('thirdCarnivalDay', $betweenHolidays);
        self::assertArrayHasKey('ashWednesday', $betweenHolidays);
        self::assertArrayHasKey('valentinesDay', $betweenHolidays);
        self::assertArrayHasKey('goodFriday', $betweenHolidays);
        self::assertArrayHasKey('easter', $betweenHolidays);
        self::assertArrayHasKey('summerTime', $betweenHolidays);
        self::assertArrayHasKey('easterMonday', $betweenHolidays);
        self::assertArrayHasKey('kingsDay', $betweenHolidays);
        self::assertArrayHasKey('internationalWorkersDay', $betweenHolidays);
        self::assertArrayHasKey('commemorationDay', $betweenHolidays);
        self::assertArrayHasKey('ascensionDay', $betweenHolidays);
        self::assertArrayHasKey('liberationDay', $betweenHolidays);
        self::assertArrayHasKey('mothersDay', $betweenHolidays);
        self::assertArrayHasKey('pentecost', $betweenHolidays);
        self::assertArrayHasKey('pentecostMonday', $betweenHolidays);
        self::assertArrayHasKey('fathersDay', $betweenHolidays);

        self::assertArrayNotHasKey('newYearsDay', $betweenHolidays);
        self::assertArrayNotHasKey('princesDay', $betweenHolidays);
        self::assertArrayNotHasKey('worldAnimalDay', $betweenHolidays);
        self::assertArrayNotHasKey('winterTime', $betweenHolidays);
        self::assertArrayNotHasKey('halloween', $betweenHolidays);
        self::assertArrayNotHasKey('stMartinsDay', $betweenHolidays);
        self::assertArrayNotHasKey('stNicholasDay', $betweenHolidays);
        self::assertArrayNotHasKey('christmasDay', $betweenHolidays);
        self::assertArrayNotHasKey('secondChristmasDay', $betweenHolidays);

        self::assertCount(19, $between);
        self::assertNotCount(\count($holidays), $between);

        self::assertEquals(19, $between->count());
        self::assertNotEquals(\count($holidays), $between->count());
    }

    /** @throws \Exception */
    public function testHolidaysBetweenDateRangeWithStartBeforeInstanceYear(): void
    {
        $year = 2015;
        $timezone = 'Europe/Oslo';
        $holidays = Yasumi::create('Norway', $year);

        $between = $holidays->between(
            new \DateTime('03/25/2011', new \DateTimeZone($timezone)),
            new \DateTime('05/17/'.$year, new \DateTimeZone($timezone))
        );

        $betweenHolidays = iterator_to_array($between);

        self::assertArrayHasKey('newYearsDay', $betweenHolidays);
        self::assertArrayHasKey('maundyThursday', $betweenHolidays);
        self::assertArrayHasKey('goodFriday', $betweenHolidays);
        self::assertArrayHasKey('easter', $betweenHolidays);
        self::assertArrayHasKey('easterMonday', $betweenHolidays);
        self::assertArrayHasKey('internationalWorkersDay', $betweenHolidays);
        self::assertArrayHasKey('ascensionDay', $betweenHolidays);
        self::assertArrayHasKey('constitutionDay', $betweenHolidays);

        self::assertArrayNotHasKey('pentecost', $betweenHolidays);
        self::assertArrayNotHasKey('pentecostMonday', $betweenHolidays);
        self::assertArrayNotHasKey('christmasDay', $betweenHolidays);
        self::assertArrayNotHasKey('secondChristmasDay', $betweenHolidays);

        self::assertCount(8, $between);
        self::assertNotCount(\count($holidays), $between);

        self::assertEquals(8, $between->count());
        self::assertNotEquals(\count($holidays), $between->count());
    }

    /** @throws \Exception */
    public function testHolidaysBetweenDateRangeWithEndAfterInstanceYear(): void
    {
        $year = 2000;
        $timezone = 'Europe/Rome';
        $holidays = Yasumi::create('Italy', $year);

        $between = $holidays->between(
            new \DateTime('03/25/'.$year, new \DateTimeZone($timezone)),
            new \DateTime('09/21/2021', new \DateTimeZone($timezone))
        );

        $betweenHolidays = iterator_to_array($between);

        self::assertArrayNotHasKey('newYearsDay', $betweenHolidays);
        self::assertArrayNotHasKey('epiphany', $betweenHolidays);

        self::assertArrayHasKey('easter', $betweenHolidays);
        self::assertArrayHasKey('easterMonday', $betweenHolidays);
        self::assertArrayHasKey('liberationDay', $betweenHolidays);
        self::assertArrayHasKey('internationalWorkersDay', $betweenHolidays);
        self::assertArrayHasKey('republicDay', $betweenHolidays);
        self::assertArrayHasKey('assumptionOfMary', $betweenHolidays);
        self::assertArrayHasKey('allSaintsDay', $betweenHolidays);
        self::assertArrayHasKey('immaculateConception', $betweenHolidays);
        self::assertArrayHasKey('christmasDay', $betweenHolidays);
        self::assertArrayHasKey('stStephensDay', $betweenHolidays);

        self::assertCount(10, $between);
        self::assertNotCount(\count($holidays), $between);

        self::assertEquals(10, $between->count());
        self::assertNotEquals(\count($holidays), $between->count());
    }

    /** @throws \Exception */
    public function testWrongDates(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        $year = 2017;
        $timezone = 'America/New_York';
        $holidays = Yasumi::create('USA', $year);

        $holidays->between(
            new \DateTime('12/31/'.$year, new \DateTimeZone($timezone)),
            new \DateTime('01/01/'.$year, new \DateTimeZone($timezone))
        );
    }

    /**
     * Tests the BetweenFilter so that a substituted holiday is only counted once.
     *
     * This test covers the scenario that the requested date range covers all know holidays.
     *
     * @throws \Exception
     */
    public function testCountBetweenWithSubstitutes(): void
    {
        // There are official 12 holidays in Ireland in the year 2018, with 1 substituted holiday.
        $year = 2018;
        $timezone = 'Europe/Dublin';
        $holidays = Yasumi::create('Ireland', $year);

        $between = $holidays->between(
            new \DateTime('01/01/'.$year, new \DateTimeZone($timezone)),
            new \DateTime('12/31/'.$year, new \DateTimeZone($timezone))
        );

        $betweenHolidays = iterator_to_array($between);

        // Assert array definitions
        self::assertArrayHasKey('newYearsDay', $betweenHolidays);
        self::assertArrayHasKey('stPatricksDay', $betweenHolidays);
        self::assertArrayHasKey('easter', $betweenHolidays);
        self::assertArrayHasKey('easterMonday', $betweenHolidays);
        self::assertArrayHasKey('mayDay', $betweenHolidays);
        self::assertArrayHasKey('juneHoliday', $betweenHolidays);
        self::assertArrayHasKey('augustHoliday', $betweenHolidays);
        self::assertArrayHasKey('octoberHoliday', $betweenHolidays);
        self::assertArrayHasKey('christmasDay', $betweenHolidays);
        self::assertArrayHasKey('stStephensDay', $betweenHolidays);
        self::assertArrayHasKey('pentecost', $betweenHolidays);
        self::assertArrayHasKey('goodFriday', $betweenHolidays);
        self::assertArrayNotHasKey('pentecostMonday', $betweenHolidays);

        self::assertCount(12, $between);
        self::assertEquals(12, $between->count());
    }

    /**
     * Tests the BetweenFilter so that a substituted holiday is only counted once.
     *
     * This test covers the scenario that the requested date range excludes a substituted holiday.
     *
     * @throws \Exception
     */
    public function testCountBetweenExcludingSubstituteHoliday(): void
    {
        // There are 2 official holidays in Ireland in the given date range, with 1 substituted holiday.
        $year = 2018;
        $timezone = 'Europe/Dublin';
        $holidays = Yasumi::create('Ireland', $year);

        $between = $holidays->between(
            new \DateTime('01/01/'.$year, new \DateTimeZone($timezone)),
            new \DateTime('03/20/'.$year, new \DateTimeZone($timezone))
        );

        $betweenHolidays = iterator_to_array($between);

        // Assert array definitions
        self::assertArrayHasKey('newYearsDay', $betweenHolidays);
        self::assertArrayHasKey('stPatricksDay', $betweenHolidays);
        self::assertArrayNotHasKey('mayDay', $betweenHolidays);
        self::assertArrayNotHasKey('juneHoliday', $betweenHolidays);
        self::assertArrayNotHasKey('augustHoliday', $betweenHolidays);
        self::assertArrayNotHasKey('octoberHoliday', $betweenHolidays);
        self::assertArrayNotHasKey('christmasDay', $betweenHolidays);
        self::assertArrayNotHasKey('stStephensDay', $betweenHolidays);
        self::assertArrayNotHasKey('pentecost', $betweenHolidays);
        self::assertArrayNotHasKey('goodFriday', $betweenHolidays);
        self::assertArrayNotHasKey('easter', $betweenHolidays);
        self::assertArrayNotHasKey('easterMonday', $betweenHolidays);
        self::assertArrayNotHasKey('pentecostMonday', $betweenHolidays);

        self::assertCount(2, $between);
        self::assertNotCount(\count($holidays), $between);

        self::assertEquals(2, $between->count());
        self::assertNotEquals(\count($holidays), $between->count());
    }

    /**
     * Tests the BetweenFilter so that a substituted holiday is only counted once.
     *
     * This test covers the scenario that the requested date range excludes a substituted holiday, but includes
     * the original substituted holiday.
     *
     * @throws \Exception
     */
    public function testCountBetweenExcludingSubstituteHolidayIncludingOriginalHoliday(): void
    {
        // There are 2 official holidays in Ireland in the given date range, with 1 substituted holiday.
        $year = 2018;
        $timezone = 'Europe/Dublin';
        $holidays = Yasumi::create('Ireland', $year);

        $between = $holidays->between(
            new \DateTime('01/01/'.$year, new \DateTimeZone($timezone)),
            new \DateTime('03/18/'.$year, new \DateTimeZone($timezone))
        );

        $betweenHolidays = iterator_to_array($between);

        // Assert array definitions
        self::assertArrayHasKey('newYearsDay', $betweenHolidays);
        self::assertArrayHasKey('stPatricksDay', $betweenHolidays);
        self::assertArrayNotHasKey('easterMonday', $betweenHolidays);
        self::assertArrayNotHasKey('mayDay', $betweenHolidays);
        self::assertArrayNotHasKey('juneHoliday', $betweenHolidays);
        self::assertArrayNotHasKey('augustHoliday', $betweenHolidays);
        self::assertArrayNotHasKey('octoberHoliday', $betweenHolidays);
        self::assertArrayNotHasKey('christmasDay', $betweenHolidays);
        self::assertArrayNotHasKey('stStephensDay', $betweenHolidays);
        self::assertArrayNotHasKey('pentecost', $betweenHolidays);
        self::assertArrayNotHasKey('goodFriday', $betweenHolidays);
        self::assertArrayNotHasKey('easter', $betweenHolidays);
        self::assertArrayNotHasKey('easterMonday', $betweenHolidays);
        self::assertArrayNotHasKey('pentecostMonday', $betweenHolidays);

        self::assertCount(2, $between);
        self::assertNotCount(\count($holidays), $between);

        self::assertEquals(2, $between->count());
        self::assertNotEquals(\count($holidays), $between->count());
    }

    /**
     * Tests the BetweenFilter so that a substituted holiday is only counted once.
     *
     * This test covers the scenario that the requested date range excludes a substituted holiday and also
     * the original substituted holiday.
     *
     * @throws \Exception
     */
    public function testCountBetweenExcludingSubstituteHolidayAndOriginalHoliday(): void
    {
        // There is 1 official holidays in Ireland in the given date range.
        $year = 2018;
        $timezone = 'Europe/Dublin';
        $holidays = Yasumi::create('Ireland', $year);

        $between = $holidays->between(
            new \DateTime('01/01/'.$year, new \DateTimeZone($timezone)),
            new \DateTime('03/16/'.$year, new \DateTimeZone($timezone))
        );

        $betweenHolidays = iterator_to_array($between);

        // Assert array definitions
        self::assertArrayHasKey('newYearsDay', $betweenHolidays);
        self::assertArrayNotHasKey('stPatricksDay', $betweenHolidays);
        self::assertArrayNotHasKey('mayDay', $betweenHolidays);
        self::assertArrayNotHasKey('juneHoliday', $betweenHolidays);
        self::assertArrayNotHasKey('augustHoliday', $betweenHolidays);
        self::assertArrayNotHasKey('octoberHoliday', $betweenHolidays);
        self::assertArrayNotHasKey('christmasDay', $betweenHolidays);
        self::assertArrayNotHasKey('stStephensDay', $betweenHolidays);
        self::assertArrayNotHasKey('pentecost', $betweenHolidays);
        self::assertArrayNotHasKey('goodFriday', $betweenHolidays);
        self::assertArrayNotHasKey('easter', $betweenHolidays);
        self::assertArrayNotHasKey('easterMonday', $betweenHolidays);
        self::assertArrayNotHasKey('pentecostMonday', $betweenHolidays);

        self::assertCount(1, $between);
        self::assertNotCount(\count($holidays), $between);

        self::assertEquals(1, $between->count());
        self::assertNotEquals(\count($holidays), $between->count());
    }
}
