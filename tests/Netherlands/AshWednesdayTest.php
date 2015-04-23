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
 * Class for testing Ash Wednesday in the Netherlands.
 */
class AshWednesdayTest extends NetherlandsBaseTestCase
{
    /**
     * The name of the holiday
     */
    const HOLIDAY = 'ashWednesday';

    /**
     * Tests Ash Wednesday.
     */
    public function testAshWednesday()
    {
        $year = 1999;
        $this->assertHoliday(self::COUNTRY, self::HOLIDAY, $year,
            new DateTime("$year-2-17", new DateTimeZone(self::TIMEZONE)));
    }

    /**
     * Tests translated name of Ash Wednesday.
     */
    public function testTranslation()
    {
        $this->assertTranslatedHolidayName(self::COUNTRY, self::HOLIDAY, $this->generateRandomYear(),
            ['nl_NL' => 'Aswoensdag']);
    }
}
