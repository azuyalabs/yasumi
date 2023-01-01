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

namespace Yasumi\tests\Netherlands;

use Yasumi\Holiday;
use Yasumi\tests\HolidayTestCase;

/**
 * Class for testing Liberation Day in the Netherlands.
 */
class LiberationDayTest extends NetherlandsBaseTestCase implements HolidayTestCase
{
    /**
     * The name of the holiday.
     */
    public const HOLIDAY = 'liberationDay';

    /**
     * The year in which the holiday was first established.
     */
    public const ESTABLISHMENT_YEAR = 1947;

    /**
     * Tests Liberation Day before 1947. Liberation Day was established after WWII in 1947.
     *
     * @throws \Exception
     */
    public function testLiberationDayBefore1947(): void
    {
        $this->assertNotHoliday(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(1000, self::ESTABLISHMENT_YEAR - 1)
        );
    }

    /**
     * Tests Liberation Day after 1947. Liberation Day was established after WWII in 1947.
     *
     * @throws \Exception
     */
    public function testLiberationDayOnAfter1947(): void
    {
        $year = $this->generateRandomYear(self::ESTABLISHMENT_YEAR);
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new \DateTime("$year-5-5", new \DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests the translated name of the holiday defined in this test.
     *
     * @throws \Exception
     */
    public function testTranslation(): void
    {
        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(self::ESTABLISHMENT_YEAR),
            [self::LOCALE => 'Bevrijdingsdag']
        );
    }

    /**
     * Tests Liberation Day official holiday type every 5 years, observance type on other years.
     *
     * @throws \Exception
     */
    public function testHolidayType(): void
    {
        $this->assertHolidayType(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(2001, 2004),
            Holiday::TYPE_OBSERVANCE
        );
        $this->assertHolidayType(
            self::REGION,
            self::HOLIDAY,
            2000,
            Holiday::TYPE_OFFICIAL
        );
        $this->assertHolidayType(
            self::REGION,
            self::HOLIDAY,
            2005,
            Holiday::TYPE_OFFICIAL
        );
    }
}
