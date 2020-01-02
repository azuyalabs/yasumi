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
use DateTimeZone;
use Exception;
use PHPUnit\Framework\TestCase;
use ReflectionException;
use Yasumi\tests\YasumiBase;
use Yasumi\Yasumi;

/**
 * Class HolidayOnFilterTest.
 *
 * Contains tests for testing the OnFilter class
 */
class HolidayOnFilterTest extends TestCase
{
    use YasumiBase;

    /**
     * Tests the basic usage of the OnFilter.
     *
     * @throws ReflectionException
     * @throws Exception
     */
    public function testHolidaysOnDate(): void
    {
        $timezone = 'Europe/Amsterdam';
        $holidays = Yasumi::create('Netherlands', 2016);

        $holidayDates = [
            'goodFriday' => new DateTime('03/25/2016', new DateTimeZone($timezone)),
            'easter' => new DateTime('03/27/2016', new DateTimeZone($timezone)),
            'summerTime' => new DateTime('03/27/2016', new DateTimeZone($timezone)),
        ];

        foreach ($holidayDates as $name => $date) {
            $holidaysOnDate = $holidays->on(
                $date
            );

            $this->assertArrayHasKey($name, \iterator_to_array($holidaysOnDate));
        }
    }

    /**
     * @throws ReflectionException
     * @throws Exception
     */
    public function testHolidaysNotOnDate(): void
    {
        $timezone = 'Europe/Amsterdam';
        $holidays = Yasumi::create('Netherlands', 2016);

        $holidayWrongDates = [
            'goodFriday' => new DateTime('04/25/2016', new DateTimeZone($timezone)),
            'easter' => new DateTime('03/22/2016', new DateTimeZone($timezone)),
            'summerTime' => new DateTime('12/27/2016', new DateTimeZone($timezone)),
        ];

        foreach ($holidayWrongDates as $name => $date) {
            $holidaysOnDate = $holidays->on(
                $date
            );

            $this->assertArrayNotHasKey($name, \iterator_to_array($holidaysOnDate));
        }
    }

    /**
     * @throws ReflectionException
     * @throws Exception
     */
    public function testCorrectNumberOfHolidaysOnDate(): void
    {
        $timezone = 'Europe/Amsterdam';
        $holidays = Yasumi::create('Netherlands', 2016);

        // No holidays
        $holidaysOnDate = $holidays->on(new DateTime('11/19/2016', new DateTimeZone($timezone)));
        $this->assertEquals(0, $holidaysOnDate->count());

        // One holiday
        $holidaysOnDate = $holidays->on(new DateTime('12/25/2016', new DateTimeZone($timezone)));
        $this->assertEquals(1, $holidaysOnDate->count());

        // Multiple holidays
        $holidaysOnDate = $holidays->on(new DateTime('03/27/2016', new DateTimeZone($timezone)));
        $this->assertGreaterThan(1, $holidaysOnDate->count());
    }
}
