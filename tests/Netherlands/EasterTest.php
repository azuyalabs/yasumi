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
 * Class for testing Easter.
 *
 * Easter is a festival and holiday celebrating the resurrection of Jesus Christ from the dead. Easter is celebrated on
 * a date based on a certain number of days after March 21st. The date of Easter Day was defined by the Council of
 * Nicaea in AD325 as the Sunday after the first full moon which falls on or after the Spring Equinox.
 */
class EasterTest extends NetherlandsBaseTestCase
{
    /**
     * Tests Easter.
     */
    public function testEaster()
    {
        $year = 2010;
        $this->assertHoliday(self::COUNTRY, 'easter', $year,
            new DateTime("$year-4-4", new DateTimeZone(self::TIMEZONE)));
    }

    /**
     * Tests Easter.
     */
    public function testEasterMonday()
    {
        $year = 2010;
        $this->assertHoliday(self::COUNTRY, 'easterMonday', $year,
            new DateTime("$year-4-5", new DateTimeZone(self::TIMEZONE)));
    }
}
