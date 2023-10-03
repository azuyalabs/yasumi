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

namespace Yasumi\tests\Ukraine;

use Yasumi\Holiday;
use Yasumi\tests\HolidayTestCase;

/**
 * Class DefenderOfUkraineDayTest.
 */
class DefenderOfUkraineDayTest extends UkraineBaseTestCase implements HolidayTestCase
{
    /**
     * The name of the holiday to be tested.
     */
    public const HOLIDAY = 'defenderOfUkraineDay';

    /**
     * @throws \Exception
     */
    public function testHoliday(): void
    {
        $year = $this->generateRandomYear(2015);
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new \DateTime(($year >= 2015 && $year < 2023 ? "{$year}-10-14" : "{$year}-10-01"), new \DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests the translated name of the holiday defined in this test.
     */
    public function testTranslation(): void
    {
        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            2020,
            [self::LOCALE => 'День захисника України']
        );
    }

    /**
     * Tests type of the holiday defined in this test.
     */
    public function testHolidayType(): void
    {
        $this->assertHolidayType(self::REGION, self::HOLIDAY, 2020, Holiday::TYPE_OFFICIAL);
    }
}
