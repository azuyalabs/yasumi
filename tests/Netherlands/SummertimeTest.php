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
 * Class for testing Summertime.
 *
 * Start of Summertime takes place on the last sunday of march. (Summertime is the common name for Daylight Saving
 * Time).
 */
class SummerTimeTest extends NetherlandsBaseTestCase
{
    /**
     * The name of the holiday
     */
    const HOLIDAY = 'summerTime';

    /**
     * Tests Summertime.
     */
    public function testSummertime()
    {
        $year = 1977;
        $this->assertHoliday(self::COUNTRY, self::HOLIDAY, $year, new Carbon('last sunday of march ' . $year));
    }
}
