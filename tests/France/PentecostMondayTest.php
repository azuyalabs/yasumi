<?php

declare(strict_types = 1);

/**
 * This file is part of the 'Yasumi' package.
 *
 * The easy PHP Library for calculating holidays.
 *
 * Copyright (c) 2015 - 2024 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <me at sachatelgenhof dot com>
 */

namespace Yasumi\tests\France;

use Yasumi\Holiday;
use Yasumi\Provider\France;
use Yasumi\tests\HolidayTestCase;

/**
 * Class for testing Pentecost Monday in France.
 */
class PentecostMondayTest extends FranceBaseTestCase implements HolidayTestCase
{
    /**
     * The name of the holiday.
     */
    public const HOLIDAY = 'pentecostMonday';

    /**
     * Tests Pentecost Monday.
     *
     * @throws \Exception
     */
    public function testPentecostMonday(): void
    {
        $year = 1977;
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new \DateTime("{$year}-5-30", new \DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests translated name of Pentecost Monday.
     *
     * @throws \Exception
     */
    public function testTranslation(): void
    {
        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(),
            [self::LOCALE => 'Lundi de Pentecôte']
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
            $this->generateRandomYear(null, France::EST_YEAR_DAY_OF_SOLIDARITY_WITH_ELDERLY - 1),
            Holiday::TYPE_OFFICIAL
        );

        $this->assertHolidayType(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(France::EST_YEAR_DAY_OF_SOLIDARITY_WITH_ELDERLY),
            Holiday::TYPE_OBSERVANCE
        );
    }
}
