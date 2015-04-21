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
 */
class WashingtonsBirthdayTest extends USABaseTestCase
{
    /**
     * The name of the holiday
     */
    const HOLIDAY = 'washingtonsBirthday';

    /**
     * The year in which the holiday was first established
     */
    const ESTABLISHMENT_YEAR = 1879;

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
        $year = $this->generateRandomYear(self::ESTABLISHMENT_YEAR, 1967);
        $this->assertHoliday(self::COUNTRY, self::HOLIDAY, $year,
            new DateTime("$year-2-22", new DateTimeZone(self::TIMEZONE)));
    }

    /**
     * Tests Washington's Birthday before 1879. Washington's Birthday was established since 1879 on February 22 and was
     * changed in 1968 to the third Monday in February.
     */
    public function testWashingtonsBirthdayBefore1879()
    {
        $this->assertNotHoliday(self::COUNTRY, self::HOLIDAY,
            $this->generateRandomYear(1000, self::ESTABLISHMENT_YEAR - 1));
    }

    /**
     * Tests translated name of Washington's Birthday.
     */
    public function testTranslation()
    {
        $this->assertTranslatedHolidayName(self::COUNTRY, self::HOLIDAY,
            $this->generateRandomYear(self::ESTABLISHMENT_YEAR), ['en_US' => 'Washington\'s Birthday']);
    }
}
