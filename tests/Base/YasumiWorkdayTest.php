<?php
/**
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 - 2017 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <stelgenhof@gmail.com>
 */

namespace Yasumi\tests;

use PHPUnit_Framework_TestCase;
use Yasumi\Yasumi;

class YasumiWorkdayTest extends PHPUnit_Framework_TestCase
{
    public function testNextWorkday()
    {
        $startDate = new \DateTime('2016-07-01', new \DateTimeZone('America/New_York'));
        $result    = Yasumi::nextWorkingDay('USA', $startDate);

        // Includes a weekend and a holiday
        $this->assertInstanceOf(\DateTime::class, $result);
        $this->assertEquals('2016-07-05', $result->format('Y-m-d'));
    }

    public function testPrevWorkday()
    {
        $startDate = new \DateTime('2016-07-05', new \DateTimeZone('America/New_York'));
        $result    = Yasumi::prevWorkingDay('USA', $startDate);

        // Includes a weekend and a holiday
        $this->assertInstanceOf(\DateTime::class, $result);
        $this->assertEquals('2016-07-01', $result->format('Y-m-d'));
    }

    public function testYearBoundary()
    {
        $startDate = new \DateTime('2015-12-20', new \DateTimeZone('America/New_York'));
        $result    = Yasumi::nextWorkingDay('USA', $startDate, 20);

        /**
         * 20 working days between 20th Dec and 20th Jan
         * 2015-12-20 is a Sunday
         * 21st - 24th (4 Workdays)
         * 25th Christmas, 26th-27th Weekend
         * 28th - 31st (4 Workdays)
         * 1st Jan New Years, 2nd-3rd Weekend
         * 4th - 8th (5 Workdays)
         * 9th-10th Weekend
         * 11th-15th (5 Workdays)
         * 16th-17th Weekend, 18th Martin Luther King Day
         * 19th-20th (2 Workdays)
         *
         * @see https://www.timeanddate.com/calendar/?year=2016&country=1
         */
        $this->assertEquals('2016-01-20', $result->format('Y-m-d'));

        $startDate = new \DateTime('2016-01-20', new \DateTimeZone('America/New_York'));
        $result    = Yasumi::prevWorkingDay('USA', $startDate, 20);
        $this->assertEquals('2015-12-18', $result->format('Y-m-d'));
    }
}
