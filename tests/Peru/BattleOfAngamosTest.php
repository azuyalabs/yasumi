<?php

declare(strict_types=1);

namespace Yasumi\tests\Peru;

use Yasumi\Holiday;
use Yasumi\tests\HolidayTestCase;

/**
 * Class for testing the BattleOfAngamos holiday in Peru.
 */
class BattleOfAngamosTest extends PeruBaseTestCase implements HolidayTestCase
{
    /**
     * The name of the holiday.
     */
    public const HOLIDAY = 'battleOfAngamos';

    /**
     * The year in which the holiday was first established.
     */
    public const ESTABLISHMENT_YEAR = 1879;

    /**
     * Tests the BattleOfAngamos holiday on or after 1879.
     *
     * @throws \Exception
     */
    public function testBattleOfAngamosOnAfter1879(): void
    {
        $year = $this->generateRandomYear(self::ESTABLISHMENT_YEAR);
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new \DateTime("{$year}-10-08", new \DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests the BattleOfAngamos holiday before 1879.
     *
     * @throws \Exception
     */
    public function testBattleOfAngamosBefore1879(): void
    {
        $year = $this->generateRandomYear(1753, self::ESTABLISHMENT_YEAR - 1);
        $this->assertNotHoliday(self::REGION, self::HOLIDAY, $year);
    }

    /**
     * Tests the translated name of the BattleOfAngamos holiday.
     *
     * @throws \Exception
     */
    public function testTranslation(): void
    {
        $year = $this->generateRandomYear(self::ESTABLISHMENT_YEAR);
        $this->assertTranslatedHolidayName(self::REGION, self::HOLIDAY, $year, [self::LOCALE => 'Translation']);
    }

    /**
     * Tests the type of the BattleOfAngamos holiday.
     *
     * @throws \Exception
     */
    public function testHolidayType(): void
    {
        $year = $this->generateRandomYear(self::ESTABLISHMENT_YEAR);
        $this->assertHolidayType(self::REGION, self::HOLIDAY, $year, Holiday::TYPE_OTHER);
    }
}
