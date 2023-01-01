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
 * Class testing Respect For The Aged Day in Japan.
 */
class RespectForTheAgedDayTest extends JapanBaseTestCase implements HolidayTestCase
{
    /**
     * The name of the holiday.
     */
    public const HOLIDAY = 'respectfortheAgedDay';

    /**
     * The year in which the holiday was first established.
     */
    public const ESTABLISHMENT_YEAR = 1996;

    /**
     * Tests Respect for the Aged Day after 2003. Respect for the Aged Day was established since 1996 on September
     * 15th. After 2003 it was changed to be the third monday of September.
     *
     * @throws \Exception
     */
    public function testRespectForTheAgedDayOnAfter2003(): void
    {
        $year = $this->generateRandomYear(2004);
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new \DateTime("third monday of september $year", new \DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests Respect for the Aged Day between 1996 and 2003. Respect for the Aged Day was established since 1996 on
     * September 15th. After 2003 it was changed to be the third monday of September.
     *
     * @throws \Exception
     */
    public function testRespectForTheAgedDayBetween1996And2003(): void
    {
        $year = 1998;
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new \DateTime("$year-9-15", new \DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests Respect for the Aged Day between 1996 and 2003 substituted next working day (when Respect for the Aged Day
     * falls on a Sunday).
     *
     * @throws \Exception
     */
    public function testRespectForTheAgedDayBetween1996And2003SubstitutedNextWorkingDay(): void
    {
        $year = 2002;
        $this->assertHoliday(
            self::REGION,
            self::SUBSTITUTE_PREFIX.self::HOLIDAY,
            $year,
            new \DateTime("$year-9-16", new \DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests Respect for the Aged Day before 1996. Respect for the Aged Day was established since 1996 on September
     * 15th. After 2003 it was changed to be the third monday of September.
     *
     * @throws \Exception
     */
    public function testRespectForTheAgedDayBefore1996(): void
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
            [self::LOCALE => '敬老の日']
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
