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
 * Class containing tests for Victory in Europe Day in France.
 */
class VictoryInEuropeDayTest extends FranceBaseTestCase
{
    /**
     * The name of the holiday
     */
    const HOLIDAY = 'victoryInEuropeDay';

    /**
     * The year in which the holiday was first established
     */
    const ESTABLISHMENT_YEAR = 1945;

    /**
     * Tests Victory In Europe Day on or after 1945.
     */
    public function testVictoryInEuropeDayOnAfter1945()
    {
        $year = $this->generateRandomYear(self::ESTABLISHMENT_YEAR);
        $this->assertHoliday(self::COUNTRY, self::HOLIDAY, $year,
            new DateTime("$year-5-8", new DateTimeZone(self::TIMEZONE)));
    }

    /**
     * Tests Victory In Europe Day before 1945.
     */
    public function testVictoryInEuropeDayBefore1945()
    {
        $this->assertNotHoliday(self::COUNTRY, self::HOLIDAY,
            $this->generateRandomYear(1000, self::ESTABLISHMENT_YEAR - 1));
    }

    /**
     * Tests translated name of Victory in Europe Day.
     */
    public function testTranslation()
    {
        $this->assertTranslatedHolidayName(self::COUNTRY, self::HOLIDAY,
            $this->generateRandomYear(self::ESTABLISHMENT_YEAR),
            ['fr_FR' => 'Fête de la Victoire']);
    }
}
