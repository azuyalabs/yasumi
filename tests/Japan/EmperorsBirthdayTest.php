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
 * Class EmperorsBirthdayTest.
 */
class EmperorsBirthdayTest extends JapanBaseTestCase
{
    /**
     * The name of the holiday
     */
    const HOLIDAY = 'emperorsBirthday';

    /**
     * Tests Emperors Birthday after 1989. The Emperors Birthday is on December 23rd and celebrated as such since 1989.
     * Prior to the death of Emperor Hirohito in 1989, this holiday was celebrated on April 29. See also "Shōwa Day".
     */
    public function testEmperorsBirthdayOnAfter1989()
    {
        $year = 3012;
        $this->assertHoliday(self::COUNTRY, self::HOLIDAY, $year,
            new DateTime("$year-12-23", new DateTimeZone(self::TIMEZONE)));
        $year = 2001;
        $this->assertHoliday(self::COUNTRY, self::HOLIDAY, $year,
            new DateTime("$year-12-24", new DateTimeZone(self::TIMEZONE))); // Substituted day
    }

    /**
     * Tests Emperors Birthday before 1989. The Emperors Birthday is on December 23rd and celebrated as such since
     * 1989. Prior to the death of Emperor Hirohito in 1989, this holiday was celebrated on April 29. See also "Shōwa
     * Day"/"Greenery Day"
     */
    public function testEmperorsBirthdayBefore1989()
    {
        $this->assertNotHoliday(self::COUNTRY, self::HOLIDAY, $this->generateRandomYear(1000, 1988));
    }
}
