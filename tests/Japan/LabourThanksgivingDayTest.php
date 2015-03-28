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
 * Class LabourThanksgivingDayTest.
 */
class LabourThanksgivingDayTest extends JapanBaseTestCase
{
    /**
     * The name of the holiday
     */
    const HOLIDAY = 'laborThanksgivingDay';

    /**
     * Tests Labor Thanksgiving Day after. Labor Thanksgiving Day is held on November 23rd and established since 1948.
     */
    public function testLabourThanksgivingDayOnAfter1948()
    {
        $year = 4884;
        $this->assertHoliday(self::COUNTRY, self::HOLIDAY, $year, Carbon::createFromDate($year, 11, 23));
        $year = 1986;
        $this->assertHoliday(self::COUNTRY, self::HOLIDAY, $year,
            Carbon::createFromDate($year, 11, 24)); // Substituted day
    }

    /**
     * Tests Labor Thanksgiving Day before 1948. Labor Thanksgiving Day is held on November 23rd and established since
     * 1948.
     */
    public function testLabourThanksgivingDayBefore1948()
    {
        $this->assertNotHoliday(self::COUNTRY, self::HOLIDAY, $this->generateRandomYear(1000, 1947));
    }
}
