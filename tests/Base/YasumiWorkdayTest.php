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
use PHPUnit\Framework\TestCase;
use ReflectionException;
use Yasumi\Yasumi;

/**
 * Class YasumiWorkdayTest.
 *
 * Class for testing the workday functions.
 */
class YasumiWorkdayTest extends TestCase
{
    public const FORMAT_DATE = 'Y-m-d';

    /**
     * Tests that the nextWorkingDay function returns an object that implements the DateTimeInterface (e.g. DateTime)
     *
     * @throws Exception
     * @throws ReflectionException
     */
    public function testNextWorkingDay(): void
    {
        // Includes a weekend and a holiday
        $provider = 'USA';
        $date = '2016-07-01';
        $timezone = 'America/New_York';
        $expectedDate = '2016-07-05';

        // Assertion using a DateTime instance
        $startDate = new DateTime($date, new DateTimeZone($timezone));
        $result = Yasumi::nextWorkingDay($provider, $startDate);

        $this->assertInstanceOf(DateTime::class, $result);
        $this->assertEquals($expectedDate, $result->format(self::FORMAT_DATE));

        // Assertion using a DateTimeImmutable instance
        $startDate = new DateTimeImmutable($date, new DateTimeZone($timezone));
        $result = Yasumi::nextWorkingDay($provider, $startDate);

        $this->assertInstanceOf(DateTimeImmutable::class, $result);
        $this->assertEquals($expectedDate, $result->format(self::FORMAT_DATE));
    }

    /**
     * Tests that the prevWorkingDay function returns an object that implements the DateTimeInterface (e.g. DateTime)
     *
     * @throws Exception
     * @throws ReflectionException
     */
    public function testPreviousWorkingDay(): void
    {
        // Includes a weekend and a holiday
        $provider = 'USA';
        $date = '2016-07-05';
        $timezone = 'America/New_York';
        $expectedDate = '2016-07-01';

        // Assertion using a DateTime instance
        $startDate = new DateTime($date, new DateTimeZone($timezone));
        $result = Yasumi::prevWorkingDay($provider, $startDate);

        $this->assertInstanceOf(DateTime::class, $result);
        $this->assertEquals($expectedDate, $result->format(self::FORMAT_DATE));

        // Assertion using a DateTimeImmutable instance
        $startDate = new DateTimeImmutable($date, new DateTimeZone($timezone));
        $result = Yasumi::prevWorkingDay($provider, $startDate);

        $this->assertInstanceOf(DateTimeImmutable::class, $result);
        $this->assertEquals($expectedDate, $result->format(self::FORMAT_DATE));
    }

    /**
     * Tests that the prevWorkingDay and nextWorkingDay functions returns an object that implements the
     * DateTimeInterface (e.g. DateTime) when an interval is chosen that passes the year boundary (i.e. beyond 12/31)
     *
     * @throws Exception
     * @throws ReflectionException
     */
    public function testYearBoundary(): void
    {
        /**
         * Use Case (USA):
         *
         * 20 working days between 20th Dec and 20th Jan
         * 2015-12-20 is a Sunday
         * 21st - 24th (4 Workdays)
         * 25th Christmas, 26th-27th Weekend
         * 28th - 31st (4 Workdays)
         * 1st Jan New Years, 2nd-3rd Weekend
         * 4th - 8th (5 Workdays)
         * 9th-10th Weekend
         * 11th-15th (5 Workdays)
         * 16th-17th Weekend, 18th Martin Luther King Day
         * 19th-20th (2 Workdays)
         *
         * @see https://www.timeanddate.com/calendar/?year=2016&country=1
         */

        $provider = 'USA';
        $timezone = 'America/New_York';
        $interval = 20;
        $start = '2015-12-20';
        $expectedNext = '2016-01-20';
        $expectedPrevious = '2015-12-18';

        // Assertion using a DateTime instance
        $startDate = new DateTime($start, new DateTimeZone($timezone));
        $result = Yasumi::nextWorkingDay($provider, $startDate, $interval);

        $this->assertEquals($expectedNext, $result->format(self::FORMAT_DATE));

        $startDate = new DateTime($expectedNext, new DateTimeZone($timezone));
        $result = Yasumi::prevWorkingDay($provider, $startDate, $interval);
        $this->assertEquals($expectedPrevious, $result->format(self::FORMAT_DATE));

        // Assertion using a DateTimeImmutable instance
        $startDate = new DateTimeImmutable($start, new DateTimeZone($timezone));
        $result = Yasumi::nextWorkingDay($provider, $startDate, $interval);

        $this->assertEquals($expectedNext, $result->format(self::FORMAT_DATE));

        $startDate = new DateTimeImmutable($expectedNext, new DateTimeZone($timezone));
        $result = Yasumi::prevWorkingDay($provider, $startDate, $interval);
        $this->assertEquals($expectedPrevious, $result->format(self::FORMAT_DATE));
    }

    /**
     * Tests when the next working day happens to be in the next year.
     *
     * @dataProvider dataProviderWorkDayNextYear
     *
     * @param string $start
     * @param int $workdays
     * @param string $expectedNext
     *
     * @throws ReflectionException
     * @throws Exception
     */
    public function testWorkDayIsNextYear(string $start, int $workdays, string $expectedNext): void
    {
        $provider = 'USA';
        $timezone = 'America/New_York';
        $startDate = new DateTime($start, new DateTimeZone($timezone));
        $result = Yasumi::nextWorkingDay($provider, $startDate, $workdays);

        $this->assertEquals($expectedNext, $result->format(self::FORMAT_DATE));
    }

    /**
     * @return array
     */
    public function dataProviderWorkDayNextYear(): array
    {
        return [
            [
                '2019-12-30',
                2,
                '2020-01-02',
            ],
            [
                '2018-12-28',
                2,
                '2019-01-02',
            ],
        ];
    }

    /**
     * Tests when the previous working day happens to be in the previous year.
     *
     * @dataProvider dataProviderWorkDayPreviousYear
     *
     * @param string $start
     * @param int $workdays
     * @param string $expectedNext
     *
     * @throws ReflectionException
     * @throws Exception
     */
    public function testWorkDayIsPreviousYear(string $start, int $workdays, string $expectedNext): void
    {
        $provider = 'USA';
        $timezone = 'America/New_York';
        $startDate = new DateTime($start, new DateTimeZone($timezone));
        $result = Yasumi::prevWorkingDay($provider, $startDate, $workdays);

        $this->assertEquals($expectedNext, $result->format(self::FORMAT_DATE));
    }

    /**
     * @return array
     */
    public function dataProviderWorkDayPreviousYear(): array
    {
        return [
            [
                '2020-01-02',
                2,
                '2019-12-30',
            ],
            [
                '2019-01-02',
                2,
                '2018-12-28',
            ],
        ];
    }
}
