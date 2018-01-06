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


namespace Yasumi\tests\Slovakia;

use DateTime;
use Yasumi\Holiday;
use Yasumi\tests\YasumiTestCaseInterface;

/**
 * Class for testing Second Christmas day in Slovakia.
 *
 *
 * @package Yasumi\tests\Slovakia
 * @author  Andrej Rypak (dakujem) <xrypak@gmail.com>
 */
class SecondChristmasDayTest extends SlovakiaBaseTestCase implements YasumiTestCaseInterface
{
    /**
     * The name of the holiday
     */
    const HOLIDAY = 'secondChristmasDay';


    /**
     * Tests the holiday defined in this test.
     *
     * @dataProvider HolidayDataProvider
     *
     * @param int      $year     the year for which Christmas Day needs to be tested
     * @param DateTime $expected the expected date
     */
    public function testHoliday($year, $expected)
    {
        $this->assertHoliday(self::REGION, self::HOLIDAY, $year, $expected);
    }


    /**
     * Returns a list of random test dates used for assertion of the holiday defined in this test
     *
     * @return array list of test dates for the holiday defined in this test
     */
    public function HolidayDataProvider(): array
    {
        return $this->generateRandomDates(12, 26, self::TIMEZONE);
    }


    /**
     * Tests translated name of Second Christmas Day.
     */
    public function testTranslation()
    {
        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(),
            [self::LOCALE => 'Druhý sviatok vianočný']
        );
    }


    /**
     * Tests type of the holiday defined in this test.
     */
    public function testHolidayType()
    {
        $this->assertHolidayType(self::REGION, self::HOLIDAY, $this->generateRandomYear(), Holiday::TYPE_BANK);
    }
}
