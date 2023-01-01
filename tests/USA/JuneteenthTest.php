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

namespace Yasumi\tests\USA;

use Yasumi\Holiday;
use Yasumi\tests\HolidayTestCase;

/**
 * Class to test Juneteenth.
 */
class JuneteenthTest extends USABaseTestCase implements HolidayTestCase
{
    /**
     * The name of the holiday.
     */
    public const HOLIDAY = 'juneteenth';

    /**
     * The year in which the holiday was first established.
     */
    public const ESTABLISHMENT_YEAR = 2021;

    /**
     * Tests Juneteenth on or after 2021. Juneteenth is celebrated since 2021 on June 19th.
     *
     * @throws \Exception
     */
    public function testJuneteenthOnAfter2021(): void
    {
        $year = 2023;
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new \DateTime("$year-6-19", new \DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests Juneteenth on or after 2021 when substituted on Monday (when Juneteenth falls on Sunday).
     *
     * @throws \Exception
     */
    public function testJuneteenthOnAfter2021SubstitutedMonday(): void
    {
        $year = 2022;
        $this->assertSubstituteHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new \DateTime("$year-6-20", new \DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests Juneteenth on or after 2021 when substituted on Friday (when Juneteenth falls on Saturday).
     *
     * @throws \Exception
     */
    public function testJuneteenthOnAfter2021SubstitutedFriday(): void
    {
        $year = 2021;
        $this->assertSubstituteHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new \DateTime("$year-6-18", new \DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests Juneteenth before 2021. Juneteenth is celebrated since 2021 on June 19th.
     *
     * @throws \Exception
     */
    public function testJuneteenthBefore2021(): void
    {
        $this->assertNotHoliday(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(1000, self::ESTABLISHMENT_YEAR - 1)
        );
    }

    /**
     * Tests translated name of the holiday defined in this test.
     *
     * @throws \Exception
     */
    public function testTranslation(): void
    {
        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(self::ESTABLISHMENT_YEAR),
            [self::LOCALE => 'Juneteenth']
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
}
