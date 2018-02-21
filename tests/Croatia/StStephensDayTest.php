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

namespace Yasumi\tests\Croatia;

use DateTime;
use Yasumi\Holiday;
use Yasumi\tests\YasumiTestCaseInterface;

/**
 * Class for testing St. Stephen's Day in Croatia.
 */
class StStephensDayTest extends CroatiaBaseTestCase implements YasumiTestCaseInterface
{
    /**
     * The name of the holiday
     */
    const HOLIDAY = 'stStephensDay';

    /**
     * Tests the day of St. Stephen's Day.
     *
     * @dataProvider stStephensDayDataProvider
     *
     * @param int      $year     the year for which St. Stephen's Day needs to be tested
     * @param DateTime $expected the expected date
     */
    public function teststStephensDay($year, $expected)
    {
        $this->assertHoliday(self::REGION, self::HOLIDAY, $year, $expected);
    }

    /**
     * Returns a list of random test dates used for assertion of St. Stephen's Day.
     *
     * @return array list of test dates for St. Stephen's Day
     */
    public function stStephensDayDataProvider(): array
    {
        return $this->generateRandomDates(12, 26, self::TIMEZONE);
    }

    /**
     * Tests translated name of St. Stephen's Day.
     */
    public function testTranslation()
    {
        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(),
            [self::LOCALE => 'Sveti Stjepan']
        );
    }

    /**
     * Tests type of the holiday defined in this test.
     */
    public function testHolidayType()
    {
        $this->assertHolidayType(self::REGION, self::HOLIDAY, $this->generateRandomYear(), Holiday::TYPE_OFFICIAL);
    }
}
