<?php
/*
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Yasumi\Tests\USA;

use DateTime;
use DateTimeZone;

/**
 * Class to test Memorial Day.
 *
 * Honors the nation's war dead from the Civil War onwards; marks the unofficial beginning of the summer season.
 *
 * Memorial Day was first declared a federal holiday on May 1, 1865. The Uniform Holidays Act, 1968 shifted the date of
 * the commemoration of Memorial Day from May 30 to the last Monday in May.
 *
 * @link http://en.wikipedia.org/wiki/Memorial_Day Source: Wikipedia.
 */
class MemorialDayTest extends USABaseTestCase
{
    /**
     * The name of the holiday
     */
    const HOLIDAY = 'memorialDay';

    /**
     * Tests Memorial Day on or after 1968. Memorial Day was established since 1865 on May 30 and was changed in 1968
     * to the last Monday in May.
     */
    public function testMemorialDayOnAfter1968()
    {
        $year = $this->generateRandomYear(1968);
        $this->assertHoliday(self::COUNTRY, self::HOLIDAY, $year,
            new DateTime("last monday of may $year", new DateTimeZone(self::TIMEZONE)));
    }

    /**
     * Tests Memorial Day between 1865 and 1967. Memorial Day was established since 1865 on May 30 and was changed in
     * 1968 to the last Monday in May.
     */
    public function testMemorialDayBetween1865And1967()
    {
        $year = $this->generateRandomYear(1865, 1967);
        $this->assertHoliday(self::COUNTRY, self::HOLIDAY, $year,
            new DateTime("$year-5-30", new DateTimeZone(self::TIMEZONE)));
    }

    /**
     * Tests Memorial Day before 1865. Memorial Day was established since 1865 on May 30 and was changed in 1968 to the
     * last Monday in May.
     */
    public function testMemorialDayBefore1865()
    {
        $this->assertNotHoliday(self::COUNTRY, self::HOLIDAY, $this->generateRandomYear(1000, 1864));
    }
}
