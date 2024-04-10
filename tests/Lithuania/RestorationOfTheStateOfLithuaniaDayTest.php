<?php

declare(strict_types = 1);

/**
 * This file is part of the 'Yasumi' package.
 *
 * The easy PHP Library for calculating holidays.
 *
 * Copyright (c) 2015 - 2024 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <me at sachatelgenhof dot com>
 */

namespace Yasumi\tests\Lithuania;

use Yasumi\Holiday;
use Yasumi\Provider\Lithuania;
use Yasumi\tests\HolidayTestCase;

/**
 * Class containing tests for Restoration of the State of Lithuania day.
 *
 * @author Gedas Lukošius <gedas@lukosius.me>
 */
class RestorationOfTheStateOfLithuaniaDayTest extends LithuaniaBaseTestCase implements HolidayTestCase
{
    /**
     * The name of the holiday to be tested.
     */
    public const HOLIDAY = 'restorationOfTheStateOfLithuaniaDay';

    /**
     * Test if holiday is not defined before restoration.
     *
     * @throws \Exception
     */
    public function testHolidayBeforeRestoration(): void
    {
        $this->assertNotHoliday(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(1000, Lithuania::RESTORATION_OF_THE_STATE_YEAR - 1)
        );
    }

    /**
     * Test if holiday is defined after restoration.
     *
     * @throws \Exception
     */
    public function testHolidayAfterRestoration(): void
    {
        $year = $this->generateRandomYear(Lithuania::RESTORATION_OF_THE_STATE_YEAR);

        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new \DateTime("{$year}-02-16", new \DateTimeZone(self::TIMEZONE))
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
            $this->generateRandomYear(Lithuania::RESTORATION_OF_THE_STATE_YEAR),
            [self::LOCALE => 'Lietuvos valstybės atkūrimo diena']
        );
        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(Lithuania::RESTORATION_OF_THE_STATE_YEAR),
            ['en' => 'Day of Restoration of the State of Lithuania']
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
            $this->generateRandomYear(Lithuania::RESTORATION_OF_THE_STATE_YEAR),
            Holiday::TYPE_OFFICIAL
        );
    }
}
