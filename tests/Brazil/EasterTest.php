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

namespace Yasumi\tests\Brazil;

use Yasumi\Holiday;
use Yasumi\Provider\ChristianHolidays;
use Yasumi\tests\YasumiTestCaseInterface;

/**
 * Class for testing Easter in Brazil.
 */
class EasterTest extends BrazilBaseTestCase implements YasumiTestCaseInterface
{
    use ChristianHolidays;

    /**
     * The name of the holiday
     */
    const HOLIDAY = 'easter';

    /**
     * Tests Easter.
     */
    public function testEaster()
    {
        $year = 1948;
        $this->assertHoliday(self::REGION, self::HOLIDAY, $year, $this->calculateEaster($year, self::TIMEZONE));
    }

    /**
     * Tests translated name of the holiday defined in this test.
     */
    public function testTranslation()
    {
        $this->assertTranslatedHolidayName(self::REGION, self::HOLIDAY, $this->generateRandomYear(),
            [self::LOCALE => 'Páscoa']);
    }

    /**
     * Tests type of the holiday defined in this test.
     */
    public function testHolidayType()
    {
        $this->assertHolidayType(self::REGION, self::HOLIDAY, $this->generateRandomYear(), Holiday::TYPE_OBSERVANCE);
    }
}
