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
 * Class for testing Father's Day.
 */
class FathersDayTest extends NetherlandsBaseTestCase
{

    /**
     * Tests Father's Day.
     */
    public function testFathersDay()
    {
        $year = $this->generateRandomYear();
        $this->assertHoliday(self::COUNTRY, 'fathersDay', $year,
            new DateTime("third sunday of june $year", new DateTimeZone(self::TIMEZONE)));
    }


}
