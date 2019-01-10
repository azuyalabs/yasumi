<?php
/**
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 - 2019 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <me@sachatelgenhof.com>
 */

namespace Yasumi\tests\Australia;

use DateTime;
use DateTimeZone;
use Yasumi\Holiday;
use Yasumi\tests\YasumiTestCaseInterface;

/**
 * Class for testing Australia day in Australia.
 */
class AustraliaDayTest extends AustraliaBaseTestCase implements YasumiTestCaseInterface
{
    /**
     * The name of the holiday
     */
    public const HOLIDAY = 'australiaDay';

    /**
     * Tests Australia Day
     *
     * @dataProvider HolidayDataProvider
     *
     * @param int      $year     the year for which the holiday defined in this test needs to be tested
     * @param DateTime $expected the expected date
     *
     * @throws \ReflectionException
     * @throws \Exception
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
     * @throws \ReflectionException
     */
    public function testTranslation(): void
    {
        $this->assertTranslatedHolidayName(
            $this->region,
            self::HOLIDAY,
            $this->generateRandomYear(2000),
            [self::LOCALE => 'Australia Day']
        );
    }

    /**
     * Tests type of the holiday defined in this test.
     * @throws \ReflectionException
     */
    public function testHolidayType(): void
    {
        $this->assertHolidayType($this->region, self::HOLIDAY, $this->generateRandomYear(2000), Holiday::TYPE_OFFICIAL);
    }

    /**
     * Returns a list of test dates
     *
     * @return array list of test dates for the holiday defined in this test
     */
    public function HolidayDataProvider(): array
    {
        $data = [
            [2010, '2010-01-26'],
            [2011, '2011-01-26'],
            [2012, '2012-01-26'],
            [2013, '2013-01-28'],
            [2014, '2014-01-27'],
            [2015, '2015-01-26'],
            [2016, '2016-01-26'],
            [2017, '2017-01-26'],
            [2018, '2018-01-26'],
            [2019, '2019-01-28'],
            [2020, '2020-01-27'],
        ];

        return $data;
    }
}
