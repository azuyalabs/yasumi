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

namespace Yasumi\tests\Japan;

use Yasumi\Holiday;
use Yasumi\tests\HolidayTestCase;

/**
 * Class for teting Constitution Memorial Day in Japan.
 */
class ConstitutionMemorialDayTest extends JapanBaseTestCase implements HolidayTestCase
{
    /**
     * The name of the holiday.
     */
    public const HOLIDAY = 'constitutionMemorialDay';

    /**
     * The year in which the holiday was first established.
     */
    public const ESTABLISHMENT_YEAR = 1948;

    /**
     * Tests Constitution Memorial Day after 1948. Constitution Memorial Day was established after 1948.
     *
     * @throws \Exception
     */
    public function testConstitutionMemorialDayOnAfter1948(): void
    {
        $year = 1967;
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new \DateTime("$year-5-3", new \DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests Constitution Memorial Day after 1948 substituted next working day (when Constitution Memorial Day falls on
     * a Sunday).
     *
     * @throws \Exception
     */
    public function testConstitutionMemorialDayOnAfter1948SubstitutedNextWorkingDay(): void
    {
        $year = 2009;
        $this->assertHoliday(
            self::REGION,
            self::SUBSTITUTE_PREFIX.self::HOLIDAY,
            $year,
            new \DateTime("$year-5-6", new \DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests Constitution Memorial Day before 1948. Constitution Memorial Day was established after 1948.
     *
     * @throws \Exception
     */
    public function testConstitutionMemorialDayBefore1948(): void
    {
        $this->assertNotHoliday(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(1000, self::ESTABLISHMENT_YEAR - 1)
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
            [self::LOCALE => '憲法記念日']
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
