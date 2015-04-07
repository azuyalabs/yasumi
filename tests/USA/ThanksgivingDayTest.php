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
 * Class for testing Thanksgiving Day in the USA.
 *
 * Thanksgiving, or Thanksgiving Day, is a holiday celebrated in the United States on the fourth Thursday in November.
 * It has been celebrated as a federal holiday every year since 1863, when, during the Civil War, President Abraham
 * Lincoln proclaimed a national day of "Thanksgiving and Praise to our beneficent Father who dwelleth in the Heavens",
 * to be celebrated on the last Thursday in November.
 *
 * @link http://en.wikipedia.org/wiki/Thanksgiving_(United_States) Source: Wikipedia.
 */
class ThanksgivingDayDayTest extends USABaseTestCase
{
    /**
     * The name of the holiday
     */
    const HOLIDAY = 'thanksgivingDay';

    /**
     * Tests ThanksgivingDay Day on or after 1863. ThanksgivingDay Day is celebrated since 1863 on the fourth Thursday
     * of November.
     */
    public function testThanksgivingDayOnAfter1863()
    {
        $year = $this->generateRandomYear(1863);
        $this->assertHoliday(self::COUNTRY, self::HOLIDAY, $year,
            new DateTime("fourth thursday of november $year", new DateTimeZone(self::TIMEZONE)));
    }

    /**
     * Tests ThanksgivingDay Day before 1863. ThanksgivingDay Day is celebrated since 1863 on the fourth Thursday
     * of November.
     */
    public function testThanksgivingDayBefore1863()
    {
        $this->assertNotHoliday(self::COUNTRY, self::HOLIDAY, $this->generateRandomYear(1000, 1862));
    }
}
