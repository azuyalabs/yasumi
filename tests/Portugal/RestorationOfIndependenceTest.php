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
 * Class for testing Restoration of Independence Day in Portugal.
 */
class RestorationOfIndependenceTest extends PortugalBaseTestCase implements HolidayTestCase
{
    /**
     * The year in which the holiday was first established.
     */
    public const ESTABLISHMENT_YEAR = 1850;

    /**
     * Holiday was abolished by the portuguese government in 2013.
     */
    public const HOLIDAY_YEAR_ABOLISHED = 2013;

    /**
     * Holiday was restored by the portuguese government in 2016.
     */
    public const HOLIDAY_YEAR_RESTORED = 2016;

    /**
     * The name of the holiday to be tested.
     */
    public const HOLIDAY = 'restorationOfIndependence';

    /**
     * Tests the holiday defined in this test on or after establishment.
     *
     * @throws \Exception
     */
    public function testHolidayOnAfterEstablishment(): void
    {
        $year = $this->generateRandomYear(self::ESTABLISHMENT_YEAR, self::HOLIDAY_YEAR_ABOLISHED - 1);

        $expected = new \DateTime("$year-12-01", new \DateTimeZone(self::TIMEZONE));
        $this->assertHoliday(self::REGION, self::HOLIDAY, $year, $expected);

        $year = self::ESTABLISHMENT_YEAR;
        $expected = new \DateTime("$year-12-01", new \DateTimeZone(self::TIMEZONE));
        $this->assertHoliday(self::REGION, self::HOLIDAY, $year, $expected);
    }

    /**
     * Test that the holiday if in effect in 2016 and later dates.
     *
     * @throws \Exception
     * @throws \Exception
     */
    public function testHolidayOnAfterRestoration(): void
    {
        $year = 2016;

        $expected = new \DateTime("$year-12-01", new \DateTimeZone(self::TIMEZONE));
        $this->assertHoliday(self::REGION, self::HOLIDAY, $year, $expected);

        $year = $this->generateRandomYear(self::HOLIDAY_YEAR_RESTORED);

        $expected = new \DateTime("$year-12-01", new \DateTimeZone(self::TIMEZONE));
        $this->assertHoliday(self::REGION, self::HOLIDAY, $year, $expected);
    }

    /**
     * Test that the holiday did not happen in 2013-2015.
     *
     * @throws \Exception
     */
    public function testNotHolidayDuringAbolishment(): void
    {
        $year = $this->generateRandomYear(2013, 2015);
        $this->assertNotHoliday(self::REGION, self::HOLIDAY, $year);
    }

    /**
     * Tests the holiday defined in this test before establishment.
     *
     * @throws \Exception
     */
    public function testHolidayBeforeEstablishment(): void
    {
        $year = $this->generateRandomYear(1000, self::ESTABLISHMENT_YEAR - 1);
        $this->assertNotHoliday(self::REGION, self::HOLIDAY, $year);

        $year = 1849;
        $this->assertNotHoliday(self::REGION, self::HOLIDAY, $year);
    }

    /**
     * Tests the translated name of the holiday defined in this test.
     *
     * @throws \Exception
     */
    public function testTranslation(): void
    {
        $year = $this->generateRandomYear(self::ESTABLISHMENT_YEAR, self::HOLIDAY_YEAR_ABOLISHED - 1);
        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            $year,
            [self::LOCALE => 'Restauração da Independência']
        );

        $year = $this->generateRandomYear(self::HOLIDAY_YEAR_RESTORED);
        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            $year,
            [self::LOCALE => 'Restauração da Independência']
        );
    }

    /**
     * Tests type of the holiday defined in this test.
     *
     * @throws \Exception
     */
    public function testHolidayType(): void
    {
        // After establishment and before abolishment
        $year = $this->generateRandomYear(self::ESTABLISHMENT_YEAR, self::HOLIDAY_YEAR_ABOLISHED - 1);
        $this->assertHolidayType(self::REGION, self::HOLIDAY, $year, Holiday::TYPE_OFFICIAL);

        // After restoration
        $this->generateRandomYear(self::HOLIDAY_YEAR_RESTORED);
        $this->assertHolidayType(self::REGION, self::HOLIDAY, $year, Holiday::TYPE_OFFICIAL);
    }
}
