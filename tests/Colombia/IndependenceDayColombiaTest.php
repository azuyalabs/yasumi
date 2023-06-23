<?php

declare(strict_types=1);

namespace Yasumi\tests\Colombia;

use Yasumi\Holiday;
use Yasumi\tests\HolidayTestCase;

/**
 * Class for testing the IndependenceDayColombia holiday in Colombia.
 */
class IndependenceDayColombiaTest extends ColombiaBaseTestCase implements HolidayTestCase
{
    /**
     * The name of the holiday.
     */
    public const HOLIDAY = 'independenceDayColombia';

    /**
     * The year in which the holiday was first established.
     */
    public const ESTABLISHMENT_YEAR = 1810;

    /**
     * Tests the IndependenceDayColombia holiday on or after 1810.
     *
     * @throws \Exception
     */
    public function testIndependenceDayColombiaOnAfter1810(): void
    {
        $year = $this->generateRandomYear(self::ESTABLISHMENT_YEAR);
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new \DateTime("{$year}-07-20", new \DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests the IndependenceDayColombia holiday before 1810.
     *
     * @throws \Exception
     */
    public function testIndependenceDayColombiaBefore1810(): void
    {
        $year = $this->generateRandomYear(1800, self::ESTABLISHMENT_YEAR - 1);
        $this->assertNotHoliday(self::REGION, self::HOLIDAY, $year);
    }

    /**
     * Tests the translated name of the IndependenceDayColombia holiday.
     *
     * @throws \Exception
     */
    public function testTranslation(): void
    {
        $year = $this->generateRandomYear(self::ESTABLISHMENT_YEAR);
        $this->assertTranslatedHolidayName(self::REGION, self::HOLIDAY, $year, [self::LOCALE => 'Translation']);
    }

    /**
     * Tests the type of the IndependenceDayColombia holiday.
     *
     * @throws \Exception
     */
    public function testHolidayType(): void
    {
        $year = $this->generateRandomYear(self::ESTABLISHMENT_YEAR);
        $this->assertHolidayType(self::REGION, self::HOLIDAY, $year, Holiday::TYPE_NATIONAL);
    }
}
