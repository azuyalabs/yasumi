<?php
/**
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 - 2018 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author William Sanders <williamrsanders@hotmail.com>
 */

namespace Yasumi\tests\Australia\Tasmania\Northwest\CircularHead;

use DateTime;
use DateTimeZone;
use Yasumi\Holiday;
use Yasumi\tests\YasumiTestCaseInterface;

/**
 * Class for testing AGFEST in northwestern Tasmania (Australia)..
 */
class AGFESTTest extends CircularHeadBaseTestCase implements YasumiTestCaseInterface
{
    /**
     * The name of the holiday
     */
    const HOLIDAY = 'agfest';

    /**
     * Tests AGFEST
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
            [2010, '2010-05-07'],
            [2011, '2011-05-06'],
            [2012, '2012-05-04'],
            [2013, '2013-05-03'],
            [2014, '2014-05-02'],
            [2015, '2015-05-08'],
            [2016, '2016-05-06'],
            [2017, '2017-05-05'],
            [2018, '2018-05-04'],
            [2019, '2019-05-03'],
            [2020, '2020-05-08'],
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
            $this->generateRandomYear(1990),
            [self::LOCALE => 'AGFEST']
        );
    }

    /**
     * Tests type of the holiday defined in this test.
     */
    public function testHolidayType()
    {
        $this->assertHolidayType($this->region, self::HOLIDAY, $this->generateRandomYear(1990), Holiday::TYPE_OFFICIAL);
    }
}
