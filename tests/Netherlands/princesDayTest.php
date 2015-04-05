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
 * Class for testing Prince's Day.
 *
 * Prinsjesdag (English: Prince's Day) is the day on which the reigning monarch of the Netherlands addresses a joint
 * session of the Dutch Senate and House of Representatives. Prince's Day is taking place on the third tuesday of
 * september.
 */
class PrincesDayTest extends NetherlandsBaseTestCase
{
    /**
     * Tests Prince's Day.
     */
    public function testPrincesDay()
    {
        $year = $this->generateRandomYear();
        $this->assertHoliday(self::COUNTRY, 'princesDay', $year,
            new DateTime("third tuesday of september $year", new DateTimeZone(self::TIMEZONE)));
    }
}
