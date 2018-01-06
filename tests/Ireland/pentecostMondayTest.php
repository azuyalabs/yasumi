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

namespace Yasumi\tests\Ireland;

use DateInterval;
use DateTime;
use DateTimeZone;
use Yasumi\Holiday;
use Yasumi\tests\YasumiTestCaseInterface;

/**
 * Class for testing Pentecost in Ireland.
 */
class pentecostMondayTest extends IrelandBaseTestCase implements YasumiTestCaseInterface
{
    /**
     * The name of the holiday to be tested
     */
    const HOLIDAY = 'pentecostMonday';

    /**
     * The year in which the holiday was abolished
     */
    const ABOLISHMENT_YEAR = 1973;

    /**
     * Tests the holiday defined in this test.
     *
     * @dataProvider HolidayDataProvider
     *
     * @param int      $year     the year for which the holiday defined in this test needs to be tested
     * @param DateTime $expected the expected date
     */
    public function testHoliday($year, $expected)
    {
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new DateTime($expected, new DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Returns a list of random test dates used for assertion of the holiday defined in this test
     *
     * @return array list of test dates for the holiday defined in this test
     */
    public function HolidayDataProvider()
    {
        $data = [];

        for ($y = 0; $y < self::TEST_ITERATIONS; $y++) {
            $year = $this->generateRandomYear(1000, self::ABOLISHMENT_YEAR);
            $date = $this->calculateEaster($year, self::TIMEZONE);
            $date->add(new DateInterval('P50D'));
            $data[] = [$year, $date->format('Y-m-d')];
        }

        return $data;
    }

    /**
     * Tests the holiday defined in this test after abolishment.
     */
    public function testHolidayDayAfterAbolishment()
    {
        $this->assertNotHoliday(self::REGION, self::HOLIDAY, $this->generateRandomYear(self::ABOLISHMENT_YEAR + 1));
    }

    /**
     * Tests the translated name of the holiday defined in this test.
     */
    public function testTranslation()
    {
        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(1000, self::ABOLISHMENT_YEAR),
            [self::LOCALE => 'Whitmonday']
        );
        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(1000, self::ABOLISHMENT_YEAR),
            ['ga_IE' => 'Luan Cincíse']
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
            $this->generateRandomYear(1000, self::ABOLISHMENT_YEAR),
            Holiday::TYPE_OFFICIAL
        );
    }
}
