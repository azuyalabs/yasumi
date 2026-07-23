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

namespace Yasumi\tests\Colombia;

use Yasumi\Holiday;
use Yasumi\Provider\ChristianHolidays;
use Yasumi\tests\HolidayTestCase;

/**
 * Class for testing Corpus Christi in Colombia.
 *
 * The canonical date is Easter + 60 days (Thursday). Under the Emiliani rule
 * it is always moved to the following Monday.
 *
 * 2025: Easter = 20 Apr → canonical = 19 Jun (Thursday) → observed = 23 Jun (Monday).
 */
class CorpusChristiTest extends ColombiaBaseTestCase implements HolidayTestCase
{
    use ChristianHolidays;

    public const HOLIDAY = 'corpusChristi';

    /** @throws \Exception */
    public function testHoliday(): void
    {
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            2025,
            new \DateTime('2025-06-23', new \DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests that Corpus Christi always falls on a Monday in Colombia.
     *
     * @throws \Exception
     */
    public function testCorpusChristiAlwaysFallsOnMonday(): void
    {
        foreach (range(2020, 2030) as $year) {
            $holidays = \Yasumi\Yasumi::create(self::REGION, $year, self::LOCALE);
            $holiday = $holidays->getHoliday(self::HOLIDAY);
            $this->assertNotNull($holiday, "Corpus Christi not found for year {$year}");
            $this->assertSame('1', $holiday->format('w'), "Corpus Christi is not a Monday in {$year}: " . $holiday->format('Y-m-d'));
        }
    }

    /** @throws \Exception */
    public function testTranslation(): void
    {
        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            static::generateRandomYear(),
            [self::LOCALE => 'Corpus Christi']
        );
    }

    /** @throws \Exception */
    public function testHolidayType(): void
    {
        $this->assertHolidayType(self::REGION, self::HOLIDAY, static::generateRandomYear(), Holiday::TYPE_OFFICIAL);
    }
}
