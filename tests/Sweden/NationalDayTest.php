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

namespace Yasumi\tests\Sweden;

use DateTime;
use DateTimeZone;
use Yasumi\Holiday;
use Yasumi\tests\YasumiTestCaseInterface;

/**
 * Class for testing the National Day of Sweden in Sweden.
 */
class NationalDayTest extends SwedenBaseTestCase implements YasumiTestCaseInterface
{
    /**
     * The year in which the holiday was first established
     */
    const ESTABLISHMENT_YEAR = 1916;

    /**
     * The name of the holiday
     */
    const HOLIDAY = 'nationalDay';

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
            new DateTime("$year-6-6", new DateTimeZone(self::TIMEZONE))
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
     * Tests the translated name of the holiday defined in this test on or after establishment.
     */
    public function testTranslation()
    {
        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(self::ESTABLISHMENT_YEAR, 1982),
            [self::LOCALE => 'Svenska flaggans dag']
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

    /**
     * Tests the translated name of the holiday defined in this test on or after establishment.
     */
    public function testTranslationOnAfterNameChange()
    {
        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(1983),
            [self::LOCALE => 'Sveriges nationaldag']
        );
    }
}
