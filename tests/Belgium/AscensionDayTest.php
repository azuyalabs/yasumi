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
namespace Yasumi\Tests\Belgium;

use DateTime;
use DateTimeZone;

/**
 * Class for testing Ascension Day.
 */
class AscensionDayTest extends BelgiumBaseTestCase
{
    /**
     * Tests Ascension Day.
     */
    public function testAscensionDay()
    {
        $year = 1818;
        $this->assertHoliday(self::COUNTRY, 'ascensionDay', $year,
            new DateTime("$year-4-30", new DateTimeZone(self::TIMEZONE)));
    }
}
