<?php
/*
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Yasumi\Tests\Netherlands;

use DateTime;
use DateTimeZone;

/**
 * Class CommemorationDayTest.
 */
class CommemorationDayTest extends NetherlandsBaseTestCase
{
    /**
     * The name of the holiday
     */
    const HOLIDAY = 'commemorationDay';

    /**
     * Tests Commemoration Day before 1947. Commemoration Day was established after WWII in 1947.
     */
    public function testCommemorationDayBefore1947()
    {
        $this->assertNotHoliday(self::COUNTRY, self::HOLIDAY, $this->generateRandomYear(1000, 1946));
    }

    /**
     * Tests Commemoration Day after 1947. Commemoration Day was established after WWII in 1947.
     */
    public function testCommemorationDayOnAfter1947()
    {
        $year = 2105;
        $this->assertHoliday(self::COUNTRY, self::HOLIDAY, $year,
            new DateTime("$year-5-4", new DateTimeZone(self::TIMEZONE)));
    }
}
