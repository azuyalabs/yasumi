<?php
/**
 *  This file is part of the Yasumi package.
 *
 *  Copyright (c) 2016 MGWebGroup
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 *
 *  @author Alex Kay <alex110504@gmail.com>
 */

namespace Yasumi\tests\USA;

use DateTime;
use DateTimeZone;
use Yasumi\Holiday;
use Yasumi\tests\YasumiTestCaseInterface;

/**
 * Class for testing Good Friday Day in the USA.
 */
class GoodFridayTest extends USABaseTestCase implements YasumiTestCaseInterface
{
    /**
     * The name of the holiday
     */
    const HOLIDAY = 'goodFriday';

    /**
     * Code to identify this Holiday Provider. Typically this is the ISO3166 code corresponding to the respective
     * country or subregion.
     */
    const ID = 'NYSE';

    /**
     * Tests Good Friday Day.
     */
    public function testgoodFriday()
    {
        $year = 2016;
        $this->assertHoliday(self::ID, self::HOLIDAY, $year,
            new DateTime("$year-03-25", new DateTimeZone(self::TIMEZONE)));
    }

     /**
     * Tests translated name of the holiday defined in this test.
     */
    public function testTranslation()
    {
        $this->assertTranslatedHolidayName(self::ID, self::HOLIDAY, $this->generateRandomYear(),
            [self::LOCALE => 'Good Friday']);
    }

    /**
     * Tests type of the holiday defined in this test.
     */
    public function testHolidayType()
    {
        $this->assertHolidayType(self::ID, self::HOLIDAY, $this->generateRandomYear(), Holiday::TYPE_BANK);
    }
}
