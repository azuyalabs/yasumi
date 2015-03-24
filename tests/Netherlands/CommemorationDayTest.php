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

use Carbon\Carbon;

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
        $this->assertNotHoliday(self::COUNTRY, self::HOLIDAY, 1744);
    }

    /**
     * Tests Commemoration Day after 1947. Commemoration Day was established after WWII in 1947.
     */
    public function testCommemorationDayOnAfter1947()
    {
        $year = 2105;
        $this->assertHoliday(self::COUNTRY, self::HOLIDAY, $year, Carbon::createFromDate($year, 5, 4));
    }
}
