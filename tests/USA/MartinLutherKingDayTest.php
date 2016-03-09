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
 * Class to test Dr. Martin Luther King Day.
 */
class MartinLutherKingDayTest extends USABaseTestCase
{
    /**
     * The name of the holiday
     */
    const HOLIDAY = 'martinLutherKingDay';

    /**
     * The year in which the holiday was first established
     */
    const ESTABLISHMENT_YEAR = 1986;

    /**
     * Tests Dr. Martin Luther King Day on or after 1986. Dr. Martin Luther King Day was established since 1986 on the
     * third Monday of January.
     */
    public function testMartinLutherKingDayOnAfter1986()
    {
        $year = $this->generateRandomYear(self::ESTABLISHMENT_YEAR);
        $this->assertHoliday(self::COUNTRY, self::HOLIDAY, $year,
            new DateTime("third monday of january $year", new DateTimeZone(self::TIMEZONE)));
    }

    /**
     * Tests Dr. Martin Luther King Day before 1986. Dr. Martin Luther King Day was established since 1996 on the third
     * Monday of January.
     */
    public function testMartinLutherKingDayBefore1986()
    {
        $this->assertNotHoliday(self::COUNTRY, self::HOLIDAY,
            $this->generateRandomYear(1000, self::ESTABLISHMENT_YEAR - 1));
    }

    /**
     * Tests translated name of Dr. Martin Luther King Day.
     */
    public function testTranslation()
    {
        $this->assertTranslatedHolidayName(self::COUNTRY, self::HOLIDAY,
            $this->generateRandomYear(self::ESTABLISHMENT_YEAR), ['en_US' => 'Dr. Martin Luther King Jr\'s Birthday']);
    }
}
