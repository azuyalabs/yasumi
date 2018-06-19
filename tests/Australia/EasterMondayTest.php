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
 * @author William Sanders <williamrsanders@hotmail.com>
 */

namespace Yasumi\tests\Australia;

use DateInterval;
use DateTime;
use DateTimeZone;
use Yasumi\Holiday;
use Yasumi\tests\YasumiTestCaseInterface;

/**
 * Class for testing Easter Monday in Australia.
 */
class EasterMondayTest extends AustraliaBaseTestCase implements YasumiTestCaseInterface
{
    /**
     * The name of the holiday
     */
    const HOLIDAY = 'easterMonday';
    const HOLIDAY2 = 'easterTuesday';

    /**
     * Tests Easter Monday
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
     * Tests Easter Tuesday for those years when ANZAC Day clashes with Easter Sunday or Monday
     *
     * @dataProvider HolidayDataProvider2
     *
     * @param int    $year     the year for which the holiday defined in this test needs to be tested
     * @param string $expected the expected date
     */
    public function testHoliday2($year, $expected)
    {
        $this->assertHoliday(
            $this->region,
            self::HOLIDAY2,
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
        $data = [];

        for ($y = 0; $y < 50; $y++) {
            $year = $this->generateRandomYear();
            $date = $this->calculateEaster($year, $this->timezone);
            $date->add(new DateInterval('P1D'));

            $data[] = [$year, $date->format('Y-m-d')];
        }

        return $data;
    }

    /**
     * Returns a list of test dates
     *
     * @return array list of test dates for the holiday defined in this test
     */
    public function HolidayDataProvider2()
    {
        $data = [];

        $data = [
            [2011, '2011-04-26'],
            [2038, '2038-04-27'],
            [2095, '2095-04-26'],
            [2163, '2163-04-26'],
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
            [self::LOCALE => 'Easter Monday']
        );
        $this->assertTranslatedHolidayName(
            $this->region,
            self::HOLIDAY2,
            2011,
            [self::LOCALE => 'Easter Tuesday']
        );
    }

    /**
     * Tests type of the holiday defined in this test.
     */
    public function testHolidayType()
    {
        $this->assertHolidayType($this->region, self::HOLIDAY, $this->generateRandomYear(), Holiday::TYPE_OFFICIAL);
        $this->assertHolidayType($this->region, self::HOLIDAY2, 2011, Holiday::TYPE_OFFICIAL);
    }
}
