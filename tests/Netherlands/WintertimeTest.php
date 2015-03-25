<?php
/*
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
use Carbon\Carbon;
use Yasumi\Tests\Netherlands\NetherlandsBaseTestCase;

/**
 * Class for testing Wintertime.
 *
 * Start of Wintertime takes place on the last sunday of october. (Wintertime is actually the end of Summertime.
 * Summertime is the common name for Daylight Saving Time).
 */
class WinterTimeTest extends NetherlandsBaseTestCase
{
    /**
     * The name of the holiday
     */
    const HOLIDAY = 'winterTime';

    /**
     * Tests Wintertime.
     */
    public function testWintertime()
    {
        $year = 2000;
        $this->assertHoliday(self::COUNTRY, self::HOLIDAY, $year, new Carbon('last sunday of october ' . $year));
    }
}
