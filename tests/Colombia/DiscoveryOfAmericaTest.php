<?php

declare(strict_types=1);

namespace Yasumi\tests\Colombia;

use Yasumi\Holiday;
use Yasumi\tests\HolidayTestCase;

/**
 * Class for testing the DiscoveryOfAmerica holiday in Colombia.
 */
class DiscoveryOfAmericaTest extends ColombiaBaseTestCase implements HolidayTestCase
{
    /**
     * The name of the holiday.
     */
    public const HOLIDAY = 'discoveryOfAmerica';

    /**
     * The year in which the holiday was first established.
     */
    public const ESTABLISHMENT_YEAR = 1492;

    /**
     * Tests the DiscoveryOfAmerica holiday on or after 1492.
     *
     * @throws \Exception
     */
    public function testDiscoveryOfAmericaOnAfter1492(): void
    {
        $year = $this->generateRandomYear(self::ESTABLISHMENT_YEAR);
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new \DateTime("{$year}-10-12", new \DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests the DiscoveryOfAmerica holiday before 1492.
     *
     * @throws \Exception
     */
    public function testDiscoveryOfAmericaBefore1492(): void
    {
        $year = $this->generateRandomYear(1400, self::ESTABLISHMENT_YEAR - 1);
        $this->assertNotHoliday(self::REGION, self::HOLIDAY, $year);
    }

    /**
     * Tests the translated name of the DiscoveryOfAmerica holiday.
     *
     * @throws \Exception
     */
    public function testTranslation(): void
    {
        $year = $this->generateRandomYear(self::ESTABLISHMENT_YEAR);
        $this->assertTranslatedHolidayName(self::REGION, self::HOLIDAY, $year, [self::LOCALE => 'Día de la Raza']);
    }

    /**
     * Tests the type of the DiscoveryOfAmerica holiday.
     *
     * @throws \Exception
     */
    public function testHolidayType(): void
    {
        $year = $this->generateRandomYear(self::ESTABLISHMENT_YEAR);
        $this->assertHolidayType(self::REGION, self::HOLIDAY, $year, Holiday::TYPE_OFFICIAL);
    }
}
