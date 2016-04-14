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

namespace Yasumi\tests\Poland;

use DateTime;
use DateTimeZone;

/**
 * Class containing tests for Corpus Christi in Poland.
 */
class CorpusChristiTest extends PolandBaseTestCase
{
    /**
     * The name of the holiday
     */
    const HOLIDAY = 'corpusChristi';

    /**
     * Tests the holiday defined in this test.
     */
    public function testHoliday()
    {
        $year = 2017;
        $this->assertHoliday(self::REGION, self::HOLIDAY, $year,
            new DateTime("$year-6-15", new DateTimeZone(self::TIMEZONE)));
    }

    /**
     * Tests translated name of Corpus Christi.
     */
    public function testTranslation()
    {
        $this->assertTranslatedHolidayName(self::REGION, self::HOLIDAY, $this->generateRandomYear(),
            ['pl_PL' => 'Boże Ciało']);
    }
}
