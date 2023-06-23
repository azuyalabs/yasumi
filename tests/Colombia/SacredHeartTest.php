<?php

declare(strict_types=1);

namespace Yasumi\tests\Colombia;

use Yasumi\Holiday;
use Yasumi\tests\HolidayTestCase;

/**
 * Class for testing Sacred Heart in Colombia.
 */
class SacredHeartTest extends ColombiaBaseTestCase implements HolidayTestCase
{
    /**
     * The name of the holiday.
     */
    public const HOLIDAY = 'sacredHeart';

    /**
     * The year in which the holiday was first established.
     */
    public const ESTABLISHMENT_YEAR = 1753;

    /**
     * Tests Sacred Heart on or after 1753.
     *
     * @throws \Exception
     */
    public function testSacredHeartOnOrAfter1753(): void
    {
        $year = $this->generateRandomYear(self::ESTABLISHMENT_YEAR);
        $easter = $this->calculateEaster($year, $this->getTimeZone(self::REGION));
        $expectedDate = $easter->add(new \DateInterval('P68D'));
        $this->assertHoliday(self::REGION, self::HOLIDAY, $year, $expectedDate->format('Y-m-d'));
    }

    /**
     * Tests Sacred Heart before 1753.
     *
     * @throws \Exception
     */
    public function testSacredHeartBefore1753(): void
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
        $this->assertTranslatedHolidayName(self::REGION, self::HOLIDAY, $year, [self::LOCALE => 'Sagrado Corazón']);
    }

    /**
     * Tests type of the holiday defined in this test.
     *
     * @throws \Exception
     */
    public function testHolidayType(): void
    {
        $year = $this->generateRandomYear(self::ESTABLISHMENT_YEAR);
        $this->assertHolidayType(self::REGION, self::HOLIDAY, $year, Holiday::TYPE_OBSERVANCE);
    }
}
