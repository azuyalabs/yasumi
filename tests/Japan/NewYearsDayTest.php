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

use DateTime;
use DateTimeZone;

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
        $year = $this->generateRandomYear(1948);
        $this->assertHoliday(self::COUNTRY, self::HOLIDAY, $year,
            new DateTime("$year-1-1", new DateTimeZone(self::TIMEZONE)));
    }

    /**
     * Tests New Years Day before 1948. New Years Day was established after 1948
     */
    public function testNewYearsDayBefore1948()
    {
        $this->assertNotHoliday(self::COUNTRY, self::HOLIDAY, $this->generateRandomYear(1000, 1947));
    }
}
