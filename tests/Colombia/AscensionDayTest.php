<?php

declare(strict_types=1);

namespace Yasumi\tests\Colombia;

use Yasumi\Holiday;
use Yasumi\tests\HolidayTestCase;

/**
 * Class for testing Ascension Day in Colombia.
 */
class AscensionDayTest extends ColombiaBaseTestCase implements HolidayTestCase
{
    /**
     * The name of the holiday.
     */
    public const HOLIDAY = 'ascensionDay';

    /**
     * The year in which the holiday was first established.
     */
    public const ESTABLISHMENT_YEAR = 1753;

    /**
     * Tests Ascension Day on or after 1753.
     *
     * @throws \Exception
     */
    public function testAscensionDayOnOrAfter1753(): void
    {
        $year = $this->generateRandomYear(self::ESTABLISHMENT_YEAR);
        $easter = $this->calculateEaster($year, $this->getTimeZone(self::REGION));
        $expectedDate = $easter->add(new \DateInterval('P40D'));
        $this->assertHoliday(self::REGION, self::HOLIDAY, $year, $expectedDate->format('Y-m-d'));
    }

    /**
     * Tests Ascension Day before 1753.
     *
     * @throws \Exception
     */
    public function testAscensionDayBefore1753(): void
    {
        $year = $this->generateRandomYear(1000, self::ESTABLISHMENT_YEAR - 1);
        $this->assertNotHoliday(self::REGION, self::HOLIDAY, $year);
    }

    /**
     * Tests the translated name of the holiday defined in this test.
     *
     * @throws \Exception
     */
    public function testTranslation(): void
    {
        $year = $this->generateRandomYear(self::ESTABLISHMENT_YEAR);
        $this->assertTranslatedHolidayName(self::REGION, self::HOLIDAY, $year, [self::LOCALE => 'Día de la Ascensión']);
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
