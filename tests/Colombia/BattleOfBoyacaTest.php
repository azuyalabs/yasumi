<?php

declare(strict_types=1);

namespace Yasumi\tests\Colombia;

use Yasumi\Holiday;
use Yasumi\tests\HolidayTestCase;

/**
 * Class for testing the BattleOfBoyaca holiday in Colombia.
 */
class BattleOfBoyacaTest extends ColombiaBaseTestCase implements HolidayTestCase
{
    /**
     * The name of the holiday.
     */
    public const HOLIDAY = 'battleOfBoyaca';

    /**
     * The year in which the holiday was first established.
     */
    public const ESTABLISHMENT_YEAR = 1819;

    /**
     * Tests the BattleOfBoyaca holiday on or after 1819.
     *
     * @throws \Exception
     */
    public function testBattleOfBoyacaOnAfter1819(): void
    {
        $year = $this->generateRandomYear(self::ESTABLISHMENT_YEAR);
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new \DateTime("{$year}-08-07", new \DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests the BattleOfBoyaca holiday before 1819.
     *
     * @throws \Exception
     */
    public function testBattleOfBoyacaBefore1819(): void
    {
        $year = $this->generateRandomYear(1810, self::ESTABLISHMENT_YEAR - 1);
        $this->assertNotHoliday(self::REGION, self::HOLIDAY, $year);
    }

    /**
     * Tests the translated name of the BattleOfBoyaca holiday.
     *
     * @throws \Exception
     */
    public function testTranslation(): void
    {
        $year = $this->generateRandomYear(self::ESTABLISHMENT_YEAR);
        $this->assertTranslatedHolidayName(self::REGION, self::HOLIDAY, $year, [self::LOCALE => 'Batalla de Boyacá']);
    }

    /**
     * Tests the type of the BattleOfBoyaca holiday.
     *
     * @throws \Exception
     */
    public function testHolidayType(): void
    {
        $year = $this->generateRandomYear(self::ESTABLISHMENT_YEAR);
        $this->assertHolidayType(self::REGION, self::HOLIDAY, $year, Holiday::TYPE_OFFICIAL);
    }
}
