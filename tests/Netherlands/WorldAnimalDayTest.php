<?php
/*
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
use Yasumi\Tests\Netherlands\NetherlandsBaseTestCase;

/**
 * Class WorldAnimalDayTest.
 */
class WorldAnimalDayTest extends NetherlandsBaseTestCase
{
    /**
     * Tests World Animal Day.
     *
     * @dataProvider WorldAnimalDayDataProvider
     *
     * @param int           $year     the year for which World Animal Day needs to be tested
     * @param Carbon\Carbon $expected the expected date
     */
    public function testWorldAnimalDay($year, $expected)
    {
        $this->assertHoliday(self::COUNTRY, 'worldAnimalDay', $year, $expected);

    }

    /**
     * Returns a list of random test dates used for assertion of World Animal Day.
     *
     * @return array list of test dates for World Animal Day
     */
    public function WorldAnimalDayDataProvider()
    {
        return $this->generateRandomDates(10, 4);
    }
}
