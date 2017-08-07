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

namespace Yasumi\tests\Netherlands;

use DateTime;
use DateTimeZone;
use Yasumi\Holiday;
use Yasumi\tests\YasumiTestCaseInterface;

/**
 * Class for testing Queen's Day in the Netherlands.
 */
class QueensDayTest extends NetherlandsBaseTestCase implements YasumiTestCaseInterface
{
    /**
     * The name of the holiday
     */
    const HOLIDAY = 'queensDay';

    /**
     * Tests Queens Day between 1891 and 1948.
     */
    public function testQueensBetween1891and1948()
    {
        $year = 1901;
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new DateTime("$year-8-31", new DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests Queens Day between 1891 and 1948 substituted one day later (when Queens Day falls on a Sunday).
     */
    public function testQueensBetween1891and1948SubstitutedLater()
    {
        $year = 1947;
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new DateTime("$year-9-1", new DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests Queens Day between 1949 and 2013.
     */
    public function testQueensBetween1949and2013()
    {
        $year = 1965;
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new DateTime("$year-4-30", new DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests Queens Day between 1949 and 2013 substituted one day later.
     */
    public function testQueensBetween1949and2013SubstitutedLater()
    {
        $year = 1967;
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new DateTime("$year-5-1", new DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests Queens Day between 1949 and 2013 substituted one day earlier.
     */
    public function testQueensBetween1949and2013SubstitutedEarlier()
    {
        $year = 2006;
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new DateTime("$year-4-29", new DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests Queen's Day before 1891.
     */
    public function testQueensDayBefore1891()
    {
        $this->assertNotHoliday(self::REGION, self::HOLIDAY, $this->generateRandomYear(1000, 1890));
    }

    /**
     * Tests Queen's Day after 2013.
     */
    public function testQueensDayAfter2013()
    {
        $this->assertNotHoliday(self::REGION, self::HOLIDAY, $this->generateRandomYear(2014));
    }

    /**
     * Tests the translated name of the holiday defined in this test.
     */
    public function testTranslation()
    {
        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(1891, 2013),
            [self::LOCALE => 'Koninginnedag']
        );
    }

    /**
     * Tests type of the holiday defined in this test.
     */
    public function testHolidayType()
    {
        $this->assertHolidayType(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(1891, 2013),
            Holiday::TYPE_NATIONAL
        );
    }
}
