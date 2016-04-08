<?php
/**
 *  This file is part of the Yasumi package.
 *
 *  Copyright (c) 2015 - 2016 AzuyaLabs
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 *
 *  @author Sacha Telgenhof <stelgenhof@gmail.com>
 */

namespace Yasumi\tests\Greece;

use DateTime;

/**
 * Class containing tests for Annunciation in Greece.
 */
class AnnunciationTest extends GreeceBaseTestCase
{
    /**
     * The name of the holiday
     */
    const HOLIDAY = 'annunciation';

    /**
     * Tests Epiphany.
     *
     * @dataProvider AnnunciationDataProvider
     *
     * @param int      $year     the year for which Annunciation needs to be tested
     * @param DateTime $expected the expected date
     */
    public function testAnnunciation($year, $expected)
    {
        $this->assertHoliday(self::REGION, self::HOLIDAY, $year, $expected);
    }

    /**
     * Returns a list of random test dates used for assertion of Annunciation.
     *
     * @return array list of test dates for Annunciation
     */
    public function AnnunciationDataProvider()
    {
        return $this->generateRandomDates(3, 25, self::TIMEZONE);
    }

    /**
     * Tests translated name of Annunciation.
     */
    public function testTranslation()
    {
        $this->assertTranslatedHolidayName(self::REGION, self::HOLIDAY, $this->generateRandomYear(),
            ['el_GR' => 'Ευαγγελισμός της Θεοτόκου']);
    }
}
