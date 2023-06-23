<?php

declare(strict_types=1);

namespace Yasumi\tests\Colombia;

use Yasumi\Holiday;
use Yasumi\tests\HolidayTestCase;

/**
 * Class for testing the ImmaculateConception holiday in Colombia.
 */
class ImmaculateConceptionTest extends ColombiaBaseTestCase implements HolidayTestCase
{
    /**
     * The name of the holiday.
     */
    public const HOLIDAY = 'immaculateConception';

    /**
     * The year in which the holiday was first established.
     */
    public const ESTABLISHMENT_YEAR = 1854;

    /**
     * Tests the ImmaculateConception holiday on or after 1854.
     *
     * @throws \Exception
     */
    public function testImmaculateConceptionOnAfter1854(): void
    {
        $year = $this->generateRandomYear(self::ESTABLISHMENT_YEAR);
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new \DateTime("{$year}-12-08", new \DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests the ImmaculateConception holiday before 1854.
     *
     * @throws \Exception
     */
    public function testImmaculateConceptionBefore1854(): void
    {
        $year = $this->generateRandomYear(1800, self::ESTABLISHMENT_YEAR - 1);
        $this->assertNotHoliday(self::REGION, self::HOLIDAY, $year);
    }

    /**
     * Tests the translated name of the ImmaculateConception holiday.
     *
     * @throws \Exception
     */
    public function testTranslation(): void
    {
        $year = $this->generateRandomYear(self::ESTABLISHMENT_YEAR);
        $this->assertTranslatedHolidayName(self::REGION, self::HOLIDAY, $year, [self::LOCALE => 'Translation']);
    }

    /**
     * Tests the type of the ImmaculateConception holiday.
     *
     * @throws \Exception
     */
    public function testHolidayType(): void
    {
        $year = $this->generateRandomYear(self::ESTABLISHMENT_YEAR);
        $this->assertHolidayType(self::REGION, self::HOLIDAY, $year, Holiday::TYPE_NATIONAL);
    }
}
