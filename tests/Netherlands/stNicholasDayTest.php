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

namespace Yasumi\tests\Netherlands;

use DateTime;
use Yasumi\Holiday;
use Yasumi\tests\YasumiTestCaseInterface;

/**
 * Class for testing st Nicholas Day in the Netherlands.
 */
class stNicholasDayTest extends NetherlandsBaseTestCase implements YasumiTestCaseInterface
{

    /**
     * The name of the holiday
     */
    const HOLIDAY = 'stNicholasDay';

    /**
     * Tests Sint Nicholas Day.
     *
     * @dataProvider stNicholasDayDataProvider
     *
     * @param int      $year     the year for which Sint Nicholas Day needs to be tested
     * @param DateTime $expected the expected date
     */
    public function teststNicholasDay($year, $expected)
    {
        $this->assertHoliday(self::REGION, self::HOLIDAY, $year, $expected);
    }

    /**
     * Returns a list of random test dates used for assertion of Sint Nicholas Day.
     *
     * @return array list of test dates for Sint Nicholas Day
     */
    public function stNicholasDayDataProvider()
    {
        return $this->generateRandomDates(12, 5, self::TIMEZONE);
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
            [self::LOCALE => 'Sinterklaas']
        );
    }

    /**
     * Tests type of the holiday defined in this test.
     */
    public function testHolidayType()
    {
        $this->assertHolidayType(self::REGION, self::HOLIDAY, $this->generateRandomYear(), Holiday::TYPE_OBSERVANCE);
    }
}
