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
use Yasumi\Yasumi;

/**
 * Class for testing Veterans Day in the USA.
 *
 * Veterans Day is an official United States holiday that honors people who have served in the U.S. Armed Forces, also
 * known as veterans. It is a federal holiday that is observed on November 11 since 1919. Congress amended a bill on
 * June 1, 1954, replacing "Armistice" with "Veterans," and it has been known as Veterans Day since.
 *
 * @link http://en.wikipedia.org/wiki/Veterans_Day Source: Wikipedia.
 */
class VeteransDayTest extends USABaseTestCase
{
    /**
     * The name of the holiday
     */
    const HOLIDAY = 'veteransDay';

    /**
     * Tests Veterans Day on or after 1919. Veterans Day was established in 1919 on November 11.
     */
    public function testVeteransDayOnAfter1919()
    {
        $year = $this->generateRandomYear(1919);
        $this->assertHoliday(self::COUNTRY, self::HOLIDAY, $year,
            new DateTime("$year-11-11", new DateTimeZone(self::TIMEZONE)));
    }

    /**
     * Tests Veterans Day before 1919. Veterans Day was established in 1919 on November 11.
     */
    public function testVeteransDayBefore1919()
    {
        $this->assertNotHoliday(self::COUNTRY, self::HOLIDAY, $this->generateRandomYear(1000, 1918));
    }

    /**
     * Tests name of Veterans Day before 1954. Veterans Day was named 'Armistice Day' before 1954.
     */
    public function testVeteransDayNameBefore1954()
    {
        $year = $this->generateRandomYear(1919, 1953);

        $holidays = Yasumi::create(self::COUNTRY, $year);
        $holiday  = $holidays->getHoliday(self::HOLIDAY);
        $this->assertEquals('Armistice Day', $holiday->getName());
    }

    /**
     * Tests name of Veterans Day after 1954. Veterans Day was named 'Armistice Day' before 1954.
     */
    public function testVeteransDayNameAfter1954()
    {
        $year = $this->generateRandomYear(1954);

        $holidays = Yasumi::create(self::COUNTRY, $year);
        $holiday  = $holidays->getHoliday(self::HOLIDAY);
        $this->assertEquals('Veterans Day', $holiday->getName());
    }
}
