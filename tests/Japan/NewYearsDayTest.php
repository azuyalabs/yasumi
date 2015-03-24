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
 * Class NewYearsDayTest.
 */
class NewYearsDayTest extends JapanBaseTestCase
{
    /**
     * The name of the holiday
     */
    const HOLIDAY = 'newYearsDay';

    /**
     * Tests New Years Day after 1948. New Years Day was established after 1948
     */
    public function testNewYearsDayOnAfter1948()
    {
        $year = 2014;
        $this->assertHoliday(self::COUNTRY, self::HOLIDAY, $year, Carbon::createFromDate($year, 1, 1));
    }

    /**
     * Tests New Years Day before 1948. New Years Day was established after 1948
     */
    public function testNewYearsDayBefore1948()
    {
        $this->assertNotHoliday(self::COUNTRY, self::HOLIDAY, 1677);
    }
}
