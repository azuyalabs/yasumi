<?php
/*
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Yasumi\Tests\Netherlands;

use Carbon\Carbon;

/**
 * Class LiberationDayTest.
 */
class LiberationDayTest extends NetherlandsBaseTestCase
{
    /**
     * The name of the holiday
     */
    const HOLIDAY = 'liberationDay';

    /**
     * Tests Liberation Day before 1947. Liberation Day was established after WWII in 1947.
     */
    public function testLiberationDayBefore1947()
    {
        $this->assertNotHoliday(self::COUNTRY, self::HOLIDAY, 1805);
    }

    /**
     * Tests Liberation Day after 1947. Liberation Day was established after WWII in 1947.
     */
    public function testLiberationDayOnAfter1947()
    {
        $year = 1951;
        $this->assertHoliday(self::COUNTRY, self::HOLIDAY, $year, Carbon::createFromDate($year, 5, 5));
    }
}
