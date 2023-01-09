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

namespace Yasumi\tests\Lithuania;

use Yasumi\Holiday;
use Yasumi\Provider\Lithuania;
use Yasumi\tests\HolidayTestCase;

/**
 * Class containing tests for Statehood Day day in Lithuania.
 *
 * @author Gedas Lukošius <gedas@lukosius.me>
 */
class StatehoodDayTest extends LithuaniaBaseTestCase implements HolidayTestCase
{
    /**
     * The name of the holiday to be tested.
     */
    public const HOLIDAY = 'statehoodDay';

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
            $this->generateRandomYear(1000, Lithuania::STATEHOOD_YEAR - 1)
        );
    }

    /**
     * Test if holiday is defined after restoration.
     *
     * @throws \Exception
     */
    public function testHolidayAfterRestoration(): void
    {
        $year = $this->generateRandomYear(Lithuania::STATEHOOD_YEAR);

        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new \DateTime("$year-07-06", new \DateTimeZone(self::TIMEZONE))
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
            $this->generateRandomYear(Lithuania::STATEHOOD_YEAR),
            [self::LOCALE => 'Valstybės (Lietuvos karaliaus Mindaugo karūnavimo) diena']
        );
        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(Lithuania::STATEHOOD_YEAR),
            ['en' => 'Statehood Day (Lithuania)']
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
            $this->generateRandomYear(Lithuania::STATEHOOD_YEAR),
            Holiday::TYPE_OFFICIAL
        );
    }
}
