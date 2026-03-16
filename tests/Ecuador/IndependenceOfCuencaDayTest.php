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

class IndependenceOfCuencaDayTest extends EcuadorBaseTestCase implements HolidayTestCase
{
    public const HOLIDAY = 'independenceOfCuencaDay';

    /** @throws \Exception */
    public function testHoliday(): void
    {
        // Nov 03 2000 = Friday — no transfer
        $year = 2000;
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new \DateTime("{$year}-11-03", new \DateTimeZone(self::TIMEZONE))
        );
    }

    /** @throws \Exception */
    public function testTransferRule(): void
    {
        // Nov 03 2001 = Saturday → 2001-11-02
        $holidays = \Yasumi\Yasumi::create(self::REGION, 2001, self::LOCALE);
        $holiday = $holidays->getHoliday(self::HOLIDAY);
        $this->assertNotNull($holiday);
        $this->assertSame('2001-11-02', $holiday->format('Y-m-d'));
    }

    /** @throws \Exception */
    public function testNotBeforeEstablishment(): void
    {
        $this->assertNotHoliday(self::REGION, self::HOLIDAY, Ecuador::INDEPENDENCE_OF_CUENCA_YEAR - 1);
    }

    /** @throws \Exception */
    public function testTranslation(): void
    {
        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            static::generateRandomYear(Ecuador::INDEPENDENCE_OF_CUENCA_YEAR),
            [self::LOCALE => 'Independencia de Cuenca']
        );
    }

    /** @throws \Exception */
    public function testHolidayType(): void
    {
        $this->assertHolidayType(self::REGION, self::HOLIDAY, static::generateRandomYear(Ecuador::INDEPENDENCE_OF_CUENCA_YEAR), Holiday::TYPE_OFFICIAL);
    }
}
