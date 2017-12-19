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

namespace Yasumi\tests\Lithuania;

use Yasumi\Holiday;
use Yasumi\Provider\Lithuania;
use Yasumi\tests\YasumiTestCaseInterface;

/**
 * Class containing tests for Statehood Day day in Lithuania.
 *
 * @author Gedas Lukošius <gedas@lukosius.me>
 */
class StatehoodDayTest extends LithuaniaBaseTestCase implements YasumiTestCaseInterface
{
    /**
     * The name of the holiday to be tested
     */
    const HOLIDAY = 'statehoodDay';

    /**
     * Test if holiday is not defined before restoration
     */
    public function testHolidayBeforeRestoration()
    {
        $this->assertNotHoliday(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(1000, Lithuania::STATEHOOD_YEAR - 1)
        );
    }

    /**
     * Test if holiday is defined after restoration
     */
    public function testHolidayAfterRestoration()
    {
        $year = $this->generateRandomYear(Lithuania::STATEHOOD_YEAR);

        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new \DateTime("{$year}-07-06", new \DateTimeZone(self::TIMEZONE))
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
            $this->generateRandomYear(Lithuania::STATEHOOD_YEAR),
            [self::LOCALE => 'Valstybės (Lietuvos karaliaus Mindaugo karūnavimo) diena']
        );
        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(Lithuania::STATEHOOD_YEAR),
            ['en_US' => 'Statehood Day (Lithuania)']
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
            $this->generateRandomYear(Lithuania::STATEHOOD_YEAR),
            Holiday::TYPE_OFFICIAL
        );
    }
}
