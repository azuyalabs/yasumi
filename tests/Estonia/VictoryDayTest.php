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

namespace Yasumi\tests\Estonia;

use Yasumi\Holiday;
use Yasumi\Provider\Estonia;
use Yasumi\tests\YasumiTestCaseInterface;

/**
 * Class containing tests for Estonia's Victory day.
 *
 * @author Gedas Lukošius <gedas@lukosius.me>
 */
class VictoryDayTest extends EstoniaBaseTestCase implements YasumiTestCaseInterface
{
    /**
     * The name of the holiday to be tested
     */
    const HOLIDAY = 'victoryDay';

    /**
     * Test if holiday is not defined before
     */
    public function testHolidayBefore()
    {
        $this->assertNotHoliday(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(1000, Estonia::VICTORY_DAY_START_YEAR - 1)
        );
    }

    /**
     * Test if holiday is defined after
     */
    public function testHolidayAfter()
    {
        $year = $this->generateRandomYear(Estonia::VICTORY_DAY_START_YEAR);

        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new \DateTime("{$year}-06-23", new \DateTimeZone(self::TIMEZONE))
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
            $this->generateRandomYear(Estonia::VICTORY_DAY_START_YEAR),
            [self::LOCALE => 'Võidupüha']
        );
        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(Estonia::VICTORY_DAY_START_YEAR),
            ['en_US' => 'Victory Day']
        );
    }

    /**
     * {@inheritdoc}
     */
    public function testHolidayType()
    {
        $this->assertHolidayType(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(Estonia::VICTORY_DAY_START_YEAR),
            Holiday::TYPE_OFFICIAL
        );
    }
}
