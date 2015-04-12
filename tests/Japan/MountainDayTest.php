<?php
/*
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <stelgenhof@gmail.com>
 */
namespace Yasumi\Tests\Japan;

use DateTime;
use DateTimeZone;

/**
 * Class MountainDayTest.
 */
class MountainDayTest extends JapanBaseTestCase
{
    /**
     * The name of the holiday
     */
    const HOLIDAY = 'mountainDay';

    /**
     * Tests Mountain Day after 2016. Mountain Day was established in 2014 and is held from 2016 on August 11th.
     */
    public function testMountainDayOnAfter2016()
    {
        $year = 2016;
        $this->assertHoliday(self::COUNTRY, self::HOLIDAY, $year,
            new DateTime("$year-8-11", new DateTimeZone(self::TIMEZONE)));
        $year = 2019;
        $this->assertHoliday(self::COUNTRY, self::HOLIDAY, $year,
            new DateTime("$year-8-12", new DateTimeZone(self::TIMEZONE))); // Substituted day
    }

    /**
     * Tests Mountain Day before 2016. Mountain Day was established in 2014 and is held from 2016 on August 11th.
     */
    public function testMountainDayBefore2016()
    {
        $this->assertNotHoliday(self::COUNTRY, self::HOLIDAY, $this->generateRandomYear(1000, 2015));
    }
}
