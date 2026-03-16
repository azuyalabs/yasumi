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

class FirstCryOfIndependenceDayTest extends EcuadorBaseTestCase implements HolidayTestCase
{
    public const HOLIDAY = 'firstCryOfIndependenceDay';

    /** @throws \Exception */
    public function testHoliday(): void
    {
        // Aug 10 2001 = Friday — no transfer
        $year = 2001;
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new \DateTime("{$year}-08-10", new \DateTimeZone(self::TIMEZONE))
        );
    }

    /** @throws \Exception */
    public function testTransferRule(): void
    {
        // Aug 10 2000 = Thursday → 2000-08-11
        $holidays = \Yasumi\Yasumi::create(self::REGION, 2000, self::LOCALE);
        $holiday = $holidays->getHoliday(self::HOLIDAY);
        $this->assertNotNull($holiday);
        $this->assertSame('2000-08-11', $holiday->format('Y-m-d'));
    }

    /** @throws \Exception */
    public function testNotBeforeEstablishment(): void
    {
        $this->assertNotHoliday(self::REGION, self::HOLIDAY, Ecuador::FIRST_CRY_OF_INDEPENDENCE_YEAR - 1);
    }

    /** @throws \Exception */
    public function testTranslation(): void
    {
        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            static::generateRandomYear(Ecuador::FIRST_CRY_OF_INDEPENDENCE_YEAR),
            [self::LOCALE => 'Primer Grito de Independencia']
        );
    }

    /** @throws \Exception */
    public function testHolidayType(): void
    {
        $this->assertHolidayType(self::REGION, self::HOLIDAY, static::generateRandomYear(Ecuador::FIRST_CRY_OF_INDEPENDENCE_YEAR), Holiday::TYPE_OFFICIAL);
    }
}
