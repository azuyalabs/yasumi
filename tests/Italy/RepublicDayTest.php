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
namespace Yasumi\Tests\Italy;

use DateTime;
use DateTimeZone;

/**
 * Class containing tests for Republic Day in Italy.
 *
 * Festa della Repubblica (in English, Republic Day) is the Italian National Day and Republic Day, which is celebrated
 * on 2 June each year. The day commemorates the institutional referendum held by universal suffrage in 1946, in which
 * the Italian people were called to the polls to decide on the form of government, following the Second World War and
 * the fall of Fascism.
 *
 * @link http://en.wikipedia.org/wiki/Festa_della_Repubblica Source: Wikipedia.
 */
class RepublicDayTest extends ItalyBaseTestCase
{
    /**
     * The name of the holiday
     */
    const HOLIDAY = 'republicDay';

    /**
     * Tests Republic Day on or after 1946.
     */
    public function testRepublicDayOnAfter1946()
    {
        $year = $this->generateRandomYear(1946);
        $this->assertHoliday(self::COUNTRY, self::HOLIDAY, $year,
            new DateTime("$year-6-2", new DateTimeZone(self::TIMEZONE)));
    }

    /**
     * Tests Republic Day before 1946.
     */
    public function testRepublicDayBefore1946()
    {
        $this->assertNotHoliday(self::COUNTRY, self::HOLIDAY, $this->generateRandomYear(1000, 1945));
    }

    /**
     * Tests translated name of Republic Day.
     */
    public function testTranslatedRepublicDay()
    {
        $this->assertTranslatedHolidayName(self::COUNTRY, self::HOLIDAY, $this->generateRandomYear(1946),
            ['it_IT' => 'Festa della Repubblica']);
    }
}
