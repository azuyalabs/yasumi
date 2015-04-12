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
 * Class for testing Columbus Day in the USA.
 *
 * Honors Christopher Columbus, traditional discoverer of the Americas. In some areas it is also a celebration of
 * Indigenous Peoples, or Italian culture and heritage. (traditionally October 12). Columbus Day first became an
 * official state holiday in Colorado in 1906, and became a federal holiday in the United States in 1937, though people
 * have celebrated Columbus's voyage since the colonial period. Since 1970 (Oct. 12), the holiday has been fixed to the
 * second Monday in October.
 *
 * @link http://en.wikipedia.org/wiki/Columbus_Day Source: Wikipedia.
 */
class ColumbusDayTest extends USABaseTestCase
{
    /**
     * The name of the holiday
     */
    const HOLIDAY = 'columbusDay';

    /**
     * Tests Columbus Day on or after 1970. Columbus Day was established in 1937 on October 12th, but has been fixed to
     * the second Monday in October since 1970.
     */
    public function testColumbusDayOnAfter1970()
    {
        $year = $this->generateRandomYear(1970);
        $this->assertHoliday(self::COUNTRY, self::HOLIDAY, $year,
            new DateTime("second monday of october $year", new DateTimeZone(self::TIMEZONE)));
    }

    /**
     * Tests Columbus Day between 1937 and 1969. Columbus Day was established in 1937 on October 12th, but has been
     * fixed to the second Monday in October since 1970.
     */
    public function testColumbusBetween1937And1969()
    {
        $year = $this->generateRandomYear(1937, 1969);
        $this->assertHoliday(self::COUNTRY, self::HOLIDAY, $year,
            new DateTime("$year-10-12", new DateTimeZone(self::TIMEZONE)));
    }

    /**
     * Tests Columbus Day before 1937. Columbus Day was established in 1937 on October 12th, but has been fixed to
     * the second Monday in October since 1970.
     */
    public function testColumbusDayBefore1937()
    {
        $this->assertNotHoliday(self::COUNTRY, self::HOLIDAY, $this->generateRandomYear(1000, 1936));
    }
}
