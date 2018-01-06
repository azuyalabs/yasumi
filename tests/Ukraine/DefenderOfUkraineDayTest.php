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

namespace Yasumi\tests\Ukraine;

use Yasumi\Holiday;
use Yasumi\tests\YasumiTestCaseInterface;

/**
 * Class DefenderOfUkraineDayTest
 * @package Yasumi\tests\Ukraine
 */
class DefenderOfUkraineDayTest extends UkraineBaseTestCase implements YasumiTestCaseInterface
{
    /**
     * The name of the holiday to be tested
     */
    const HOLIDAY = 'defenderOfUkraineDay';

    public function testHoliday()
    {
        $year = 2020;
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new \DateTime("$year-10-14", new \DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests the translated name of the holiday defined in this test.
     */
    public function testTranslation()
    {
        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            2020,
            [self::LOCALE => 'День захисника України']
        );
    }

    /**
     * Tests type of the holiday defined in this test.
     */
    public function testHolidayType()
    {
        $this->assertHolidayType(self::REGION, self::HOLIDAY, 2020, Holiday::TYPE_OFFICIAL);
    }
}
