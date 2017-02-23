<?php
/**
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 - 2017 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <stelgenhof@gmail.com>
 */

namespace Yasumi\tests\Switzerland\Geneva;

use DateInterval;
use DateTime;
use DateTimeZone;
use Yasumi\Holiday;
use Yasumi\tests\YasumiTestCaseInterface;

/**
 * Class for testing Jeune Genevois in Geneva (Switzerland).
 */
class JeuneGenevoisTest extends GenevaBaseTestCase implements YasumiTestCaseInterface
{
    /**
     * The name of the holiday
     */
    const HOLIDAY = 'jeuneGenevois';

    /**
     * Tests Jeune Genevois on or after 1966
     */
    public function testJeuneGenevoisOnAfter1966()
    {
        $year = $this->generateRandomYear(1966);
        // Find first Sunday of September
        $date = new DateTime('First Sunday of '.$year.'-09', new DateTimeZone(self::TIMEZONE));
        // Go to next Thursday
        $date->add(new DateInterval('P4D'));

        $this->assertHoliday(self::REGION, self::HOLIDAY, $year, $date);
        $this->assertHolidayType(self::REGION, self::HOLIDAY, $year, Holiday::TYPE_OTHER);
    }

    /**
     * Tests Jeune Genevois between 1870 and 1965
     */
    public function testJeuneGenevoisBetween1870And1965()
    {
        $year = $this->generateRandomYear(1870, 1965);
        // Find first Sunday of September
        $date = new DateTime('First Sunday of '.$year.'-09', new DateTimeZone(self::TIMEZONE));
        // Go to next Thursday
        $date->add(new DateInterval('P4D'));

        $this->assertHoliday(self::REGION, self::HOLIDAY, $year, $date);
        $this->assertHolidayType(self::REGION, self::HOLIDAY, $year, Holiday::TYPE_OBSERVANCE);
    }

    /**
     * Tests Jeune Genevois between 1840 and 1869
     */
    public function testJeuneGenevoisBetween1840And1869()
    {
        $year = $this->generateRandomYear(1840, 1869);
        // Find first Sunday of September
        $date = new DateTime('First Sunday of '.$year.'-09', new DateTimeZone(self::TIMEZONE));
        // Go to next Thursday
        $date->add(new DateInterval('P4D'));

        $this->assertHoliday(self::REGION, self::HOLIDAY, $year, $date);
        $this->assertHolidayType(self::REGION, self::HOLIDAY, $year, Holiday::TYPE_OTHER);
    }

    /**
     * Tests Jeune Genevois before 1840
     */
    public function testJeuneGenevoisBefore1840()
    {
        $year = $this->generateRandomYear(1000, 1839);
        $this->assertNotHoliday(self::REGION, self::HOLIDAY, $year);
    }

    /**
     * Tests translated name of Jeune Genevois.
     */
    public function testTranslation()
    {
        $this->assertTranslatedHolidayName(self::REGION, self::HOLIDAY, $this->generateRandomYear(1966),
            [self::LOCALE => 'Jeûne genevois']);
    }

    /**
     * Tests type of the holiday defined in this test.
     */
    public function testHolidayType()
    {
        $this->assertHolidayType(self::REGION, self::HOLIDAY, $this->generateRandomYear(1966), Holiday::TYPE_OTHER);
    }
}
