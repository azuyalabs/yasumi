<?php

declare(strict_types=1);
/*
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 - 2021 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <me@sachatelgenhof.com>
 */

namespace Yasumi\tests\Turkey;

use ReflectionException;
use Yasumi\Holiday;
use Yasumi\tests\HolidayTestCase;
use Yasumi\Yasumi;

class VictoryDayTest extends TurkeyBaseTestCase implements HolidayTestCase
{
    public const HOLIDAY = 'victoryDay';

    public const ESTABLISHMENT_YEAR = 1926;

    public const CELEBRATION_YEAR = 1923;

    /**
     * @throws ReflectionException
     */
    public function testHoliday(): void
    {
        $year = $this->generateRandomYear(self::CELEBRATION_YEAR);

        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new \DateTime("$year-8-30", new \DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * @throws ReflectionException
     */
    public function testHolidayBeforeCelebration(): void
    {
        $this->assertNotHoliday(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(Yasumi::YEAR_LOWER_BOUND, self::CELEBRATION_YEAR - 1)
        );
    }

    /**
     * @throws ReflectionException
     */
    public function testTranslation(): void
    {
        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(self::CELEBRATION_YEAR),
            [self::LOCALE => 'Zafer Bayramı']
        );
    }

    /**
     * @throws ReflectionException
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

    /**
     * @throws ReflectionException
     */
    public function testHolidayTypeBeforeEstablishment(): void
    {
        $this->assertHolidayType(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(self::CELEBRATION_YEAR, self::ESTABLISHMENT_YEAR - 1),
            Holiday::TYPE_OBSERVANCE
        );
    }
}
