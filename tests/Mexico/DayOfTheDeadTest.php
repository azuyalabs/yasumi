<?php

declare(strict_types=1);

namespace Yasumi\tests\Mexico;

use Yasumi\Provider\Mexico;
use Yasumi\tests\HolidayTestCase;

/**
 * Class for testing Day of the Dead in Mexico.
 */
class DayOfTheDeadTest extends MexicoBaseTestCase implements HolidayTestCase
{
    /**
     * The name of the holiday to be tested.
     */
    public const HOLIDAY = 'dayOfTheDead';

    /**
     * The year in which the holiday was first established.
     */
    public const ESTABLISHMENT_YEAR = 1519;

    /**
     * Tests Day of the Dead.
     *
     * @throws \Exception
     */
    public function testDayOfTheDead(): void
    {
        $year = 2023; // Year to test
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new \DateTime("{$year}-11-02", new \DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests the translated name of the holiday defined in this test.
     *
     * @throws \Exception
     */
    public function testTranslation(): void
    {
        $year = $this->generateRandomYear(self::ESTABLISHMENT_YEAR);
        $this->assertTranslatedHolidayName(self::REGION, self::HOLIDAY, $year, [self::LOCALE => 'Día de los Muertos']);
    }

    /**
     * Tests type of the holiday defined in this test.
     *
     * @throws \Exception
     */
    public function testHolidayType(): void
    {
        $year = $this->generateRandomYear(self::ESTABLISHMENT_YEAR);
        $this->assertHolidayType(self::REGION, self::HOLIDAY, $year, Holiday::TYPE_OFFICIAL);
    }
}
