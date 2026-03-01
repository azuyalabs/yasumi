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

namespace Yasumi\tests\Andorra;

use Yasumi\Holiday;
use Yasumi\Provider\Andorra;
use Yasumi\tests\HolidayTestCase;

/**
 * Class containing tests for Constitution Day in Andorra.
 */
class ConstitutionDayTest extends AndorraBaseTestCase implements HolidayTestCase
{
    /**
     * The name of the holiday.
     */
    public const HOLIDAY = 'constitutionDay';

    /**
     * The year in which Constitution Day was established.
     */
    public const ESTABLISHMENT_YEAR = 1993;

    /**
     * Tests Constitution Day on or after 1993.
     *
     * @throws \Exception
     */
    public function testConstitutionDayOnAfter1993(): void
    {
        $year = $this->generateRandomYear(self::ESTABLISHMENT_YEAR);
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new \DateTime("{$year}-3-14", new \DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests Constitution Day before 1993 (should not exist).
     *
     * @throws \Exception
     */
    public function testConstitutionDayBefore1993(): void
    {
        $this->assertNotHoliday(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(1000, self::ESTABLISHMENT_YEAR - 1)
        );
    }

    /**
     * Tests the translated name of Constitution Day.
     *
     * @throws \Exception
     */
    public function testTranslation(): void
    {
        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(self::ESTABLISHMENT_YEAR),
            [self::LOCALE => 'Dia de la Constitució']
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
