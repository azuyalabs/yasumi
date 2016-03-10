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

namespace Yasumi\Tests\Netherlands;

use DateTime;

/**
 * Class for testing Valentines Day in the Netherlands.
 */
class ValentinesDayTest extends NetherlandsBaseTestCase
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
        $this->assertHoliday(self::COUNTRY, self::HOLIDAY, $year, $expected);
    }

    /**
     * Returns a list of random test dates used for assertion of Valentines Day.
     *
     * @return array list of test dates for Valentines Day
     */
    public function ValentinesDayDataProvider()
    {
        return $this->generateRandomDates(2, 14, self::TIMEZONE);
    }

    /**
     * Tests translated name of Valentines Day.
     */
    public function testTranslation()
    {
        $this->assertTranslatedHolidayName(self::COUNTRY, self::HOLIDAY, $this->generateRandomYear(),
            ['nl_NL' => 'Valentijnsdag',]);
    }
}
