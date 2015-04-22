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
 * Class ShowaDayTest.
 */
class ShowaDayTest extends JapanBaseTestCase
{
    /**
     * The name of the holiday
     */
    const HOLIDAY = 'showaDay';

    /**
     * The year in which the holiday was first established
     */
    const ESTABLISHMENT_YEAR = 2007;

    /**
     * Tests Showa Day after 2007. Showa day was established after 2007
     */
    public function testShowaDayOnAfter2007()
    {
        $year = 2110;
        $this->assertHoliday(self::COUNTRY, self::HOLIDAY, $year,
            new DateTime("$year-4-29", new DateTimeZone(self::TIMEZONE)));
        $year = 2210;
        $this->assertHoliday(self::COUNTRY, self::HOLIDAY, $year,
            new DateTime("$year-4-30", new DateTimeZone(self::TIMEZONE)));
    }

    /**
     * Tests Showa Day before 2007. Showa day was established after 2007
     */
    public function testShowaDayBefore2007()
    {
        $this->assertNotHoliday(self::COUNTRY, self::HOLIDAY,
            $this->generateRandomYear(1000, self::ESTABLISHMENT_YEAR - 1));
    }
}
