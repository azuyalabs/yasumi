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

namespace Yasumi\tests\Germany\Berlin;

use Yasumi\Holiday;
use Yasumi\tests\HolidayTestCase;

/**
 * Class for testing Day of Liberation 2020 in Berlin (Germany).
 */
class DayOfLiberation2020Test extends BerlinBaseTestCase implements HolidayTestCase
{
    /**
     * The name of the holiday to be tested.
     */
    public const HOLIDAY = 'dayOfLiberation';

    /**
     * The year in which the holiday takes place.
     */
    public const YEAR = 2020;

    /**
     * Test the holiday defined in this test.
     *
     * @throws \Exception
     */
    public function testHolidayInYear(): void
    {
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            self::YEAR,
            new \DateTime(self::YEAR.'-05-08', new \DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Test the holiday defined in this test in the years before.
     *
     * @throws \Exception
     */
    public function testHolidayBeforeYear(): void
    {
        $this->assertNotHoliday(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(1000, self::YEAR - 1)
        );
    }

    /**
     * Test the holiday defined in this test in the years after.
     *
     * @throws \Exception
     */
    public function testHolidayAfterYear(): void
    {
        $this->assertNotHoliday(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(self::YEAR + 1)
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
            self::YEAR,
            [self::LOCALE => 'Tag der Befreiung']
        );
    }

    /**
     * Tests type of the holiday defined in this test.
     */
    public function testHolidayType(): void
    {
        $this->assertHolidayType(
            self::REGION,
            self::HOLIDAY,
            self::YEAR,
            Holiday::TYPE_OFFICIAL
        );
    }
}
