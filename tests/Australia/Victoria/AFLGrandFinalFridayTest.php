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

namespace Yasumi\tests\Australia\Victoria;

use DateTime;
use DateTimeZone;
use Yasumi\Holiday;
use Yasumi\tests\YasumiTestCaseInterface;

/**
 * Class for testing AFL Grand Final Friday in Victoria (Australia)..
 */
class AFLGrandFinalFridayTest extends VictoriaBaseTestCase implements YasumiTestCaseInterface
{
    /**
     * The name of the holiday
     */
    const HOLIDAY = 'aflGrandFinalFriday';

    const ESTABLISHMENT_YEAR = 2015;
    const LAST_KNOWN_YEAR = 2016;

    /**
     * Tests AFL Grand Final Friday
     *
     * @dataProvider HolidayDataProvider
     *
     * @param int      $year     the year for which the holiday defined in this test needs to be tested
     * @param DateTime $expected the expected date
     */
    public function testHoliday($year, $expected)
    {
        $this->assertHoliday(
            $this->region,
            self::HOLIDAY,
            $year,
            new DateTime($expected, new DateTimeZone($this->timezone))
        );
    }


    /**
     * Tests the translated name of the holiday defined in this test.
     */
    public function testTranslation()
    {
        $this->assertTranslatedHolidayName(
            $this->region,
            self::HOLIDAY,
            $this->generateRandomYear(self::ESTABLISHMENT_YEAR, self::LAST_KNOWN_YEAR),
            [self::LOCALE => 'AFL Grand Final Friday']
        );
    }

    /**
     * Tests type of the holiday defined in this test.
     */
    public function testHolidayType()
    {
        $this->assertHolidayType(
            $this->region,
            self::HOLIDAY,
            $this->generateRandomYear(self::ESTABLISHMENT_YEAR, self::LAST_KNOWN_YEAR),
            Holiday::TYPE_NATIONAL
        );
    }

    /**
     *  Tests that Holiday is not present before establishment year
     */
    public function testNotHoliday()
    {
        $this->assertNotHoliday($this->region, self::HOLIDAY, self::ESTABLISHMENT_YEAR - 1);
    }

    /**
     * Returns a list of test dates
     *
     * @return array list of test dates for the holiday defined in this test
     */
    public function HolidayDataProvider()
    {
        $data = [
            [2015, '2015-10-02'],
            [2016, '2016-09-30'],
        ];

        return $data;
    }
}
