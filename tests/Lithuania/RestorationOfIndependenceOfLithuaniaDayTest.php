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
 * Class containing tests for Restoration of Independence of Lithuania day.
 *
 * @author Gedas Lukošius <gedas@lukosius.me>
 */
class RestorationOfIndependenceOfLithuaniaDayTest extends LithuaniaBaseTestCase implements YasumiTestCaseInterface
{
    /**
     * The name of the holiday to be tested
     */
    const HOLIDAY = 'restorationOfIndependenceOfLithuaniaDay';

    /**
     * Test if holiday is not defined before restoration
     */
    public function testHolidayBeforeRestoration()
    {
        $this->assertNotHoliday(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(1000, Lithuania::RESTORATION_OF_INDEPENDENCE_YEAR - 1)
        );
    }

    /**
     * Test if holiday is defined after restoration
     */
    public function testHolidayAfterRestoration()
    {
        $year = $this->generateRandomYear(Lithuania::RESTORATION_OF_INDEPENDENCE_YEAR);

        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new \DateTime("{$year}-03-11", new \DateTimeZone(self::TIMEZONE))
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
            $this->generateRandomYear(Lithuania::RESTORATION_OF_INDEPENDENCE_YEAR),
            [self::LOCALE => 'Lietuvos nepriklausomybės atkūrimo diena']
        );
        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(Lithuania::RESTORATION_OF_INDEPENDENCE_YEAR),
            ['en_US' => 'Day of Restoration of Independence of Lithuania']
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
            $this->generateRandomYear(Lithuania::RESTORATION_OF_INDEPENDENCE_YEAR),
            Holiday::TYPE_OFFICIAL
        );
    }
}
