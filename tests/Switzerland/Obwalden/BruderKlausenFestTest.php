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

namespace Yasumi\tests\Switzerland\Obwalden;

use Yasumi\Holiday;
use Yasumi\tests\HolidayTestCase;

/**
 * Class for testing Bruder-Klausen-Fest in Obwalden (Switzerland).
 */
class BruderKlausenFestTest extends ObwaldenBaseTestCase implements HolidayTestCase
{
    /**
     * The name of the holiday.
     */
    public const HOLIDAY = 'bruderKlausenFest';

    /**
     * Tests Bruder-Klausen-Fest on or after 1947.
     *
     * @throws \Exception
     */
    public function testBruderKlausenFestOnAfter1947(): void
    {
        $year = $this->generateRandomYear(1947);
        $date = new \DateTime($year.'-09-25', new \DateTimeZone(self::TIMEZONE));

        $this->assertHoliday(self::REGION, self::HOLIDAY, $year, $date);
        $this->assertHolidayType(self::REGION, self::HOLIDAY, $year, Holiday::TYPE_OTHER);
    }

    /**
     * Tests Bruder-Klausen-Fest between 1649 and 1946.
     *
     * @throws \Exception
     */
    public function testBruderKlausenFestBetween1649And1946(): void
    {
        $year = $this->generateRandomYear(1649, 1946);
        $date = new \DateTime($year.'-09-21', new \DateTimeZone(self::TIMEZONE));

        $this->assertHoliday(self::REGION, self::HOLIDAY, $year, $date);
        $this->assertHolidayType(self::REGION, self::HOLIDAY, $year, Holiday::TYPE_OTHER);
    }

    /**
     * Tests Bruder-Klausen-Fest before 1648.
     *
     * @throws \Exception
     */
    public function testBruderKlausenFestBefore1648(): void
    {
        $year = $this->generateRandomYear(1000, 1648);
        $this->assertNotHoliday(self::REGION, self::HOLIDAY, $year);
    }

    /**
     * Tests translated name of Bruder-Klausen-Fest.
     *
     * @throws \Exception
     */
    public function testTranslation(): void
    {
        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(1947),
            [self::LOCALE => 'Bruder-Klausen-Fest']
        );
    }

    /**
     * Tests type of the holiday defined in this test.
     *
     * @throws \Exception
     */
    public function testHolidayType(): void
    {
        $this->assertHolidayType(self::REGION, self::HOLIDAY, $this->generateRandomYear(1947), Holiday::TYPE_OTHER);
    }
}
