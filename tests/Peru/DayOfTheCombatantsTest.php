<?php

declare(strict_types=1);

namespace Yasumi\tests\Peru;

use Yasumi\Holiday;
use Yasumi\tests\HolidayTestCase;

/**
 * Class for testing the DayOfTheCombatants holiday in Peru.
 */
class DayOfTheCombatantsTest extends PeruBaseTestCase implements HolidayTestCase
{
    /**
     * The name of the holiday.
     */
    public const HOLIDAY = 'dayOfTheCombatants';

    /**
     * The year in which the holiday was first established.
     */
    public const ESTABLISHMENT_YEAR = 1880;

    /**
     * Tests the DayOfTheCombatants holiday on or after 1880.
     *
     * @throws \Exception
     */
    public function testDayOfTheCombatantsOnAfter1880(): void
    {
        $year = $this->generateRandomYear(self::ESTABLISHMENT_YEAR);
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new \DateTime("{$year}-06-07", new \DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests the DayOfTheCombatants holiday before 1880.
     *
     * @throws \Exception
     */
    public function testDayOfTheCombatantsBefore1880(): void
    {
        $year = $this->generateRandomYear(1753, self::ESTABLISHMENT_YEAR - 1);
        $this->assertNotHoliday(self::REGION, self::HOLIDAY, $year);
    }

    /**
     * Tests the translated name of the DayOfTheCombatants holiday.
     *
     * @throws \Exception
     */
    public function testTranslation(): void
    {
        $year = $this->generateRandomYear(self::ESTABLISHMENT_YEAR);
        $this->assertTranslatedHolidayName(self::REGION, self::HOLIDAY, $year, [self::LOCALE => 'Día del Combate']);
    }

    /**
     * Tests the type of the DayOfTheCombatants holiday.
     *
     * @throws \Exception
     */
    public function testHolidayType(): void
    {
        $year = $this->generateRandomYear(self::ESTABLISHMENT_YEAR);
        $this->assertHolidayType(self::REGION, self::HOLIDAY, $year, Holiday::TYPE_OTHER);
    }
}
