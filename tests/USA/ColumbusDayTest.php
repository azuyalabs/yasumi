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

namespace Yasumi\tests\USA;

use DateTime;
use DateTimeZone;
use Yasumi\Holiday;
use Yasumi\tests\YasumiTestCaseInterface;

/**
 * Class for testing Columbus Day in the USA.
 */
class ColumbusDayTest extends USABaseTestCase implements YasumiTestCaseInterface
{
    /**
     * The name of the holiday
     */
    const HOLIDAY = 'columbusDay';

    /**
     * The year in which the holiday was first established
     */
    const ESTABLISHMENT_YEAR = 1937;

    /**
     * Tests Columbus Day on or after 1970. Columbus Day was established in 1937 on October 12th, but has been fixed to
     * the second Monday in October since 1970.
     */
    public function testColumbusDayOnAfter1970()
    {
        $year = $this->generateRandomYear(1970);
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new DateTime("second monday of october $year", new DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests Columbus Day between 1937 and 1969. Columbus Day was established in 1937 on October 12th, but has been
     * fixed to the second Monday in October since 1970.
     */
    public function testColumbusBetween1937And1969()
    {
        $year = $this->generateRandomYear(self::ESTABLISHMENT_YEAR, 1969);
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new DateTime("$year-10-12", new DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests Columbus Day before 1937. Columbus Day was established in 1937 on October 12th, but has been fixed to
     * the second Monday in October since 1970.
     */
    public function testColumbusDayBefore1937()
    {
        $this->assertNotHoliday(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(1000, self::ESTABLISHMENT_YEAR - 1)
        );
    }

    /**
     * Tests translated name of the holiday defined in this test.
     */
    public function testTranslation()
    {
        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(self::ESTABLISHMENT_YEAR),
            [self::LOCALE => 'Columbus Day']
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
