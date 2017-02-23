<?php
/**
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 - 2017 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <stelgenhof@gmail.com>
 */

namespace Yasumi\tests\UnitedKingdom;

use DateTime;
use DateTimeZone;
use Yasumi\Holiday;
use Yasumi\tests\YasumiTestCaseInterface;

/**
 * Class for testing New Years Day in the United Kingdom.
 */
class NewYearsDayTest extends UnitedKingdomBaseTestCase implements YasumiTestCaseInterface
{
    /**
     * The year in which the holiday was first established
     */
    const ESTABLISHMENT_YEAR = 1871;

    /**
     * The year in which the holiday was adjusted
     */
    const ADJUSTMENT_YEAR = 1974;

    /**
     * The name of the holiday to be tested
     */
    const HOLIDAY = 'newYearsDay';

    /**
     * Tests the holiday defined in this test on or after establishment.
     *
     * @dataProvider HolidayDataProvider
     *
     * @param int    $year     the year for which the holiday defined in this test needs to be tested
     * @param string $expected the expected date
     */
    public function testHolidayOnAfterEstablishment($year, $expected)
    {
        $this->assertHoliday(self::REGION, self::HOLIDAY, $year,
            new DateTime($expected, new DateTimeZone(self::TIMEZONE)));
    }

    /**
     * Tests the holiday defined in this test before establishment.
     */
    public function testHolidayBeforeEstablishment()
    {
        $this->assertNotHoliday(self::REGION, self::HOLIDAY,
            $this->generateRandomYear(1000, self::ESTABLISHMENT_YEAR - 1));
    }

    /**
     * Tests that the holiday defined in this test is of the type 'observance' before the year it was changed.
     */
    public function testHolidayIsObservedTypeBeforeChange()
    {
        $this->assertHolidayType(self::REGION, self::HOLIDAY,
            $this->generateRandomYear(self::ESTABLISHMENT_YEAR, self::ADJUSTMENT_YEAR - 1), Holiday::TYPE_OBSERVANCE);
    }

    /**
     * Returns a list of random test dates used for assertion of the holiday defined in this test
     *
     * @return array list of test dates for the holiday defined in this test
     */
    public function HolidayDataProvider()
    {
        $data = [];
        for ($y = 0; $y < 10; $y++) {
            $year = $this->generateRandomYear(self::ESTABLISHMENT_YEAR);
            $date = new DateTime("$year-01-01", new DateTimeZone(self::TIMEZONE));

            // If New Years Day falls on a Saturday or Sunday, it is observed the next Monday (January 2nd or 3rd)
            if (in_array((int) $date->format('w'), [0, 6], true)) {
                $date->modify('next monday');
            }

            $data[] = [$year, $date->format('Y-m-d')];
        }

        return $data;
    }

    /**
     * Tests the translated name of the holiday defined in this test.
     */
    public function testTranslation()
    {
        $this->assertTranslatedHolidayName(self::REGION, self::HOLIDAY,
            $this->generateRandomYear(self::ESTABLISHMENT_YEAR), [self::LOCALE => 'New Year\'s Day']);
    }

    /**
     * Tests type of the holiday defined in this test.
     */
    public function testHolidayType()
    {
        $this->assertHolidayType(self::REGION, self::HOLIDAY, $this->generateRandomYear(self::ADJUSTMENT_YEAR),
            Holiday::TYPE_BANK);
    }
}
