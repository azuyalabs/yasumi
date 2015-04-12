<?php
/*
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <stelgenhof@gmail.com>
 */
namespace Yasumi\Tests\Belgium;

use DateTime;

/**
 * Class for testing Armistice Day in Belgium.
 *
 * Armistice Day is commemorated every year on 11 November to mark the armistice signed between the Allies of World War
 * I and Germany at Compiègne, France, for the cessation of hostilities on the Western Front of World War I.
 */
class ArmisticeDayTest extends BelgiumBaseTestCase
{
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
        $this->assertHoliday(self::COUNTRY, 'armisticeDay', $year, $expected);

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
}
