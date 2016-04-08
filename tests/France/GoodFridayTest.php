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

namespace Yasumi\Tests\France;

use DateTime;
use DateTimeZone;

/**
 * Class containing tests for Good Friday in France.
 */
class goodFridayTest extends FranceBaseTestCase
{
    /**
     * The name of the holiday.
     */
    const HOLIDAY = 'goodFriday';

    /**
     * Tests Good Friday.
     */
    public function testGoodFriday()
    {
        $year = 2008;
        $this->assertHoliday(self::REGION, self::HOLIDAY, $year,
            new DateTime("$year-3-21", new DateTimeZone(self::TIMEZONE)));
    }

    /**
     * Tests translated name of Good Friday.
     */
    public function testTranslation()
    {
        $this->assertTranslatedHolidayName(self::REGION, self::HOLIDAY, $this->generateRandomYear(),
            ['fr_FR' => 'Vendredi saint']);
    }
}
