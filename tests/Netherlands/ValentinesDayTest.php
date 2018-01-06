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

namespace Yasumi\tests\Netherlands;

use DateTime;
use Yasumi\Holiday;
use Yasumi\tests\YasumiTestCaseInterface;

/**
 * Class for testing Valentines Day in the Netherlands.
 */
class ValentinesDayTest extends NetherlandsBaseTestCase implements YasumiTestCaseInterface
{
    /**
     * The name of the holiday
     */
    const HOLIDAY = 'valentinesDay';

    /**
     * Tests Valentines Day.
     *
     * @dataProvider ValentinesDayDataProvider
     *
     * @param int      $year     the year for which Valentines Day needs to be tested
     * @param DateTime $expected the expected date
     */
    public function testValentinesDay($year, $expected)
    {
        $this->assertHoliday(self::REGION, self::HOLIDAY, $year, $expected);
    }

    /**
     * Returns a list of random test dates used for assertion of Valentines Day.
     *
     * @return array list of test dates for Valentines Day
     */
    public function ValentinesDayDataProvider(): array
    {
        return $this->generateRandomDates(2, 14, self::TIMEZONE);
    }


    /**
     * Tests type of the holiday defined in this test.
     */
    public function testHolidayType()
    {
        $this->assertHolidayType(self::REGION, self::HOLIDAY, $this->generateRandomYear(), Holiday::TYPE_OTHER);
    }

    /**
     * Tests the translated name of the holiday defined in this test.
     */
    public function testTranslation()
    {
        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(),
            [self::LOCALE => 'Valentijnsdag']
        );
    }
}
