<?php

declare(strict_types=1);

namespace Yasumi\tests\Mexico;

use Yasumi\Holiday;
use Yasumi\tests\HolidayTestCase;

/**
 * Class for testing Constitution Day in Mexico.
 */
class ConstitutionDayTest extends MexicoBaseTestCase implements HolidayTestCase
{
    /**
     * The name of the holiday.
     */
    public const HOLIDAY = 'constitutionDay';

    /**
     * Tests Constitution Day on or after 1917.
     *
     * @throws \Exception
     */
    public function testConstitutionDayOnAfter1917(): void
    {
        $year = $this->generateRandomYear(1917);
        $this->assertHoliday(self::REGION, self::HOLIDAY, $year, new \DateTime("$year-02-05"));
    }

    /**
     * Tests Constitution Day on or before 1917.
     *
     * @throws \Exception
     */
    public function testConstitutionDayOnBefore1917(): void
    {
        $year = $this->generateRandomYear(1910, 1916);
        $this->assertNotHoliday(self::REGION, self::HOLIDAY, $year);
    }

    /**
     * Tests the translated name of the holiday defined in this test.
     *
     * @throws \Exception
     */
    public function testTranslation(): void
    {
        $year = $this->generateRandomYear(1917);
        $this->assertTranslatedHolidayName(self::REGION, self::HOLIDAY, $year, [self::LOCALE => 'Día de la Constitución']);
    }

    /**
     * Tests type of the holiday defined in this test.
     *
     * @throws \Exception
     */
    public function testHolidayType(): void
    {
        $year = $this->generateRandomYear(1917);
        $this->assertHolidayType(self::REGION, self::HOLIDAY, $year, Holiday::TYPE_OFFICIAL);
    }
}
