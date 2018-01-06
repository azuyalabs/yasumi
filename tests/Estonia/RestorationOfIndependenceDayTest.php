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
use Yasumi\Provider\Estonia;
use Yasumi\tests\YasumiTestCaseInterface;

/**
 * Class containing tests for Estonia's Restoration of Independence day.
 *
 * @author Gedas Lukošius <gedas@lukosius.me>
 */
class RestorationOfIndependenceDayTest extends EstoniaBaseTestCase implements YasumiTestCaseInterface
{
    /**
     * The name of the holiday to be tested
     */
    const HOLIDAY = 'restorationOfIndependenceDay';

    /**
     * Test if holiday is not defined before
     */
    public function testHolidayBefore()
    {
        $this->assertNotHoliday(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(1000, Estonia::RESTORATION_OF_INDEPENDENCE_YEAR - 1)
        );
    }

    /**
     * Test if holiday is defined after
     */
    public function testHolidayAfter()
    {
        $year = $this->generateRandomYear(Estonia::RESTORATION_OF_INDEPENDENCE_YEAR);

        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new \DateTime("{$year}-08-20", new \DateTimeZone(self::TIMEZONE))
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
            $this->generateRandomYear(Estonia::RESTORATION_OF_INDEPENDENCE_YEAR),
            [self::LOCALE => 'Tasiseseisvumispäev']
        );
        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(Estonia::RESTORATION_OF_INDEPENDENCE_YEAR),
            ['en_US' => 'Day of Restoration of Independence']
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
            $this->generateRandomYear(Estonia::RESTORATION_OF_INDEPENDENCE_YEAR),
            Holiday::TYPE_OFFICIAL
        );
    }
}
