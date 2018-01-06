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

namespace Yasumi\tests\Australia;

use DateTime;
use DateTimeZone;
use Yasumi\Holiday;
use Yasumi\tests\YasumiTestCaseInterface;

/**
 * Class for testing ANZAC day in Australia.
 */
class AnzacDayTest extends AustraliaBaseTestCase implements YasumiTestCaseInterface
{
    /**
     * The name of the holiday
     */
    const HOLIDAY = 'anzacDay';

    /**
     * The year in which the holiday was first established
     */
    const ESTABLISHMENT_YEAR = 1921;

    /**
     * Tests ANZAC Day
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
     *  Tests that Labour Day is not present before 1921
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
            [2010, '2010-04-26'],
            [2011, '2011-04-25'],
            [2012, '2012-04-25'],
            [2013, '2013-04-25'],
            [2014, '2014-04-25'],
            [2015, '2015-04-27'],
            [2016, '2016-04-25'],
            [2017, '2017-04-25'],
            [2018, '2018-04-25'],
            [2019, '2019-04-25'],
            [2019, '2019-04-25'],
            [2020, '2020-04-27'],
        ];

        return $data;
    }

    /**
     * Tests the translated name of the holiday defined in this test.
     */
    public function testTranslation()
    {
        $this->assertTranslatedHolidayName(
            $this->region,
            self::HOLIDAY,
            $this->generateRandomYear(self::ESTABLISHMENT_YEAR),
            [self::LOCALE => 'ANZAC Day']
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
            $this->generateRandomYear(self::ESTABLISHMENT_YEAR, 2100),
            Holiday::TYPE_OFFICIAL
        );
    }
}
