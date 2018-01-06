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

namespace Yasumi\tests\Latvia;

use Yasumi\Holiday;
use Yasumi\tests\YasumiTestCaseInterface;

/**
 * Class containing tests for International Workers' Day in Latvia.
 *
 * @author Gedas Lukošius <gedas@lukosius.me>
 */
class InternationalWorkersDayTest extends LatviaBaseTestCase implements YasumiTestCaseInterface
{
    /**
     * The name of the holiday to be tested
     */
    const HOLIDAY = 'internationalWorkersDay';

    /**
     * @return array
     */
    public function holidayDataProvider(): array
    {
        return $this->generateRandomDates(5, 1, self::TIMEZONE);
    }

    /**
     * @dataProvider holidayDataProvider
     *
     * @param int       $year
     * @param \DateTime $expected
     */
    public function testHoliday($year, \DateTime $expected)
    {
        $this->assertHoliday(self::REGION, self::HOLIDAY, $year, $expected);
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
            [self::LOCALE => 'Darba svētki']
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
