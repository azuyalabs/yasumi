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

namespace Yasumi\tests\Russia;

use Yasumi\Holiday;
use Yasumi\Provider\Russia;
use Yasumi\tests\YasumiTestCaseInterface;

/**
 * Class containing tests for Defence of the Fatherland day in Russia.
 *
 * @author Gedas Lukošius <gedas@lukosius.me>
 */
class DefenceOfTheFatherlandDayTest extends RussiaBaseTestCase implements YasumiTestCaseInterface
{
    /**
     * The name of the holiday to be tested
     */
    const HOLIDAY = 'defenceOfTheFatherlandDay';

    /**
     * Test if holiday is not defined before
     */
    public function testHolidayBefore()
    {
        $this->assertNotHoliday(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(1000, Russia::DEFENCE_OF_THE_FATHERLAND_START_YEAR - 1)
        );
    }

    /**
     * Test if holiday is defined after
     */
    public function testHolidayAfter()
    {
        $year = $this->generateRandomYear(Russia::DEFENCE_OF_THE_FATHERLAND_START_YEAR);

        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new \DateTime("{$year}-02-23", new \DateTimeZone(self::TIMEZONE))
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
            $this->generateRandomYear(Russia::DEFENCE_OF_THE_FATHERLAND_START_YEAR),
            [self::LOCALE => 'День защитника Отечества']
        );
        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(Russia::DEFENCE_OF_THE_FATHERLAND_START_YEAR),
            ['en_US' => 'Defence of the Fatherland Day']
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
            $this->generateRandomYear(Russia::DEFENCE_OF_THE_FATHERLAND_START_YEAR),
            Holiday::TYPE_OFFICIAL
        );
    }
}
