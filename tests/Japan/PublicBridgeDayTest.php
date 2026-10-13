<?php

declare(strict_types = 1);

/**
 * This file is part of the 'Yasumi' package.
 *
 * The easy PHP Library for calculating holidays.
 *
 * Copyright (c) 2015 - 2026 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <me at sachatelgenhof dot com>
 */

namespace Yasumi\tests\Japan;

use Yasumi\Holiday;
use Yasumi\tests\HolidayTestCase;

/**
 * Class for testing public bridge days in Japan.
 */
class PublicBridgeDayTest extends JapanBaseTestCase implements HolidayTestCase
{
    /**
     * The name of the holiday.
     */
    public const HOLIDAY = 'bridgeDay';

    /**
     * @var number representing the calendar year to be tested against
     */
    private int $year;

    /**
     * Initial setup of this Test Case.
     */
    protected function setUp(): void
    {
        $this->year = 2019;
    }

    /**
     * Tests public bridge days.
     *
     * @throws \Exception
     */
    public function testPublicBridgeDay(): void
    {
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY . '1',
            $this->year,
            new \DateTime("{$this->year}-4-30", new \DateTimeZone(self::TIMEZONE))
        );
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY . '2',
            $this->year,
            new \DateTime("{$this->year}-5-2", new \DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests public bridge days sandwiched between Respect for the Aged Day and Autumnal Equinox Day.
     *
     * @param int    $year     the year for which the public bridge day needs to be tested
     * @param string $expected the expected date of the public bridge day
     *
     * @throws \Exception
     */
    #[\PHPUnit\Framework\Attributes\DataProvider('silverWeekBridgeDayDataProvider')]
    public function testSilverWeekBridgeDay(int $year, string $expected): void
    {
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY . '1',
            $year,
            new \DateTime($expected, new \DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Returns a list of years and dates in which a public bridge day falls in September.
     *
     * @return array<string, array{int, string}> list of years and expected dates
     */
    public static function silverWeekBridgeDayDataProvider(): array
    {
        return [
            '2009' => [2009, '2009-09-22'],
            '2015' => [2015, '2015-09-22'],
            '2026' => [2026, '2026-09-22'],
        ];
    }

    /**
     * Tests the translated name of the holiday defined in this test.
     *
     * @throws \Exception
     */
    public function testTranslation(): void
    {
        $this->assertTranslatedHolidayName(self::REGION, self::HOLIDAY . '1', $this->year, [self::LOCALE => '国民の休日']);
    }

    /**
     * Tests type of the holiday defined in this test.
     *
     * @throws \Exception
     */
    public function testHolidayType(): void
    {
        $this->assertHolidayType(self::REGION, self::HOLIDAY . '1', $this->year, Holiday::TYPE_OFFICIAL);
    }

    /**
     * Tests that no public bridge day is given before 1986.
     * Bridge days were introduced by the amendment of the National Holidays Act enforced on December 27th, 1985.
     *
     * @param int $year the year in which no public bridge day is expected
     *
     * @throws \Exception
     */
    #[\PHPUnit\Framework\Attributes\DataProvider('before1986DataProvider')]
    public function testNoBridgeDayBefore1986(int $year): void
    {
        $this->assertNotHoliday(self::REGION, self::HOLIDAY . '1', $year);
    }

    /**
     * Returns a list of years before 1986 in which May 4th falls between two national holidays.
     *
     * @return array<string, array{int}> list of years
     */
    public static function before1986DataProvider(): array
    {
        return [
            'May 4th, 1980 (Sunday)' => [1980],
            'May 4th, 1984 (Friday)' => [1984],
        ];
    }

    /**
     * Tests that no public bridge day is given on a Sunday before 2007.
     * Until the amendment of the National Holidays Act enforced on January 1st, 2007, Sundays were excluded.
     *
     * @param int $year the year in which May 4th falls on a Sunday
     *
     * @throws \Exception
     */
    #[\PHPUnit\Framework\Attributes\DataProvider('sundayBefore2007DataProvider')]
    public function testNoBridgeDayOnSundayBefore2007(int $year): void
    {
        $this->assertNotHoliday(self::REGION, self::HOLIDAY . '1', $year);
    }

    /**
     * Returns a list of years between 1986 and 2006 in which May 4th falls on a Sunday.
     *
     * @return array<string, array{int}> list of years
     */
    public static function sundayBefore2007DataProvider(): array
    {
        return [
            'May 4th, 1986' => [1986],
            'May 4th, 1997' => [1997],
            'May 4th, 2003' => [2003],
        ];
    }

    /**
     * Tests the first public bridge day after the amendment enforced on December 27th, 1985.
     *
     * @throws \Exception
     */
    public function testFirstBridgeDay(): void
    {
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY . '1',
            1988,
            new \DateTime('1988-05-04', new \DateTimeZone(self::TIMEZONE))
        );
    }
}
