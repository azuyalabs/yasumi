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
 * Class for testing Christmas Day in the Australia.
 */
class ChristmasDayTest extends AustraliaBaseTestCase implements YasumiTestCaseInterface
{
    /**
     * The name of the holiday
     */
    const HOLIDAY = 'christmasDay';

    /**
     * Tests Christmas Day
     *
     * @dataProvider HolidayDataProvider
     *
     * @param int    $year     the year for which the holiday defined in this test needs to be tested
     * @param string $expected the expected date
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
     * Returns a list of test dates
     *
     * @return array list of test dates for the holiday defined in this test
     */
    public function HolidayDataProvider()
    {
        $data = [
            [2010, '2010-12-27'],
            [2011, '2011-12-27'],
            [2012, '2012-12-25'],
            [2013, '2013-12-25'],
            [2014, '2014-12-25'],
            [2015, '2015-12-25'],
            [2016, '2016-12-27'],
            [2017, '2017-12-25'],
            [2018, '2018-12-25'],
            [2019, '2019-12-25'],
            [2020, '2020-12-25'],
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
            $this->generateRandomYear(),
            [self::LOCALE => 'Christmas Day']
        );
    }

    /**
     * Tests type of the holiday defined in this test.
     */
    public function testHolidayType()
    {
        $this->assertHolidayType($this->region, self::HOLIDAY, $this->generateRandomYear(), Holiday::TYPE_OFFICIAL);
    }
}
