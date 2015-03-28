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
 * Class RespectForTheAgedDayTest.
 */
class RespectForTheAgedDayTest extends JapanBaseTestCase
{
    /**
     * The name of the holiday
     */
    const HOLIDAY = 'respectfortheAgedDay';

    /**
     * Tests Respect for the Aged Day after 2003. Respect for the Aged Day was established since 1996 on September
     * 15th. After 2003 it was changed to be the third monday of September.
     */
    public function testRespectForTheAgedDayOnAfter2003()
    {
        $year = $this->generateRandomYear(2004);
        $this->assertHoliday(self::COUNTRY, self::HOLIDAY, $year, new Carbon('third monday of september ' . $year));
    }

    /**
     * Tests Respect for the Aged Day between 1996 and 2003. Respect for the Aged Day was established since 1996 on
     * September 15th. After 2003 it was changed to be the third monday of September.
     */
    public function testRespectForTheAgedDayBetween1996And2003()
    {
        $year = 1998;
        $this->assertHoliday(self::COUNTRY, self::HOLIDAY, $year, Carbon::createFromDate($year, 9, 15));
        $year = 2002;
        $this->assertHoliday(self::COUNTRY, self::HOLIDAY, $year,
            Carbon::createFromDate($year, 9, 16)); // Substituted day
    }

    /**
     * Tests Respect for the Aged Day before 1996. Respect for the Aged Day was established since 1996 on September
     * 15th. After 2003 it was changed to be the third monday of September.
     */
    public function testRespectForTheAgedDayBefore1996()
    {
        $this->assertNotHoliday(self::COUNTRY, self::HOLIDAY, $this->generateRandomYear(1000, 1995));
    }
}
