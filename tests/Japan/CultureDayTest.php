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
 * Class CultureDayTest.
 */
class CultureDayTest extends JapanBaseTestCase
{
    /**
     * The name of the holiday
     */
    const HOLIDAY = 'cultureDay';

    /**
     * Tests Culture Day after 1948. Culture Day Day was established after 1948
     */
    public function testCultureDayOnAfter1948()
    {
        $year = 1973;
        $this->assertHoliday(self::COUNTRY, self::HOLIDAY, $year, Carbon::createFromDate($year, 11, 3));
        $year = 2661;
        $this->assertHoliday(self::COUNTRY, self::HOLIDAY, $year,
            Carbon::createFromDate($year, 11, 4)); // Substituted day
    }

    /**
     * Tests Culture Day before 1948. Culture Day was established after 1948
     */
    public function testCultureDayBefore1948()
    {
        $this->assertNotHoliday(self::COUNTRY, self::HOLIDAY, $this->generateRandomYear(1000, 1947));
    }
}
