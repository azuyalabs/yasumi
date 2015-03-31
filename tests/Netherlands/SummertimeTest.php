<?php
/*
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
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
     * Tests Summertime.
     */
    public function testSummertime()
    {
        $year = $this->generateRandomYear();
        $this->assertHoliday(self::COUNTRY, 'summerTime', $year,
            new DateTime("last sunday of march $year", new DateTimeZone(self::TIMEZONE)));
    }
}
