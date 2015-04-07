<?php
/*
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Yasumi\Tests\USA;

use DateTime;
use DateTimeZone;

/**
 * Class for testing Labour Day in the USA.
 *
 * Labor Day in the United States is a holiday celebrated on the first Monday in September. It is a celebration of the
 * American labor movement and is dedicated to the social and economic achievements of workers.
 *
 * @link http://en.wikipedia.org/wiki/Labor_Day Source: Wikipedia.
 */
class LabourDayTest extends USABaseTestCase
{
    /**
     * The name of the holiday
     */
    const HOLIDAY = 'labourDay';

    /**
     * Tests Labour Day on or after 1887. Labour Day was established since 1887 on the first Monday of September.
     */
    public function testLabourDayOnAfter1887()
    {
        $year = $this->generateRandomYear(1887);
        $this->assertHoliday(self::COUNTRY, self::HOLIDAY, $year,
            new DateTime("first monday of september $year", new DateTimeZone(self::TIMEZONE)));
    }

    /**
     * Tests Labour Day before 1887. Labour Day was established since 1887 on the first Monday of September.
     */
    public function testLabourDayBefore1887()
    {
        $this->assertNotHoliday(self::COUNTRY, self::HOLIDAY, $this->generateRandomYear(1000, 1886));
    }
}
