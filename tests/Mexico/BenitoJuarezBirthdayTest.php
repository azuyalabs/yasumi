<?php

declare(strict_types=1);

namespace Yasumi\tests\Mexico;

use Yasumi\Provider\Mexico;
use Yasumi\tests\HolidayTestCase;

/**
 * Class for testing Benito Juárez's Birthday in Mexico.
 */
class BenitoJuarezBirthdayTest extends MexicoBaseTestCase implements HolidayTestCase
{
    /**
     * The name of the holiday to be tested.
     */
    public const HOLIDAY = 'benitoJuarezBirthday';

    /**
     * The year in which the holiday was first established.
     */
    public const ESTABLISHMENT_YEAR = 1806;

    /**
     * Tests Benito Juárez's Birthday.
     *
     * @throws \Exception
     */
    public function testBenitoJuarezBirthday(): void
    {
        $year = 2023; // Year to test
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new \DateTime("{$year}-03-21", new \DateTimeZone(self::TIMEZONE))
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
        $this->assertTranslatedHolidayName(self::REGION, self::HOLIDAY, $year, [self::LOCALE => 'Natalicio de Benito Juárez']);
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
