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

namespace Yasumi\tests\Switzerland\Ticino;

use Yasumi\Holiday;
use Yasumi\tests\YasumiTestCaseInterface;

/**
 * Class for testing Feast of Saints Peter and Paul in Ticino (Switzerland).
 */
class StPeterPaulTest extends TicinoBaseTestCase implements YasumiTestCaseInterface
{

    /**
     * The name of the holiday
     */
    const HOLIDAY = 'stPeterPaul';

    /**
     * Tests Feast of Saints Peter and Paul.
     *
     * @dataProvider StPeterPaulDataProvider
     *
     * @param int       $year     the year for which Feast of Saints Peter and Paul needs to be tested
     * @param \DateTime $expected the expected date
     */
    public function testStPeterPaul($year, $expected)
    {
        $this->assertHoliday(self::REGION, self::HOLIDAY, $year, $expected);
    }

    /**
     * Returns a list of random test dates used for assertion of Feast of Saints Peter and Paul.
     *
     * @return array list of test dates for Feast of Saints Peter and Paul
     */
    public function StPeterPaulDataProvider(): array
    {
        return $this->generateRandomDates(6, 29, self::TIMEZONE);
    }

    /**
     * Tests translated name of the holiday defined in this test.
     */
    public function testTranslation()
    {
        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(),
            [self::LOCALE => 'Santi Pietro e Paolo']
        );
    }

    /**
     * Tests type of the holiday defined in this test.
     */
    public function testHolidayType()
    {
        $this->assertHolidayType(self::REGION, self::HOLIDAY, $this->generateRandomYear(), Holiday::TYPE_OTHER);
    }
}
