<?php

declare(strict_types=1);
/*
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 - 2023 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <me at sachatelgenhof dot com>
 */

namespace Yasumi\tests\USA;

use Yasumi\Holiday;
use Yasumi\tests\HolidayTestCase;

/**
 * Class to test Dr. Martin Luther King Day.
 */
class MartinLutherKingDayTest extends USABaseTestCase implements HolidayTestCase
{
    /**
     * The name of the holiday.
     */
    public const HOLIDAY = 'martinLutherKingDay';

    /**
     * The year in which the holiday was first established.
     */
    public const ESTABLISHMENT_YEAR = 1986;

    /**
     * Tests Dr. Martin Luther King Day on or after 1986. Dr. Martin Luther King Day was established since 1986 on the
     * third Monday of January.
     *
     * @throws \Exception
     */
    public function testMartinLutherKingDayOnAfter1986(): void
    {
        $year = $this->generateRandomYear(self::ESTABLISHMENT_YEAR);
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new \DateTime("third monday of january $year", new \DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests Dr. Martin Luther King Day before 1986. Dr. Martin Luther King Day was established since 1996 on the third
     * Monday of January.
     *
     * @throws \Exception
     */
    public function testMartinLutherKingDayBefore1986(): void
    {
        $this->assertNotHoliday(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(1000, self::ESTABLISHMENT_YEAR - 1)
        );
    }

    /**
     * Tests translated name of the holiday defined in this test.
     *
     * @throws \Exception
     */
    public function testTranslation(): void
    {
        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(self::ESTABLISHMENT_YEAR),
            [self::LOCALE => 'Dr. Martin Luther King Jr’s Birthday']
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
