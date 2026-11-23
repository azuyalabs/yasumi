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

namespace Yasumi\tests\Peru;

use Yasumi\Holiday;
use Yasumi\Provider\Peru;
use Yasumi\tests\HolidayTestCase;

/**
 * Class for testing Independence Celebration Day (29 July / Gran Parada Militar) in Peru.
 */
class IndependenceCelebrationDayTest extends PeruBaseTestCase implements HolidayTestCase
{
    public const HOLIDAY = 'independenceCelebrationDay';

    /** @throws \Exception */
    public function testHoliday(): void
    {
        $year = 2025;
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new \DateTime("{$year}-07-29", new \DateTimeZone(self::TIMEZONE))
        );
    }

    /** @throws \Exception */
    public function testNotBeforeIndependence(): void
    {
        $this->assertNotHoliday(self::REGION, self::HOLIDAY, Peru::INDEPENDENCE_YEAR - 1);
    }

    /** @throws \Exception */
    public function testTranslation(): void
    {
        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            static::generateRandomYear(Peru::INDEPENDENCE_YEAR),
            [self::LOCALE => 'Día de la Gran Parada Militar']
        );
    }

    /** @throws \Exception */
    public function testHolidayType(): void
    {
        $this->assertHolidayType(self::REGION, self::HOLIDAY, static::generateRandomYear(Peru::INDEPENDENCE_YEAR), Holiday::TYPE_OFFICIAL);
    }
}
