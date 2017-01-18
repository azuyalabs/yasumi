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

namespace Yasumi\tests\Brazil;

use DateTime;
use DateTimeZone;
use Yasumi\Holiday;
use Yasumi\tests\YasumiTestCaseInterface;

/**
 * Class for testing Christmas Day in Brazil.
 */
class ChristmasDayTest extends BrazilBaseTestCase implements YasumiTestCaseInterface
{
    /**
     * The name of the holiday
     */
    const HOLIDAY = 'christmasDay';

    /**
     * Tests Christmas Day.
     */
    public function testChristmasDay()
    {
        $year = 1897;
        $this->assertHoliday(self::REGION, self::HOLIDAY, $year,
            new DateTime("$year-12-25", new DateTimeZone(self::TIMEZONE)));
    }

    /**
     * Tests translated name of the holiday defined in this test.
     */
    public function testTranslation()
    {
        $this->assertTranslatedHolidayName(self::REGION, self::HOLIDAY, $this->generateRandomYear(),
            [self::LOCALE => 'Natal']);
    }

    /**
     * Tests type of the holiday defined in this test.
     */
    public function testHolidayType()
    {
        $this->assertHolidayType(self::REGION, self::HOLIDAY, $this->generateRandomYear(), Holiday::TYPE_NATIONAL);
    }
}
