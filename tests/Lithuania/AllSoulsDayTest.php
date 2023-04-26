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
 * Class containing tests for All Souls' Day in Lithuania.
 *
 * @author Tomas Norkūnas <norkunas.tom@gmail.com>
 */
class AllSoulsDayTest extends LithuaniaBaseTestCase implements HolidayTestCase
{
    /**
     * The name of the holiday to be tested.
     */
    public const HOLIDAY = 'allSoulsDay';

    /**
     * @throws \Exception
     */
    public function testHolidayBeforeAnnounce(): void
    {
        $this->assertNotHoliday(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(1000, Lithuania::ALL_SOULS_DAY - 1)
        );
    }

    /**
     * Test if holiday is defined after restoration.
     *
     * @throws \Exception
     */
    public function testHolidayAfterAnnounce(): void
    {
        $year = $this->generateRandomYear(Lithuania::ALL_SOULS_DAY);

        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new \DateTime("$year-11-02", new \DateTimeZone(self::TIMEZONE))
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
            $this->generateRandomYear(Lithuania::ALL_SOULS_DAY),
            [self::LOCALE => 'Vėlinės']
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
            $this->generateRandomYear(Lithuania::ALL_SOULS_DAY),
            Holiday::TYPE_OFFICIAL
        );
    }
}
