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
     * Tests that no public bridge day is given in the cases excluded by the National Holidays Act.
     * Bridge days were introduced by the amendment enforced on December 27th, 1985, and until the amendment of 2007
     * a day falling on a Sunday did not become a bridge day.
     *
     * @param int $year the year in which no public bridge day is expected
     *
     * @throws \Exception
     */
    #[\PHPUnit\Framework\Attributes\DataProvider('noBridgeDayDataProvider')]
    public function testNoBridgeDay(int $year): void
    {
        $this->assertNotHoliday(self::REGION, self::HOLIDAY . '1', $year);
    }

    /**
     * Returns a list of years in which May 4th did not become a public bridge day.
     *
     * @return array<string, array{int}> list of years
     */
    public static function noBridgeDayDataProvider(): array
    {
        return [
            'before 1986, May 4th on a Sunday' => [1980],
            'before 1986, May 4th on a Friday' => [1984],
            'May 4th on a Sunday in 1986' => [1986],
            'May 4th on a Sunday in 1997' => [1997],
            'May 4th on a Sunday in 2003' => [2003],
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
