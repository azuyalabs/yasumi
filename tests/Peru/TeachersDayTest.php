<?php

declare(strict_types=1);

namespace Yasumi\tests\Peru;

use Yasumi\Holiday;
use Yasumi\tests\HolidayTestCase;

/**
 * Class for testing the TeachersDay holiday in Peru.
 */
class TeachersDayTest extends PeruBaseTestCase implements HolidayTestCase
{
    /**
     * The name of the holiday.
     */
    public const HOLIDAY = 'teachersDay';

    /**
     * The year in which the holiday was first established.
     */
    public const ESTABLISHMENT_YEAR = 1953;

    /**
     * Tests the TeachersDay holiday on or after 1953.
     *
     * @throws \Exception
     */
    public function testTeachersDayOnAfter1953(): void
    {
        $year = $this->generateRandomYear(self::ESTABLISHMENT_YEAR);
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new \DateTime("{$year}-07-06", new \DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests the TeachersDay holiday before 1953.
     *
     * @throws \Exception
     */
    public function testTeachersDayBefore1953(): void
    {
        $year = $this->generateRandomYear(1753, self::ESTABLISHMENT_YEAR - 1);
        $this->assertNotHoliday(self::REGION, self::HOLIDAY, $year);
    }

    /**
     * Tests the translated name of the TeachersDay holiday.
     *
     * @throws \Exception
     */
    public function testTranslation(): void
    {
        $year = $this->generateRandomYear(self::ESTABLISHMENT_YEAR);
        $this->assertTranslatedHolidayName(self::REGION, self::HOLIDAY, $year, [self::LOCALE => 'Día del Maestro']);
    }

    /**
     * Tests the type of the TeachersDay holiday.
     *
     * @throws \Exception
     */
    public function testHolidayType(): void
    {
        $year = $this->generateRandomYear(self::ESTABLISHMENT_YEAR);
        $this->assertHolidayType(self::REGION, self::HOLIDAY, $year, Holiday::TYPE_OTHER);
    }
}
