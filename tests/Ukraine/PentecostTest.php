<?php

namespace Yasumi\tests\Ukraine;

use DateTime;
use DateTimeZone;
use Yasumi\tests\YasumiTestCaseInterface;
use Yasumi\Holiday;

/**
 * Class PentecostTest
 * @package Yasumi\tests\Ukraine
 */
class PentecostTest extends UkraineBaseTestCase implements YasumiTestCaseInterface
{
    /**
     * The name of the holiday
     */
    const HOLIDAY = 'pentecost';

    /**
     * Tests the holiday defined in this test.
     */
    public function testHoliday()
    {
        $year = 2020;
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new DateTime("$year-06-07", new DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests the translated name of the holiday defined in this test.
     */
    public function testTranslation()
    {
        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(),
            [self::LOCALE => 'Трійця']
        );
    }

    /**
     * Tests type of the holiday defined in this test.
     */
    public function testHolidayType()
    {
        $this->assertHolidayType(self::REGION, self::HOLIDAY, $this->generateRandomYear(), Holiday::TYPE_NATIONAL);
    }
}
