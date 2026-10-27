<?php

declare(strict_types = 1);

/**
 * This file is part of the 'Yasumi' package.
 *
 * The easy PHP Library for calculating holidays.
 *
 * Copyright (c) 2015 - 2026 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <me at sachatelgenhof dot com>
 */

namespace Yasumi\tests\Ecuador;

use Yasumi\Holiday;
use Yasumi\Provider\Ecuador;
use Yasumi\tests\HolidayTestCase;

class IndependenceOfGuayaquilDayTest extends EcuadorBaseTestCase implements HolidayTestCase
{
    public const HOLIDAY = 'independenceOfGuayaquilDay';

    /** @throws \Exception */
    public function testHoliday(): void
    {
        // Oct 09 2000 = Monday — no transfer
        $year = 2000;
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new \DateTime("{$year}-10-09", new \DateTimeZone(self::TIMEZONE))
        );
    }

    /** @throws \Exception */
    public function testTransferRule(): void
    {
        // Oct 09 2001 = Tuesday → 2001-10-08
        $holidays = \Yasumi\Yasumi::create(self::REGION, 2001, self::LOCALE);
        $holiday = $holidays->getHoliday(self::HOLIDAY);
        $this->assertNotNull($holiday);
        $this->assertSame('2001-10-08', $holiday->format('Y-m-d'));
    }

    /** @throws \Exception */
    public function testNotBeforeEstablishment(): void
    {
        $this->assertNotHoliday(self::REGION, self::HOLIDAY, Ecuador::INDEPENDENCE_OF_GUAYAQUIL_YEAR - 1);
    }

    /** @throws \Exception */
    public function testTranslation(): void
    {
        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            static::generateRandomYear(Ecuador::INDEPENDENCE_OF_GUAYAQUIL_YEAR),
            [self::LOCALE => 'Independencia de Guayaquil']
        );
    }

    /** @throws \Exception */
    public function testHolidayType(): void
    {
        $this->assertHolidayType(self::REGION, self::HOLIDAY, static::generateRandomYear(Ecuador::INDEPENDENCE_OF_GUAYAQUIL_YEAR), Holiday::TYPE_OFFICIAL);
    }
}
