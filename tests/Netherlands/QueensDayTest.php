<?php declare(strict_types=1);
/**
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 - 2020 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <me@sachatelgenhof.com>
 */

namespace Yasumi\tests\Netherlands;

use DateTime;
use DateTimeZone;
use Exception;
use ReflectionException;
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
    public const HOLIDAY = 'queensDay';

    /**
     * Tests Queens Day between 1891 and 1948.
     * @throws Exception
     * @throws ReflectionException
     */
    public function testQueensBetween1891and1948(): void
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
     * @throws Exception
     * @throws ReflectionException
     */
    public function testQueensBetween1891and1948SubstitutedLater(): void
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
     * @throws Exception
     * @throws ReflectionException
     */
    public function testQueensBetween1949and2013(): void
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
     * @throws Exception
     * @throws ReflectionException
     */
    public function testQueensBetween1949and2013SubstitutedLater(): void
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
     * @throws Exception
     * @throws ReflectionException
     */
    public function testQueensBetween1949and2013SubstitutedEarlier(): void
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
     * @throws ReflectionException
     */
    public function testQueensDayBefore1891(): void
    {
        $this->assertNotHoliday(self::REGION, self::HOLIDAY, $this->generateRandomYear(1000, 1890));
    }

    /**
     * Tests Queen's Day after 2013.
     * @throws ReflectionException
     */
    public function testQueensDayAfter2013(): void
    {
        $this->assertNotHoliday(self::REGION, self::HOLIDAY, $this->generateRandomYear(2014));
    }

    /**
     * Tests the translated name of the holiday defined in this test.
     * @throws ReflectionException
     */
    public function testTranslation(): void
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
     * @throws ReflectionException
     */
    public function testHolidayType(): void
    {
        $this->assertHolidayType(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(1891, 2013),
            Holiday::TYPE_OFFICIAL
        );
    }
}
