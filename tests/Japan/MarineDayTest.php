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
 * Class MarineDayTest.
 */
class MarineDayTest extends JapanBaseTestCase
{
    /**
     * The name of the holiday
     */
    const HOLIDAY = 'marineDay';

    /**
     * Tests Marine Day after 2003. Marine Day was established since 1996 on July 20th. After 2003 it was changed
     * to be the third monday of July.
     */
    public function testMarineDayOnAfter2003()
    {
        $year = $this->generateRandomYear(2004);
        $this->assertHoliday(self::COUNTRY, self::HOLIDAY, $year, new Carbon('third monday of july ' . $year));
    }

    /**
     * Tests Marine Day between 1996 and 2003. Marine Day was established since 1996 on July 20th. After 2003 it was
     * changed to be the third monday of July.
     */
    public function testMarineDayBetween1996And2003()
    {
        $year = 2001;
        $this->assertHoliday(self::COUNTRY, self::HOLIDAY, $year, Carbon::createFromDate($year, 7, 20));
        $year = 1997;
        $this->assertHoliday(self::COUNTRY, self::HOLIDAY, $year,
            Carbon::createFromDate($year, 7, 21)); // Substituted day
    }

    /**
     * Tests Marine Day before 1996. Marine Day was established since 1996 on July 20th. After 2003 it was changed
     * to be the third monday of July.
     */
    public function testMarineDayBefore1996()
    {
        $this->assertNotHoliday(self::COUNTRY, self::HOLIDAY, $this->generateRandomYear(1000, 1995));
    }
}
