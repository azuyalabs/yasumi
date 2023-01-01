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

namespace Yasumi\tests\Sweden;

use Yasumi\Holiday;
use Yasumi\tests\HolidayTestCase;

/**
 * Class for testing the National Day of Sweden in Sweden.
 */
class NationalDayTest extends SwedenBaseTestCase implements HolidayTestCase
{
    /**
     * The year in which the holiday was first established.
     */
    public const ESTABLISHMENT_YEAR = 1916;

    /**
     * The name of the holiday.
     */
    public const HOLIDAY = 'nationalDay';

    /**
     * Tests the holiday defined in this test on or after establishment.
     *
     * @throws \Exception
     */
    public function testHolidayOnAfterEstablishment(): void
    {
        $year = 2022;
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new \DateTime("$year-6-6", new \DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests the holiday defined in this test before establishment.
     *
     * @throws \Exception
     */
    public function testHolidayBeforeEstablishment(): void
    {
        $this->assertNotHoliday(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(1000, self::ESTABLISHMENT_YEAR - 1)
        );
    }

    /**
     * Tests the translated name of the holiday defined in this test on or after establishment.
     *
     * @throws \Exception
     */
    public function testTranslation(): void
    {
        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(self::ESTABLISHMENT_YEAR, 1982),
            [self::LOCALE => 'Svenska flaggans dag']
        );
    }

    /**
     * Tests type of the holiday defined in this test.
     *
     * @throws \Exception
     */
    public function testHolidayType(): void
    {
        $this->assertHolidayType(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(self::ESTABLISHMENT_YEAR),
            Holiday::TYPE_OFFICIAL
        );
    }

    /**
     * Tests the translated name of the holiday defined in this test on or after establishment.
     *
     * @throws \Exception
     */
    public function testTranslationOnAfterNameChange(): void
    {
        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(1983),
            [self::LOCALE => 'Sveriges nationaldag']
        );
    }
}
