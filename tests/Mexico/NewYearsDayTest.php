<?php

declare(strict_types=1);

namespace Yasumi\tests\Mexico;

use Yasumi\Holiday;
use Yasumi\tests\HolidayTestCase;

/**
 * Class for testing New Year's Day in Mexico.
 */
class NewYearsDayTest extends MexicoBaseTestCase implements HolidayTestCase
{
    /**
     * The name of the holiday.
     */
    public const HOLIDAY = 'newYearsDay';

    /**
     * Tests New Year's Day on or after 2006.
     *
     * @throws \Exception
     */
    public function testNewYearsDayOnAfter2006(): void
    {
        $year = $this->generateRandomYear(2006);
        $this->assertHoliday(self::REGION, self::HOLIDAY, $year, new \DateTime("{$year}-01-01"));
    }

    /**
     * Tests New Year's Day on or before 2006.
     *
     * @throws \Exception
     */
    public function testNewYearsDayOnBefore2006(): void
    {
        $year = $this->generateRandomYear(2000, 2005);
        $this->assertHoliday(self::REGION, self::HOLIDAY, $year, new \DateTime("{$year}-01-01"));
    }

    /**
     * Tests the translated name of the holiday defined in this test.
     *
     * @throws \Exception
     */
    public function testTranslation(): void
    {
        $year = $this->generateRandomYear(2006);
        $this->assertTranslatedHolidayName(self::REGION, self::HOLIDAY, $year, [self::LOCALE => 'Año Nuevo']);
    }

    /**
     * Tests type of the holiday defined in this test.
     *
     * @throws \Exception
     */
    public function testHolidayType(): void
    {
        $year = $this->generateRandomYear(2006);
        $this->assertHolidayType(self::REGION, self::HOLIDAY, $year, Holiday::TYPE_OFFICIAL);
    }
}
