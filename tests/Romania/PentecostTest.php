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

namespace Yasumi\tests\Romania;

use Yasumi\Holiday;
use Yasumi\tests\HolidayTestCase;

/**
 * Class PentecostTest.
 */
class PentecostTest extends RomaniaBaseTestCase implements HolidayTestCase
{
    /**
     * The name of the holiday.
     */
    public const HOLIDAY = 'pentecost';

    /**
     * The year in which the holiday was first established.
     */
    public const ESTABLISHMENT_YEAR = 2008;

    /**
     * Tests the Pentecost Day on and after 2008.
     *
     * @throws \Exception
     */
    public function testPentecostDayOnAfter2008(): void
    {
        $year = 2020;
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new \DateTime("$year-06-07", new \DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests the Pentecost Day before 2008.
     *
     * @throws \Exception
     */
    public function testPentecostDayBefore2008(): void
    {
        $this->assertNotHoliday(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(1000, self::ESTABLISHMENT_YEAR - 1)
        );
    }

    /**
     * Tests the translated name of the holiday defined in this test.
     *
     * @throws \Exception
     */
    public function testTranslation(): void
    {
        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(self::ESTABLISHMENT_YEAR),
            [self::LOCALE => 'Rusaliile']
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
