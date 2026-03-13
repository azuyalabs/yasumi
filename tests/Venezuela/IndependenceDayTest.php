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

namespace Yasumi\tests\Venezuela;

use Yasumi\Holiday;
use Yasumi\Provider\Venezuela;
use Yasumi\tests\HolidayTestCase;

/**
 * Class for testing Independence Day (5 July) in Venezuela.
 *
 * Commemorates the formal Declaration of Independence signed by the
 * Venezuelan Congress on 5 July 1811.
 */
class IndependenceDayTest extends VenezuelaBaseTestCase implements HolidayTestCase
{
    public const HOLIDAY = 'independenceDay';
    public const ESTABLISHMENT_YEAR = Venezuela::INDEPENDENCE_YEAR;

    /** @throws \Exception */
    public function testHoliday(): void
    {
        $year = self::ESTABLISHMENT_YEAR;
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new \DateTime("{$year}-07-05", new \DateTimeZone(self::TIMEZONE))
        );
    }

    /** @throws \Exception */
    public function testNotHoliday(): void
    {
        $this->assertNotHoliday(self::REGION, self::HOLIDAY, self::ESTABLISHMENT_YEAR - 1);
    }

    /** @throws \Exception */
    public function testTranslation(): void
    {
        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            static::generateRandomYear(self::ESTABLISHMENT_YEAR),
            [self::LOCALE => 'Día de la Independencia']
        );
    }

    /** @throws \Exception */
    public function testHolidayType(): void
    {
        $this->assertHolidayType(self::REGION, self::HOLIDAY, static::generateRandomYear(self::ESTABLISHMENT_YEAR), Holiday::TYPE_OFFICIAL);
    }
}
