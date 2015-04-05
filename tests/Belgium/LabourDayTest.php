<?php
/*
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Yasumi\Tests\Belgium;

use DateTime;

/**
 * Class for testing Labour Day in Belgium.
 *
 * Labour Day (Dutch: "Dag van de Arbeid", "Feest van de Arbeid"), is observed on May 1 and is an official holiday.
 */
class LabourDayTest extends BelgiumBaseTestCase
{
    /**
     * Tests Labour Day.
     *
     * @dataProvider LabourDayDataProvider
     *
     * @param int      $year     the year for which Labour Day needs to be tested
     * @param DateTime $expected the expected date
     */
    public function testLabourDay($year, $expected)
    {
        $this->assertHoliday(self::COUNTRY, 'labourDay', $year, $expected);

    }

    /**
     * Returns a list of random test dates used for assertion of Labour Day.
     *
     * @return array list of test dates for Labour Day
     */
    public function LabourDayDataProvider()
    {
        return $this->generateRandomDates(5, 1, self::TIMEZONE);
    }
}
