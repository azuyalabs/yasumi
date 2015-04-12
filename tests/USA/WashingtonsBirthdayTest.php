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
namespace Yasumi\Tests\USA;

use DateTime;
use DateTimeZone;

/**
 * Class to test Washington's Birthday.
 *
 * Washington's Birthday is a United States federal holiday celebrated on the third Monday of February in honor of
 * George Washington, the first President of the United States. Colloquially, it is widely known as Presidents Day and
 * is often an occasion to remember all the presidents.
 *
 * Washington's Birthday was first declared a federal holiday by an 1879 act of Congress. The Uniform Holidays Act,
 * 1968 shifted the date of the commemoration of Washington's Birthday from February 22 to the third Monday in February.
 *
 * @link http://en.wikipedia.org/wiki/Washington%27s_Birthday Source: Wikipedia.
 */
class WashingtonsBirthdayTest extends USABaseTestCase
{
    /**
     * The name of the holiday
     */
    const HOLIDAY = 'washingtonsBirthday';

    /**
     * Tests Washington's Birthday on or after 1968. Washington's Birthday was established since 1879 on February 22
     * and was changed in 1968 to the third Monday in February.
     */
    public function testWashingtonsBirthdayOnAfter1968()
    {
        $year = $this->generateRandomYear(1968);
        $this->assertHoliday(self::COUNTRY, self::HOLIDAY, $year,
            new DateTime("third monday of february $year", new DateTimeZone(self::TIMEZONE)));
    }

    /**
     * Tests Washington's Birthday between 1879 and 1967. Washington's Birthday was established since 1879 on February
     * 22 and was changed in 1968 to the third Monday in February.
     */
    public function testWashingtonsBirthdayBetween1879And1967()
    {
        $year = $this->generateRandomYear(1879, 1967);
        $this->assertHoliday(self::COUNTRY, self::HOLIDAY, $year,
            new DateTime("$year-2-22", new DateTimeZone(self::TIMEZONE)));
    }

    /**
     * Tests Washington's Birthday before 1879. Washington's Birthday was established since 1879 on February 22 and was
     * changed in 1968 to the third Monday in February.
     */
    public function testWashingtonsBirthdayBefore1879()
    {
        $this->assertNotHoliday(self::COUNTRY, self::HOLIDAY, $this->generateRandomYear(1000, 1878));
    }
}
