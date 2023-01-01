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
 * Class testing Showa Day in Japan.
 */
class ShowaDayTest extends JapanBaseTestCase implements HolidayTestCase
{
    /**
     * The name of the holiday defined in the test.
     */
    public const HOLIDAY = 'showaDay';

    /**
     * The year in which the holiday defined in the test was first established.
     */
    public const ESTABLISHMENT_YEAR = 2007;

    /**
     * Tests the holiday defined in the test on or after establishment.
     *
     * @throws \Exception
     */
    public function testHolidayOnAfter2007(): void
    {
        $year = 2110;
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new \DateTime("$year-4-29", new \DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests the holiday defined in the test on or after the establishment and substituted next working day.
     *
     * @throws \Exception
     */
    public function testHolidayOnAfterEstablishmentSubstitutedNextWorkingDay(): void
    {
        $year = 2210;
        $this->assertHoliday(
            self::REGION,
            self::SUBSTITUTE_PREFIX.self::HOLIDAY,
            $year,
            new \DateTime("$year-4-30", new \DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests the holiday defined in the test before establishment.
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
            [self::LOCALE => '昭和の日']
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
