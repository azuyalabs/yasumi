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

namespace Yasumi\tests\Estonia;

use Yasumi\Holiday;
use Yasumi\tests\YasumiTestCaseInterface;

/**
 * Class containing tests for Easter day in Estonia.
 *
 * @author Gedas Lukošius <gedas@lukosius.me>
 */
class EasterDayTest extends EstoniaBaseTestCase implements YasumiTestCaseInterface
{
    /**
     * The name of the holiday to be tested
     */
    const HOLIDAY = 'easter';

    /**
     * @return array
     */
    public function holidayDataProvider()
    {
        return $this->generateRandomEasterDates(self::TIMEZONE);
    }

    /**
     * Test defined holiday in the test
     *
     * @dataProvider holidayDataProvider
     *
     * @param int    $year     the year for which the holiday defined in this test needs to be tested
     * @param string $expected the expected date
     */
    public function testHoliday($year, $expected)
    {
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new \DateTime($expected, new \DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * {@inheritdoc}
     */
    public function testTranslation()
    {
        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(),
            [self::LOCALE => 'Ülestõusmispühade 1. püha']
        );
    }

    /**
     * {@inheritdoc}
     */
    public function testHolidayType()
    {
        $this->assertHolidayType(self::REGION, self::HOLIDAY, $this->generateRandomYear(), Holiday::TYPE_OFFICIAL);
    }
}
