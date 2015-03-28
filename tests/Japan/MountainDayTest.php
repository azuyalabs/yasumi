<?php
/*
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Yasumi\Tests\Japan;

use Carbon\Carbon;

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
        $this->assertHoliday(self::COUNTRY, self::HOLIDAY, $year, Carbon::createFromDate($year, 8, 11));
        $year = 2019;
        $this->assertHoliday(self::COUNTRY, self::HOLIDAY, $year,
            Carbon::createFromDate($year, 8, 12)); // Substituted day
    }

    /**
     * Tests Mountain Day before 2016. Mountain Day was established in 2014 and is held from 2016 on August 11th.
     */
    public function testMountainDayBefore2016()
    {
        $this->assertNotHoliday(self::COUNTRY, self::HOLIDAY, $this->generateRandomYear(1000, 2015));
    }
}
