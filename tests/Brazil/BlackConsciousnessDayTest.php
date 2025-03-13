<?php

declare(strict_types = 1);

/**
 * This file is part of the 'Yasumi' package.
 *
 * The easy PHP Library for calculating holidays.
 *
 * Copyright (c) 2015 - 2025 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <me at sachatelgenhof dot com>
 */

namespace Yasumi\tests\Brazil;

use Yasumi\Holiday;
use Yasumi\tests\HolidayTestCase;

/**
 * Class containing tests for Black Consciousness Day in Brazil.
 */
class BlackConsciousnessDayTest extends BrazilBaseTestCase implements HolidayTestCase
{
    /**
     * The name of the holiday.
     */
    public const HOLIDAY = 'blackConsciousnessDay';

    /**
     * The year in which the holiday was first established.
     */
    public const ESTABLISHMENT_YEAR = 2011;

    /**
     * The year in which the holiday celebration date has changed.
     */
    public const OFFICIAL_YEAR = 2024;

    /**
     * Tests Black Consciousness Day.
     *
     * @throws \Exception
     */
    public function testBlackConsciousnessDay(): void
    {
        $year = $this->generateRandomYear(self::ESTABLISHMENT_YEAR, self::OFFICIAL_YEAR - 1);
        $expectedDate = "{$year}-11-20";
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new \DateTime($expectedDate, new \DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests Black Consciousness Day before 2011.
     *
     * @throws \Exception
     */
    public function testBlackConsciousnessDayBefore2011(): void
    {
        $this->assertNotHoliday(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(1000, self::ESTABLISHMENT_YEAR - 1)
        );
    }

    /**
     * Tests translated name of Black Consciousness Day.
     *
     * @throws \Exception
     */
    public function testTranslation(): void
    {
        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(self::ESTABLISHMENT_YEAR),
            [self::LOCALE => 'Dia Nacional de Zumbi e da Consciência Negra']
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
            $this->generateRandomYear(self::ESTABLISHMENT_YEAR, self::OFFICIAL_YEAR - 1),
            Holiday::TYPE_OBSERVANCE
        );

        $this->assertHolidayType(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(self::OFFICIAL_YEAR),
            Holiday::TYPE_OFFICIAL
        );
    }
}
