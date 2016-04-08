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

namespace Yasumi\Tests\Netherlands;

use DateTime;
use DateTimeZone;

/**
 * Class for testing Kings Day in the Netherlands.
 */
class KingsDayTest extends NetherlandsBaseTestCase
{
    /**
     * The name of the holiday
     */
    const HOLIDAY = 'kingsDay';

    /**
     * The year in which the holiday was first established
     */
    const ESTABLISHMENT_YEAR = 2014;

    /**
     * Tests Kings Day on or after 2014. King's Day is celebrated from 2014 onwards on April 27th.
     */
    public function testKingsDayOnAfter2014()
    {
        $year = 2015;
        $this->assertHoliday(self::REGION, self::HOLIDAY, $year,
            new DateTime("$year-4-27", new DateTimeZone(self::TIMEZONE)));
    }

    /**
     * Tests Kings Day substituted on Saturday (when Kings Day falls on a Sunday)
     */
    public function testKingsDayOnAfter2014SubstitutedDay()
    {
        $year = 2188;
        $this->assertHoliday(self::REGION, self::HOLIDAY, $year,
            new DateTime("$year-4-26", new DateTimeZone(self::TIMEZONE)));
    }

    /**
     * Tests Kings Day before 2014. King's Day is celebrated from 2014 onwards on April 27th.
     */
    public function testKingsDayBefore2014()
    {
        $this->assertNotHoliday(self::REGION, self::HOLIDAY,
            $this->generateRandomYear(1000, self::ESTABLISHMENT_YEAR - 1));
    }
}
