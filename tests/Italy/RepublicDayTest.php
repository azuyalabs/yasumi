<?php
/**
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 - 2018 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <stelgenhof@gmail.com>
 */

namespace Yasumi\tests\Italy;

use DateTime;
use DateTimeZone;
use Yasumi\Holiday;
use Yasumi\tests\YasumiTestCaseInterface;

/**
 * Class containing tests for Republic Day in Italy.
 *
 * Festa della Repubblica (in English, Republic Day) is the Italian National Day and Republic Day, which is celebrated
 * on 2 June each year. The day commemorates the institutional referendum held by universal suffrage in 1946, in which
 * the Italian people were called to the polls to decide on the form of government, following the Second World War and
 * the fall of Fascism.
 *
 * @link http://en.wikipedia.org/wiki/Festa_della_Repubblica
 */
class RepublicDayTest extends ItalyBaseTestCase implements YasumiTestCaseInterface
{
    /**
     * The name of the holiday
     */
    const HOLIDAY = 'republicDay';

    /**
     * The year in which the holiday was first established
     */
    const ESTABLISHMENT_YEAR = 1946;

    /**
     * Tests Republic Day on or after 1946.
     */
    public function testRepublicDayOnAfter1946()
    {
        $year = $this->generateRandomYear(self::ESTABLISHMENT_YEAR);
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new DateTime("$year-6-2", new DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests Republic Day before 1946.
     */
    public function testRepublicDayBefore1946()
    {
        $this->assertNotHoliday(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(1000, self::ESTABLISHMENT_YEAR - 1)
        );
    }

    /**
     * Tests translated name of Republic Day.
     */
    public function testTranslation()
    {
        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(self::ESTABLISHMENT_YEAR),
            [self::LOCALE => 'Festa della Republica']
        );
    }

    /**
     * Tests type of the holiday defined in this test.
     */
    public function testHolidayType()
    {
        $this->assertHolidayType(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(self::ESTABLISHMENT_YEAR),
            Holiday::TYPE_OFFICIAL
        );
    }
}
