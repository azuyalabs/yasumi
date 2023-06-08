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

namespace Yasumi\tests\Russia;

use Yasumi\Holiday;
use Yasumi\Provider\Russia;
use Yasumi\tests\HolidayTestCase;

/**
 * Class containing tests for Russia day.
 *
 * @author Gedas Lukošius <gedas@lukosius.me>
 */
class RussiaDayTest extends RussiaBaseTestCase implements HolidayTestCase
{
    /**
     * The name of the holiday to be tested.
     */
    public const HOLIDAY = 'russiaDay';

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
            $this->generateRandomYear(1000, Russia::RUSSIA_DAY_START_YEAR - 1)
        );
    }

    /**
     * Test if holiday is defined after.
     *
     * @throws \Exception
     */
    public function testHolidayAfter(): void
    {
        $year = $this->generateRandomYear(Russia::RUSSIA_DAY_START_YEAR);

        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new \DateTime("$year-06-12", new \DateTimeZone(self::TIMEZONE))
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
            $this->generateRandomYear(Russia::RUSSIA_DAY_START_YEAR),
            [self::LOCALE => 'День России']
        );
        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(Russia::RUSSIA_DAY_START_YEAR),
            ['en' => 'Russia Day']
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
            $this->generateRandomYear(Russia::RUSSIA_DAY_START_YEAR),
            Holiday::TYPE_OFFICIAL
        );
    }
}
