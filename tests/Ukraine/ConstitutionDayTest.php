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
 * Class ConstitutionDayTest.
 */
class ConstitutionDayTest extends UkraineBaseTestCase implements HolidayTestCase
{
    /**
     * The name of the holiday to be tested.
     */
    public const HOLIDAY = 'constitutionDay';

    /**
     * @throws \Exception
     */
    public function testHoliday(): void
    {
        $year = 2020;
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new \DateTime("$year-06-28", new \DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests the translated name of the holiday defined in this test.
     */
    public function testTranslation(): void
    {
        $this->assertTranslatedHolidayName(self::REGION, self::HOLIDAY, 2020, [self::LOCALE => 'День Конституції']);
    }

    /**
     * Tests type of the holiday defined in this test.
     */
    public function testHolidayType(): void
    {
        $this->assertHolidayType(self::REGION, self::HOLIDAY, 2020, Holiday::TYPE_OFFICIAL);
    }
}
