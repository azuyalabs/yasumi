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
 * Class ConstitutionMemorialDayTest.
 */
class ConstitutionMemorialDayTest extends JapanBaseTestCase
{
    /**
     * The name of the holiday
     */
    const HOLIDAY = 'constitutionMemorialDay';

    /**
     * Tests Constitution Memorial Day after 1948. Constitution Memorial Day was established after 1948
     */
    public function testConstitutionMemorialDayOnAfter1948()
    {
        $year = 1967;
        $this->assertHoliday(self::COUNTRY, self::HOLIDAY, $year,
            new DateTime("$year-5-3", new DateTimeZone(self::TIMEZONE)));
        $year = 2009;
        $this->assertHoliday(self::COUNTRY, self::HOLIDAY, $year,
            new DateTime("$year-5-6", new DateTimeZone(self::TIMEZONE))); // Substituted day
    }

    /**
     * Tests Constitution Memorial Day before 1948. Constitution Memorial Day was established after 1948
     */
    public function testConstitutionMemorialDayBefore1948()
    {
        $this->assertNotHoliday(self::COUNTRY, self::HOLIDAY, $this->generateRandomYear(1000, 1947));
    }
}
