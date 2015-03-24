<?php
/*
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Yasumi\Tests\Japan;

use Carbon\Carbon;

/**
 * Class ChildrensDayTest.
 */
class ChildrensDayTest extends JapanBaseTestCase
{
    /**
     * The name of the holiday
     */
    const HOLIDAY = 'childrensDay';

    /**
     * Tests Children's Day after 1948. Children's Day was established after 1948
     */
    public function testChildrensDayOnAfter1948()
    {
        $year = 1955;
        $this->assertHoliday(self::COUNTRY, self::HOLIDAY, $year, Carbon::createFromDate($year, 5, 5));
        $year = 2120;
        $this->assertHoliday(self::COUNTRY, self::HOLIDAY, $year,
            Carbon::createFromDate($year, 5, 6)); // Substituted day
    }

    /**
     * Tests Children's Day before 1948. Children's Day was established after 1948
     */
    public function testChildrensDayBefore1948()
    {
        $this->assertNotHoliday(self::COUNTRY, self::HOLIDAY, 1900);
    }
}
