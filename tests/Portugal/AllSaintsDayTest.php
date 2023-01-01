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

namespace Yasumi\tests\Portugal;

use Yasumi\Holiday;
use Yasumi\tests\HolidayTestCase;

/**
 * Class containing tests for All Saints Day in Portugal.
 */
class AllSaintsDayTest extends PortugalBaseTestCase implements HolidayTestCase
{
    /**
     * The name of the holiday.
     */
    public const HOLIDAY = 'allSaintsDay';

    /**
     * Holiday was abolished by the portuguese government in 2013.
     */
    public const HOLIDAY_YEAR_ABOLISHED = 2013;

    /**
     * Holiday was restored by the portuguese government in 2016.
     */
    public const HOLIDAY_YEAR_RESTORED = 2016;

    /**
     * Tests the holiday defined in this test.
     *
     * @throws \Exception
     */
    public function testHoliday(): void
    {
        $year = 2016;
        $expected = new \DateTime("$year-11-01", new \DateTimeZone(self::TIMEZONE));
        $this->assertHoliday(self::REGION, self::HOLIDAY, $year, $expected);

        $year = 2012;
        $expected = new \DateTime("$year-11-01", new \DateTimeZone(self::TIMEZONE));
        $this->assertHoliday(self::REGION, self::HOLIDAY, $year, $expected);
    }

    /**
     * Test that the holiday did not happen in 2013-2015.
     *
     * @throws \Exception
     */
    public function testNotHoliday(): void
    {
        $year = $this->generateRandomYear(2013, 2015);
        $this->assertNotHoliday(self::REGION, self::HOLIDAY, $year);
    }

    /**
     * Tests translated name of Corpus Christi.
     *
     * @throws \Exception
     */
    public function testTranslation(): void
    {
        $year = $this->generateRandomYear(self::HOLIDAY_YEAR_RESTORED);
        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            $year,
            [self::LOCALE => 'Dia de todos os Santos']
        );
    }

    /**
     * Tests type of the holiday defined in this test.
     *
     * @throws \Exception
     */
    public function testHolidayType(): void
    {
        // After restoration
        $year = $this->generateRandomYear(self::HOLIDAY_YEAR_RESTORED);
        $this->assertHolidayType(self::REGION, self::HOLIDAY, $year, Holiday::TYPE_OFFICIAL);

        // Before abolishment
        $year = $this->generateRandomYear(1000, self::HOLIDAY_YEAR_ABOLISHED - 1);
        $this->assertHolidayType(self::REGION, self::HOLIDAY, $year, Holiday::TYPE_OFFICIAL);
    }
}
