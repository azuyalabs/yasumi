<?php

declare(strict_types=1);

namespace Yasumi\tests\Colombia;

use Yasumi\Holiday;
use Yasumi\tests\HolidayTestCase;

/**
 * Class for testing the AllSaintsDay holiday in Colombia.
 */
class AllSaintsDayTest extends ColombiaBaseTestCase implements HolidayTestCase
{
    /**
     * The name of the holiday.
     */
    public const HOLIDAY = 'allSaintsDay';

    /**
     * The year in which the holiday was first established.
     */
    public const ESTABLISHMENT_YEAR = 609;

    /**
     * Tests the AllSaintsDay holiday on or after 609.
     *
     * @throws \Exception
     */
    public function testAllSaintsDayOnAfter609(): void
    {
        $year = $this->generateRandomYear(self::ESTABLISHMENT_YEAR);
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new \DateTime("{$year}-11-01", new \DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests the AllSaintsDay holiday before 609.
     *
     * @throws \Exception
     */
    public function testAllSaintsDayBefore609(): void
    {
        $year = $this->generateRandomYear(500, self::ESTABLISHMENT_YEAR - 1);
        $this->assertNotHoliday(self::REGION, self::HOLIDAY, $year);
    }

    /**
     * Tests the translated name of the AllSaintsDay holiday.
     *
     * @throws \Exception
     */
    public function testTranslation(): void
    {
        $year = $this->generateRandomYear(self::ESTABLISHMENT_YEAR);
        $this->assertTranslatedHolidayName(self::REGION, self::HOLIDAY, $year, [self::LOCALE => 'Día de Todos los Santos']);
    }

    /**
     * Tests the type of the AllSaintsDay holiday.
     *
     * @throws \Exception
     */
    public function testHolidayType(): void
    {
        $year = $this->generateRandomYear(self::ESTABLISHMENT_YEAR);
        $this->assertHolidayType(self::REGION, self::HOLIDAY, $year, Holiday::TYPE_OFFICIAL);
    }
}
