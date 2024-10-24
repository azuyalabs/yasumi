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

namespace Yasumi\tests\Switzerland\Vaud;

use Yasumi\Holiday;
use Yasumi\tests\HolidayTestCase;

/**
 * Class containing tests for Easter Monday in Vaud (Switzerland).
 */
class EasterMondayTest extends VaudBaseTestCase implements HolidayTestCase
{
    /**
     * The name of the holiday.
     */
    public const HOLIDAY = 'easterMonday';

    /**
     * Tests Easter Monday.
     *
     * @throws \Exception
     */
    public function testEasterMonday(): void
    {
        $year = 2016;
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new \DateTime("{$year}-3-28", new \DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests translated name of Easter Monday.
     *
     * @throws \Exception
     */
    public function testTranslation(): void
    {
        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(),
            [self::LOCALE => 'Lundi de Pâques']
        );
    }

    /**
     * Tests type of the holiday defined in this test.
     *
     * @throws \Exception
     */
    public function testHolidayType(): void
    {
        $this->assertHolidayType(self::REGION, self::HOLIDAY, $this->generateRandomYear(), Holiday::TYPE_OTHER);
    }
}
