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

namespace Yasumi\tests\Benin;

use Yasumi\Holiday;
use Yasumi\Provider\Benin;
use Yasumi\tests\HolidayTestCase;

/**
 * Class for testing Easter Monday in Benin.
 *
 * The day after Easter Sunday (Law 90-019).
 */
class EasterMondayTest extends BeninBaseTestCase implements HolidayTestCase
{
    /**
     * The key of the holiday.
     */
    public const HOLIDAY = 'easterMonday';

    /**
     * Tests Easter Monday.
     *
     * @throws \Exception
     */
    public function testHoliday(): void
    {
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            2024,
            new \DateTime('2024-04-01', new \DateTimeZone(self::TIMEZONE))
        );

        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            2025,
            new \DateTime('2025-04-21', new \DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests that Easter Monday always falls on a Monday.
     *
     * @throws \Exception
     */
    public function testDayOfWeek(): void
    {
        $this->assertDayOfWeek(
            self::REGION,
            self::HOLIDAY,
            static::generateRandomYear(Benin::ESTABLISHMENT_YEAR),
            'Monday'
        );
    }

    /**
     * Tests that Easter Monday is not defined before the establishment year.
     *
     * @throws \Exception
     */
    public function testHolidayBeforeEstablishment(): void
    {
        $this->assertNotHoliday(self::REGION, self::HOLIDAY, Benin::ESTABLISHMENT_YEAR - 1);
    }

    /**
     * Tests the translated name of Easter Monday.
     *
     * @throws \Exception
     */
    public function testTranslation(): void
    {
        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            static::generateRandomYear(Benin::ESTABLISHMENT_YEAR),
            [self::LOCALE => 'Lundi de Pâques']
        );
    }

    /**
     * Tests the type of Easter Monday.
     *
     * @throws \Exception
     */
    public function testHolidayType(): void
    {
        $this->assertHolidayType(
            self::REGION,
            self::HOLIDAY,
            static::generateRandomYear(Benin::ESTABLISHMENT_YEAR),
            Holiday::TYPE_OFFICIAL
        );
    }
}
