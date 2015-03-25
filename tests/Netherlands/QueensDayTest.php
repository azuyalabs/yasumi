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
 * Class for testing Queen's Day.
 *
 * Queen's Day was celebrated between 1891 and 1948 (inclusive) on August 31. Between 1949 and 2013 (inclusive) it
 * was celebrated April 30. If these dates are on a Sunday, Queen's Day was celebrated one day later until 1980
 * (on the following Monday), starting 1980 one day earlier (on the preceding Saturday).
 */
class QueensDayTest extends NetherlandsBaseTestCase
{
    /**
     * The name of the holiday
     */
    const HOLIDAY = 'queensDay';

    /**
     * Tests Queens Day between 1891 and 1948.
     */
    public function testQueensBetween1891and1948()
    {
        $year = 1901;
        $this->assertHoliday(self::COUNTRY, self::HOLIDAY, $year, Carbon::createFromDate($year, 8, 31));

        // Substituted day (one day later)
        $year = 1947;
        $this->assertHoliday(self::COUNTRY, self::HOLIDAY, $year, Carbon::createFromDate($year, 9, 1));
    }

    /**
     * Tests Queens Day between 1949 and 2013.
     */
    public function testQueensBetween1949and2013()
    {
        $year = 1965;
        $this->assertHoliday(self::COUNTRY, self::HOLIDAY, $year, Carbon::createFromDate($year, 4, 30));

        // Substituted day (one day later)
        $year = 1978;
        $this->assertHoliday(self::COUNTRY, self::HOLIDAY, $year, Carbon::createFromDate($year, 5, 1));

        // Substituted day (one day earlier)
        $year = 2006;
        $this->assertHoliday(self::COUNTRY, self::HOLIDAY, $year, Carbon::createFromDate($year, 4, 29));
    }

    /**
     * Tests Queen's Day before 1891.
     */
    public function testQueensDayBefore1891()
    {
        $this->assertNotHoliday(self::COUNTRY, self::HOLIDAY, 1755);
    }

    /**
     * Tests Queen's Day after 2013.
     */
    public function testQueensDayAfter2013()
    {
        $this->assertNotHoliday(self::COUNTRY, self::HOLIDAY, 2690);
    }
}
