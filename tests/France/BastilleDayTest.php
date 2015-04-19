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
namespace Yasumi\Tests\France;

use DateTime;
use DateTimeZone;

/**
 * Class containing tests for Bastille Day in France.
 */
class BastilleDayTest extends FranceBaseTestCase
{
    /**
     * The name of the holiday
     */
    const HOLIDAY = 'bastilleDay';

    /**
     * Tests Bastille Day on or after 1790.
     */
    public function testBastilleDayOnAfter1790()
    {
        $year = $this->generateRandomYear(1790);
        $this->assertHoliday(self::COUNTRY, self::HOLIDAY, $year,
            new DateTime("$year-7-14", new DateTimeZone(self::TIMEZONE)));
    }

    /**
     * Tests Bastille Day before 1790.
     */
    public function testBastilleDayBefore1790()
    {
        $this->assertNotHoliday(self::COUNTRY, self::HOLIDAY, $this->generateRandomYear(1000, 1789));
    }

    /**
     * Tests translated name of Bastille Day.
     */
    public function testTranslation()
    {
        $this->assertTranslatedHolidayName(self::COUNTRY, self::HOLIDAY, $this->generateRandomYear(1790),
            ['fr_FR' => 'La Fête nationale']);
    }
}
