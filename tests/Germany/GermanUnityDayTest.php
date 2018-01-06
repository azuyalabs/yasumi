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

namespace Yasumi\tests\Germany;

use DateTime;
use DateTimeZone;
use Yasumi\Holiday;
use Yasumi\tests\YasumiTestCaseInterface;

/**
 * Class for testing the German Unity Day in Germany.
 */
class GermanUnityDayTest extends GermanyBaseTestCase implements YasumiTestCaseInterface
{
    /**
     * The year in which the holiday was first established
     */
    const ESTABLISHMENT_YEAR = 1990;

    /**
     * The name of the holiday
     */
    const HOLIDAY = 'germanUnityDay';

    /**
     * Tests the holiday defined in this test on or after establishment.
     */
    public function testHolidayOnAfterEstablishment()
    {
        $year = 2022;
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new DateTime("$year-10-3", new DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests the holiday defined in this test before establishment.
     */
    public function testHolidayBeforeEstablishment()
    {
        $this->assertNotHoliday(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(1000, self::ESTABLISHMENT_YEAR - 1)
        );
    }

    /**
     * Tests type of the holiday defined in this test.
     */
    public function testTranslation()
    {
        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(self::ESTABLISHMENT_YEAR, 2080),
            [self::LOCALE => 'Tag der Deutschen Einheit']
        );
    }

    /**
     * Tests type of the holiday defined in this test.
     */
    public function testHolidayType()
    {
        $this->assertHolidayType(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(self::ESTABLISHMENT_YEAR),
            Holiday::TYPE_OFFICIAL
        );
    }
}
