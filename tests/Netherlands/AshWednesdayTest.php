<?php
/*
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
use Yasumi\Tests\Netherlands\NetherlandsBaseTestCase;

/**
 * Class for testing Ash Wednesday.
 *
 * Ash Wednesday, a day of fasting, is the first day of Lent in Western Christianity. It occurs 46 days (40 fasting
 * days, if the 6 Sundays, which are not days of fast, are excluded) before Easter and can fall as early as 4 February
 * or as late as 10 March.
 */
class AshWednesdayTest extends NetherlandsBaseTestCase
{
    /**
     * Tests Ash Wednesday.
     */
    public function testAshWednesday()
    {
        $year = 1999;
        $this->assertHoliday(self::COUNTRY, 'ashWednesday', $year,
            new DateTime("$year-2-17", new DateTimeZone(self::TIMEZONE)));
    }
}
