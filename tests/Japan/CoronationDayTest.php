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
 * Class testing the Emperors Coronation day in Japan.
 */
class CoronationDayTest extends JapanBaseTestCase implements HolidayTestCase
{
    /**
     * The name of the holiday.
     */
    public const HOLIDAY = 'coronationDay';

    /**
     * The year in which the holiday was first established.
     */
    public const ESTABLISHMENT_YEAR = 2019;

    /**
     * @throws \Exception
     */
    public function testEmperorsCoronationDay(): void
    {
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            2019,
            new \DateTime('2019-5-1', new \DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * @throws \Exception
     */
    public function testEmperorsBirthdayBefore2019(): void
    {
        $this->assertNotHoliday(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(1000, self::ESTABLISHMENT_YEAR - 1)
        );
    }

    /**
     * @throws \Exception
     */
    public function testEmperorsBirthdayAfter2020(): void
    {
        $this->assertNotHoliday(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(self::ESTABLISHMENT_YEAR + 1)
        );
    }

    /**
     * Tests the translated name of the holiday defined in this test.
     */
    public function testTranslation(): void
    {
        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            2019,
            [self::LOCALE => '即位の日']
        );
    }

    /**
     * Tests type of the holiday defined in this test.
     */
    public function testHolidayType(): void
    {
        $this->assertHolidayType(
            self::REGION,
            self::HOLIDAY,
            2019,
            Holiday::TYPE_OFFICIAL
        );
    }
}
