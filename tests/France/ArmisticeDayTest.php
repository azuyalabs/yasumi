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

namespace Yasumi\tests\France;

use DateTime;
use DateTimeZone;
use Yasumi\Holiday;
use Yasumi\tests\YasumiTestCaseInterface;

/**
 * Class for testing Armistice Day in France.
 */
class ArmisticeDayTest extends FranceBaseTestCase implements YasumiTestCaseInterface
{
    /**
     * The name of the holiday
     */
    const HOLIDAY = 'armisticeDay';

    /**
     * The year in which the holiday was first established
     */
    const ESTABLISHMENT_YEAR = 1919;

    /**
     * Tests Armistice Day on or after 1919.
     */
    public function testArmisticeDayOnAfter1919()
    {
        $year = $this->generateRandomYear(self::ESTABLISHMENT_YEAR);
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new DateTime("$year-11-11", new DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests Armistice Day before 1919.
     */
    public function testArmisticeDayBefore1919()
    {
        $this->assertNotHoliday(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(1000, self::ESTABLISHMENT_YEAR - 1)
        );
    }

    /**
     * Tests translated name of Armistice Day.
     */
    public function testTranslation()
    {
        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(self::ESTABLISHMENT_YEAR),
            [self::LOCALE => 'Armistice']
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
