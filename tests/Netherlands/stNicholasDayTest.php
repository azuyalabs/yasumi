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
 * Class for testing st Nicholas Day in the Netherlands.
 */
class stNicholasDayTest extends NetherlandsBaseTestCase
{
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
        $this->assertHoliday(self::REGION, 'stNicholasDay', $year, $expected);
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
}
