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
}
