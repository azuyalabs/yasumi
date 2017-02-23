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

namespace Yasumi\tests\Switzerland\StGallen;

use DateTime;
use DateTimeZone;
use Yasumi\Holiday;
use Yasumi\tests\YasumiTestCaseInterface;

/**
 * Class for testing Ascension Day in St. Gallen (Switzerland).
 */
class AscensionDayTest extends StGallenBaseTestCase implements YasumiTestCaseInterface
{
    /**
     * The name of the holiday
     */
    const HOLIDAY = 'ascensionDay';

    /**
     * Tests Ascension Day.
     */
    public function testAscensionDay()
    {
        $year = 1901;
        $this->assertHoliday(self::REGION, self::HOLIDAY, $year,
            new DateTime("$year-5-16", new DateTimeZone(self::TIMEZONE)));
    }

    /**
     * Tests translated name of Ascension Day.
     */
    public function testTranslation()
    {
        $this->assertTranslatedHolidayName(self::REGION, self::HOLIDAY, $this->generateRandomYear(),
            [self::LOCALE => 'Auffahrt']);
    }

    /**
     * Tests type of the holiday defined in this test.
     */
    public function testHolidayType()
    {
        $this->assertHolidayType(self::REGION, self::HOLIDAY, $this->generateRandomYear(), Holiday::TYPE_OTHER);
    }
}
