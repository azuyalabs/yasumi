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

namespace Yasumi\tests\Croatia;

use Yasumi\Holiday;
use Yasumi\tests\HolidayTestCase;

/**
 * Class containing tests for Homeland Thanksgiving Day in Croatia.
 */
class HomelandThanksgivingDayTest extends CroatiaBaseTestCase implements HolidayTestCase
{
    /**
     * The name of the holiday.
     */
    public const HOLIDAY = 'homelandThanksgiving';

    /**
     * The year in which the holiday was first established.
     */
    public const ESTABLISHMENT_YEAR = 1995;

    /**
     * The year in which the holiday name was changed.
     */
    public const NAME_CHANGED_YEAR = 2020;

    /**
     * Tests Homeland Thanksgiving Day on or after 1995.
     *
     * @throws \Exception
     */
    public function testHomelandThanksgivingDayOnAfter1995(): void
    {
        $year = $this->generateRandomYear(self::ESTABLISHMENT_YEAR);
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new \DateTime("$year-8-5", new \DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests Homeland Thanksgiving Day before 1995.
     *
     * @throws \Exception
     */
    public function testHomelandThanksgivingDayBefore1995(): void
    {
        $this->assertNotHoliday(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(1000, self::ESTABLISHMENT_YEAR - 1)
        );
    }

    /**
     * Tests translated name of Homeland Thanksgiving Day.
     *
     * @throws \Exception
     */
    public function testTranslation(): void
    {
        $year = $this->generateRandomYear(self::ESTABLISHMENT_YEAR, self::NAME_CHANGED_YEAR - 1);
        $expectedText = 'Dan domovinske zahvalnosti';
        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            $year,
            [self::LOCALE => $expectedText]
        );

        $year = $this->generateRandomYear(self::NAME_CHANGED_YEAR);
        $expectedText = 'Dan pobjede i domovinske zahvalnosti i Dan hrvatskih branitelja';
        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            $year,
            [self::LOCALE => $expectedText]
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
