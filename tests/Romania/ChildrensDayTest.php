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
 * Class for testing Children's Day in Romania.
 */
class ChildrensDayTest extends RomaniaBaseTestCase implements HolidayTestCase
{
    /**
     * The name of the holiday to be tested.
     */
    public const HOLIDAY = 'childrensDay';

    /**
     * The year in which the holiday was first established.
     */
    public const ESTABLISHMENT_YEAR = 1950;

    /**
     * Tests Children's Day on or after 1950.
     *
     * @throws \Exception
     */
    public function testChildrensDayOnAfter1950(): void
    {
        $year = $this->generateRandomYear(self::ESTABLISHMENT_YEAR);
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new \DateTime("$year-06-01", new \DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests Children's Day before 1950.
     *
     * @throws \Exception
     */
    public function testChildrensDayBefore1950(): void
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
            [self::LOCALE => 'Ziua Copilului']
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
            $this->generateRandomYear(self::ESTABLISHMENT_YEAR, 2016),
            Holiday::TYPE_OBSERVANCE
        );
        $this->assertHolidayType(self::REGION, self::HOLIDAY, $this->generateRandomYear(2017), Holiday::TYPE_OFFICIAL);
    }
}
