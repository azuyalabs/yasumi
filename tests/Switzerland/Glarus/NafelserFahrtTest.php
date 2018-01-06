<?php
/**
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 - 2018 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <stelgenhof@gmail.com>
 */

namespace Yasumi\tests\Switzerland\Glarus;

use DateTime;
use DateTimeZone;
use Yasumi\Holiday;
use Yasumi\tests\YasumiTestCaseInterface;

/**
 * Class for testing Näfelser Fahrt in Glarus (Switzerland).
 */
class NafelserFahrtTest extends GlarusBaseTestCase implements YasumiTestCaseInterface
{
    /**
     * The name of the holiday
     */
    const HOLIDAY = 'nafelserFahrt';

    /**
     * The year in which the holiday was established
     */
    const ESTABLISHMENT_YEAR = 1389;

    /**
     * Tests Näfelser Fahrt on or after 1389
     */
    public function testNafelserFahrtOnAfter1389()
    {
        $year = $this->generateRandomYear(self::ESTABLISHMENT_YEAR);
        $date = new DateTime('First Thursday of '.$year.'-04', new DateTimeZone(self::TIMEZONE));

        $this->assertHoliday(self::REGION, self::HOLIDAY, $year, $date);
    }

    /**
     * Tests Näfelser Fahrt before 1389
     */
    public function testNafelserFahrtBefore1389()
    {
        $year = $this->generateRandomYear(1000, self::ESTABLISHMENT_YEAR - 1);
        $this->assertNotHoliday(self::REGION, self::HOLIDAY, $year);
    }

    /**
     * Tests translated name of Näfelser Fahrt.
     */
    public function testTranslation()
    {
        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(self::ESTABLISHMENT_YEAR),
            [self::LOCALE => 'Näfelser Fahrt']
        );
    }

    /**
     * Tests type of the holiday defined in this test.
     */
    public function testHolidayType()
    {
        $this->assertHolidayType(self::REGION, self::HOLIDAY, $this->generateRandomYear(self::ESTABLISHMENT_YEAR), Holiday::TYPE_OTHER);
    }
}
