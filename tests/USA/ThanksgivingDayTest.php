<?php
/**
 *  This file is part of the Yasumi package.
 *
 *  Copyright (c) 2015 - 2016 AzuyaLabs
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 *
 *  @author Sacha Telgenhof <stelgenhof@gmail.com>
 */

namespace Yasumi\Tests\USA;

use DateTime;
use DateTimeZone;

/**
 * Class for testing Thanksgiving Day in the USA.
 */
class ThanksgivingDayDayTest extends USABaseTestCase
{
    /**
     * The name of the holiday
     */
    const HOLIDAY = 'thanksgivingDay';

    /**
     * The year in which the holiday was first established
     */
    const ESTABLISHMENT_YEAR = 1863;

    /**
     * Tests Thanksgiving Day on or after 1863. ThanksgivingDay Day is celebrated since 1863 on the fourth Thursday
     * of November.
     */
    public function testThanksgivingDayOnAfter1863()
    {
        $year = $this->generateRandomYear(self::ESTABLISHMENT_YEAR);
        $this->assertHoliday(self::COUNTRY, self::HOLIDAY, $year,
            new DateTime("fourth thursday of november $year", new DateTimeZone(self::TIMEZONE)));
    }

    /**
     * Tests Thanksgiving Day before 1863. ThanksgivingDay Day is celebrated since 1863 on the fourth Thursday
     * of November.
     */
    public function testThanksgivingDayBefore1863()
    {
        $this->assertNotHoliday(self::COUNTRY, self::HOLIDAY,
            $this->generateRandomYear(1000, self::ESTABLISHMENT_YEAR - 1));
    }

    /**
     * Tests translated name of Thanksgiving Day.
     */
    public function testTranslation()
    {
        $this->assertTranslatedHolidayName(self::COUNTRY, self::HOLIDAY,
            $this->generateRandomYear(self::ESTABLISHMENT_YEAR), ['en_US' => 'Thanksgiving Day']);
    }
}
