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

namespace Yasumi\tests\Netherlands;

use DateTime;
use DateTimeZone;
use Yasumi\Holiday;
use Yasumi\tests\YasumiTestCaseInterface;

/**
 * Class for testing the second day of Carnival in the Netherlands.
 */
class secondCarnivalDay extends NetherlandsBaseTestCase implements YasumiTestCaseInterface
{

    /**
     * The name of the holiday to be tested
     */
    const HOLIDAY = 'secondCarnivalDay';

    /**
     * Tests the holiday defined in this test.
     *
     * @throws \Yasumi\Exception\UnknownLocaleException
     * @throws \InvalidArgumentException
     * @throws \PHPUnit_Framework_AssertionFailedError
     * @throws \RuntimeException
     */
    public function testHoliday()
    {
        $year = 2015;
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new DateTime("$year-2-16", new DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests type of the holiday defined in this test.
     *
     * @throws \InvalidArgumentException
     * @throws \PHPUnit_Framework_AssertionFailedError
     * @throws \RuntimeException
     * @throws \Yasumi\Exception\UnknownLocaleException
     */
    public function testHolidayType()
    {
        $this->assertHolidayType(self::REGION, self::HOLIDAY, $this->generateRandomYear(), Holiday::TYPE_OBSERVANCE);
    }

    /**
     * Tests the translated name of the holiday defined in this test.
     *
     * @throws \InvalidArgumentException
     * @throws \PHPUnit_Framework_AssertionFailedError
     * @throws \RuntimeException
     * @throws \Yasumi\Exception\UnknownLocaleException
     */
    public function testTranslation()
    {
        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(),
            [self::LOCALE => 'Carnaval']
        );
    }
}
