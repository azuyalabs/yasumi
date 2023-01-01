<?php

declare(strict_types=1);
/*
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 - 2023 AzuyaLabs
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
 * Class for testing Coming Of Age Day in Japan.
 */
class ComingOfAgeDayTest extends JapanBaseTestCase implements HolidayTestCase
{
    /**
     * The name of the holiday.
     */
    public const HOLIDAY = 'comingOfAgeDay';

    /**
     * The year in which the holiday was first established.
     */
    public const ESTABLISHMENT_YEAR = 1948;

    /**
     * Tests Coming of Age Day after 2000. Coming of Age Day was established after 1948 on January 15th. After 2000 it
     * was changed to be the second monday of January.
     *
     * @throws \Exception
     */
    public function testComingOfAgeDayOnAfter2000(): void
    {
        $year = $this->generateRandomYear(2001);
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new \DateTime("second monday of january $year", new \DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests Coming of Age Day between 1948 and 2000. Coming of Age Day was established after 1948 on January 15th.
     * After 2000 it was changed to be the second monday of January.
     *
     * @throws \Exception
     */
    public function testComingOfAgeDayBetween1948And2000(): void
    {
        $year = 1991;
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new \DateTime("$year-1-15", new \DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests Coming of Age Day before 1948. Coming of Age Day was established after 1948 on January 15th. After 2000 it
     * was changed to be the second monday of January.
     *
     * @throws \Exception
     */
    public function testConstitutionMemorialDayBefore1948(): void
    {
        $this->assertNotHoliday(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(1000, self::ESTABLISHMENT_YEAR - 1)
        );
    }

    /**
     * Tests the translated name of the holiday defined in this test.
     *
     * @throws \Exception
     */
    public function testTranslation(): void
    {
        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(self::ESTABLISHMENT_YEAR),
            [self::LOCALE => '成人の日']
        );
    }

    /**
     * Tests type of the holiday defined in this test.
     *
     * @throws \Exception
     */
    public function testHolidayType(): void
    {
        $this->assertHolidayType(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(self::ESTABLISHMENT_YEAR),
            Holiday::TYPE_OFFICIAL
        );
    }
}
