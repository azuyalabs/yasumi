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
 * Class to test World Animal Day.
 *
 * World Animal Day is an international day of action for animal rights and welfare celebrated annually on October
 * 4, the Feast Day of St Francis of Assisi, the patron saint of animals. It started in 1931 at a convention of
 * ecologists in Florence, Italy who wished to highlight the plight of endangered species.
 *
 * @link http://en.wikipedia.org/wiki/World_Animal_Day Source: Wikipedia.
 */
class WorldAnimalDayTest extends NetherlandsBaseTestCase
{
    /**
     * The name of the holiday
     */
    const HOLIDAY = 'worldAnimalDay';

    /**
     * The year in which the holiday was first established
     */
    const ESTABLISHMENT_YEAR = 1931;

    /**
     * Tests World Animal Day on or after 1931.
     */
    public function testWorldAnimalDayOnAfter1931()
    {
        $year = $this->generateRandomYear(self::ESTABLISHMENT_YEAR);
        $this->assertHoliday(self::COUNTRY, self::HOLIDAY, $year,
            new DateTime("$year-10-4", new DateTimeZone(self::TIMEZONE)));

    }

    /**
     * Tests World Animal Day before 1931.
     */
    public function testWorldAnimalBefore1931()
    {
        $this->assertNotHoliday(self::COUNTRY, self::HOLIDAY,
            $this->generateRandomYear(1000, self::ESTABLISHMENT_YEAR - 1));
    }
}
