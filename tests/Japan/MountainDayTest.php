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
 * Class for testing Mountain Day in Japan.
 */
class MountainDayTest extends JapanBaseTestCase implements HolidayTestCase
{
    /**
     * The name of the holiday.
     */
    public const HOLIDAY = 'mountainDay';

    /**
     * The year in which the holiday was first established.
     */
    public const ESTABLISHMENT_YEAR = 2016;

    /**
     * Tests Mountain Day in 2021. Mountain Day in 2021 is August 8th for rescheduled Olympic Games after COVID-19.
     *
     * @throws \Exception
     */
    public function testMountainDayIn2021(): void
    {
        $year = 2021;
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new \DateTime("$year-8-8", new \DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests Mountain Day in 2020. Mountain Day in 2020 is August 10th for the Olympic Games.
     *
     * @throws \Exception
     */
    public function testMountainDayIn2020(): void
    {
        $year = 2020;
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new \DateTime("$year-8-10", new \DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests Mountain Day after 2016. Mountain Day was established in 2014 and is held from 2016 on August 11th.
     *
     * @throws \Exception
     */
    public function testMountainDayOnAfter2016(): void
    {
        $year = 2016;
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new \DateTime("$year-8-11", new \DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests Mountain Day after 2016 substituted next working day (when Mountain Day falls on a Sunday).
     *
     * @throws \Exception
     */
    public function testMountainDayOnAfter2016SubstitutedNextWorkingDay(): void
    {
        $year = 2019;
        $this->assertHoliday(
            self::REGION,
            self::SUBSTITUTE_PREFIX.self::HOLIDAY,
            $year,
            new \DateTime("$year-8-12", new \DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests Mountain Day before 2016. Mountain Day was established in 2014 and is held from 2016 on August 11th.
     *
     * @throws \Exception
     */
    public function testMountainDayBefore2016(): void
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
            [self::LOCALE => '山の日']
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
