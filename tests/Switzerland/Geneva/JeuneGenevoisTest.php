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

namespace Yasumi\tests\Switzerland\Geneva;

use Yasumi\Holiday;
use Yasumi\Provider\Switzerland\Geneva;
use Yasumi\tests\HolidayTestCase;

/**
 * Class for testing Jeune Genevois in Geneva (Switzerland).
 */
class JeuneGenevoisTest extends GenevaBaseTestCase implements HolidayTestCase
{
    /**
     * The name of the holiday.
     */
    public const HOLIDAY = 'jeuneGenevois';

    /**
     * Tests Jeune Genevois between 1870 and 1965.
     *
     * @throws \Exception
     */
    public function testJeuneGenevoisBetween1870And1965(): void
    {
        $year = $this->generateRandomYear(1870, 1965);
        // Find first Sunday of September
        $date = new \DateTime('First Sunday of '.$year.'-09', new \DateTimeZone(self::TIMEZONE));
        // Go to next Thursday
        $date->add(new \DateInterval('P4D'));

        $this->assertHoliday(self::REGION, self::HOLIDAY, $year, $date);
        $this->assertHolidayType(self::REGION, self::HOLIDAY, $year, Holiday::TYPE_OBSERVANCE);
    }

    /**
     * Tests Jeune Genevois between 1840 and 1869.
     *
     * @throws \Exception
     */
    public function testJeuneGenevoisBetween1840And1869(): void
    {
        $year = $this->generateRandomYear(Geneva::JEUNE_GENEVOIS_ESTABLISHMENT_YEAR, 1869);
        // Find first Sunday of September
        $date = new \DateTime('First Sunday of '.$year.'-09', new \DateTimeZone(self::TIMEZONE));
        // Go to next Thursday
        $date->add(new \DateInterval('P4D'));

        $this->assertHoliday(self::REGION, self::HOLIDAY, $year, $date);
        $this->assertHolidayType(self::REGION, self::HOLIDAY, $year, Holiday::TYPE_OTHER);
    }

    /**
     * Tests Jeune Genevois before 1840.
     *
     * @throws \Exception
     */
    public function testJeuneGenevoisBefore1840(): void
    {
        $year = $this->generateRandomYear(1000, Geneva::JEUNE_GENEVOIS_ESTABLISHMENT_YEAR - 1);
        $this->assertNotHoliday(self::REGION, self::HOLIDAY, $year);
    }

    /**
     * Tests translated name of Jeune Genevois.
     *
     * @throws \Exception
     */
    public function testTranslation(): void
    {
        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(1966),
            [self::LOCALE => 'Jeûne genevois']
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
            $this->generateRandomYear(1966),
            Holiday::TYPE_OTHER
        );
    }
}
