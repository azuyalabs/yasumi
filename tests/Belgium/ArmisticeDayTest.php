<?php
/**
 *  This file is part of the Yasumi package.
 *
 *  Copyright (c) 2015 - 2016 AzuyaLabs
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 *
 *  @author Sacha Telgenhof <stelgenhof@gmail.com>
 */
namespace Yasumi\Tests\Belgium;

use DateTime;

/**
 * Class for testing Armistice Day in Belgium.
 */
class ArmisticeDayTest extends BelgiumBaseTestCase
{
    /**
     * The name of the holiday to be tested
     */
    const HOLIDAY = 'armisticeDay';

    /**
     * Tests Armistice Day.
     *
     * @dataProvider ArmisticeDayDataProvider
     *
     * @param int      $year     the year for which Armistice Day needs to be tested
     * @param DateTime $expected the expected date
     */
    public function testArmisticeDay($year, $expected)
    {
        $this->assertHoliday(self::REGION, self::HOLIDAY, $year, $expected);
    }

    /**
     * Returns a list of random test dates used for assertion of Armistice Day.
     *
     * @return array list of test dates for Armistice Day
     */
    public function ArmisticeDayDataProvider()
    {
        return $this->generateRandomDates(11, 11, self::TIMEZONE);
    }

    /**
     * Tests translated name of Armistice Day
     */
    public function testTranslation()
    {
        $this->assertTranslatedHolidayName(self::REGION, self::HOLIDAY, $this->generateRandomYear(),
            ['nl_BE' => 'Wapenstilstand']);
    }
}
