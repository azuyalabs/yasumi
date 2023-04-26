<?php

declare(strict_types=1);

/*
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 - 2023 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <me at sachatelgenhof dot com>
 */

namespace Yasumi\tests\Estonia;

use Yasumi\Holiday;
use Yasumi\Provider\Estonia;
use Yasumi\tests\HolidayTestCase;

/**
 * Class containing tests for Estonia's Restoration of Independence day.
 *
 * @author Gedas Lukošius <gedas@lukosius.me>
 */
class RestorationOfIndependenceDayTest extends EstoniaBaseTestCase implements HolidayTestCase
{
    /**
     * The name of the holiday to be tested.
     */
    public const HOLIDAY = 'restorationOfIndependenceDay';

    /**
     * Test if holiday is not defined before.
     *
     * @throws \Exception
     */
    public function testHolidayBefore(): void
    {
        $this->assertNotHoliday(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(1000, Estonia::RESTORATION_OF_INDEPENDENCE_YEAR - 1)
        );
    }

    /**
     * Test if holiday is defined after.
     *
     * @throws \Exception
     */
    public function testHolidayAfter(): void
    {
        $year = $this->generateRandomYear(Estonia::RESTORATION_OF_INDEPENDENCE_YEAR);

        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new \DateTime("$year-08-20", new \DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * @throws \Exception
     */
    public function testTranslation(): void
    {
        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(Estonia::RESTORATION_OF_INDEPENDENCE_YEAR),
            [self::LOCALE => 'Taasiseseisvumispäev']
        );
        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(Estonia::RESTORATION_OF_INDEPENDENCE_YEAR),
            ['en' => 'Day of Restoration of Independence']
        );
    }

    /**
     * @throws \Exception
     */
    public function testHolidayType(): void
    {
        $this->assertHolidayType(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(Estonia::RESTORATION_OF_INDEPENDENCE_YEAR),
            Holiday::TYPE_OFFICIAL
        );
    }
}
