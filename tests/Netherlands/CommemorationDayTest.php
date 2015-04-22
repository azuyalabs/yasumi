<?php
/*
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <stelgenhof@gmail.com>
 */
namespace Yasumi\Tests\Netherlands;

use DateTime;
use DateTimeZone;

/**
 * Class for testing Commemoration Day in the Netherlands.
 */
class CommemorationDayTest extends NetherlandsBaseTestCase
{
    /**
     * The name of the holiday
     */
    const HOLIDAY = 'commemorationDay';

    /**
     * The year in which the holiday was first established
     */
    const ESTABLISHMENT_YEAR = 1947;

    /**
     * Tests Commemoration Day before 1947. Commemoration Day was established after WWII in 1947.
     */
    public function testCommemorationDayBefore1947()
    {
        $this->assertNotHoliday(self::COUNTRY, self::HOLIDAY,
            $this->generateRandomYear(1000, self::ESTABLISHMENT_YEAR - 1));
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
