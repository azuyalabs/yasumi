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

namespace Yasumi\tests\Switzerland\Vaud;

use DateInterval;
use DateTime;
use DateTimeZone;
use Yasumi\Holiday;
use Yasumi\tests\YasumiTestCaseInterface;

/**
 * Class for testing Bettags Montag in Vaud (Switzerland).
 */
class BettagsMontagTest extends VaudBaseTestCase implements YasumiTestCaseInterface
{
    /**
     * The name of the holiday
     */
    const HOLIDAY = 'bettagsMontag';

    /**
     * Tests Bettags Montag on or after 1832
     */
    public function testBettagsMontagOnAfter1832()
    {
        $year = $this->generateRandomYear(1832);

        // Find third Sunday of September
        $date = new DateTime('Third Sunday of '.$year.'-09', new DateTimeZone(self::TIMEZONE));
        // Go to next Thursday
        $date->add(new DateInterval('P1D'));

        $this->assertHoliday(self::REGION, self::HOLIDAY, $year, $date);
    }

    /**
     * Tests Bettags Montag before 1832
     */
    public function testBettagsMontagBefore1832()
    {
        $year = $this->generateRandomYear(1000, 1831);
        $this->assertNotHoliday(self::REGION, self::HOLIDAY, $year);
    }

    /**
     * Tests translated name of Bettags Montag.
     */
    public function testTranslation()
    {
        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(1832),
            [self::LOCALE => 'Jeûne fédéral']
        );
    }

    /**
     * Tests type of the holiday defined in this test.
     */
    public function testHolidayType()
    {
        $this->assertHolidayType(self::REGION, self::HOLIDAY, $this->generateRandomYear(1900), Holiday::TYPE_OTHER);
    }
}
