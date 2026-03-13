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
 * Class for testing Indigenous Resistance Day / Columbus Day (12 October) in Venezuela.
 *
 * Known as "Día de la Raza" until 2001. Renamed to "Día de la Resistencia Indígena"
 * by Presidential Decree 2028 in 2002.
 */
class IndigenousResistanceDayTest extends VenezuelaBaseTestCase implements HolidayTestCase
{
    public const HOLIDAY = 'indigenousResistanceDay';
    public const ESTABLISHMENT_YEAR = Venezuela::COLUMBUS_YEAR;

    /** @throws \Exception */
    public function testHoliday(): void
    {
        $year = self::ESTABLISHMENT_YEAR;
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new \DateTime("{$year}-10-12", new \DateTimeZone(self::TIMEZONE))
        );
    }

    /** @throws \Exception */
    public function testNotHoliday(): void
    {
        $this->assertNotHoliday(self::REGION, self::HOLIDAY, self::ESTABLISHMENT_YEAR - 1);
    }

    /**
     * Tests that the holiday is named "Día de la Raza" before 2002.
     *
     * @throws \Exception
     */
    public function testNameBeforeRename(): void
    {
        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            2001,
            [self::LOCALE => 'Día de la Raza']
        );
    }

    /**
     * Tests that the holiday is renamed to "Día de la Resistencia Indígena" from 2002 onward.
     *
     * @throws \Exception
     */
    public function testNameAfterRename(): void
    {
        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            2002,
            [self::LOCALE => 'Día de la Resistencia Indígena']
        );
    }

    /** @throws \Exception */
    public function testTranslation(): void
    {
        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            static::generateRandomYear(Venezuela::INDIGENOUS_RESISTANCE_YEAR),
            [self::LOCALE => 'Día de la Resistencia Indígena']
        );
    }

    /** @throws \Exception */
    public function testHolidayType(): void
    {
        $this->assertHolidayType(self::REGION, self::HOLIDAY, static::generateRandomYear(self::ESTABLISHMENT_YEAR), Holiday::TYPE_OFFICIAL);
    }
}
