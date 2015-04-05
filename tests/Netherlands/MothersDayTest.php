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
 * Class for testing Mother's Day.
 *
 * Mother's Day is a modern celebration honoring one's own mother, as well as motherhood, maternal bonds, and the
 * influence of mothers in society. In the Netherlands, Mother's Day (Dutch: Moederdag) is celebrated on the second
 * Sunday of May and is not a public holiday.
 */
class MothersDayTest extends NetherlandsBaseTestCase
{
    /**
     * Tests Mother's Day.
     */
    public function testMothersDay()
    {
        $year = $this->generateRandomYear();
        $this->assertHoliday(self::COUNTRY, 'mothersDay', $year,
            new DateTime("second sunday of may $year", new DateTimeZone(self::TIMEZONE)));
    }
}
