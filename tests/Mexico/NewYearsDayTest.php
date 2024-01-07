<?php

declare(strict_types=1);

namespace Yasumi\tests\Mexico;

use Yasumi\Holiday;
use Yasumi\tests\HolidayTestCase;

class NewYearsDayTest extends MexicoBaseTestCase implements HolidayTestCase
{
    /**
     * The name of the holiday.
     */
    public const HOLIDAY = 'newYearsDay';

    /**
     * Tests New Years Day.
     *
     * @dataProvider NewYearsDayDataProvider
     *
     * @param int       $year     the year for which New Years Day needs to be tested
     * @param \DateTime $expected the expected date
     */
    public function testNewYearsDay(int $year, \DateTimeInterface $expected): void
    {
        $this->assertHoliday(self::REGION, self::HOLIDAY, $year, $expected);
    }

    /**
     * Returns a list of random test dates used for assertion of New Years Day.
     *
     * @return array<array> list of test dates for New Years Day
     *
     * @throws \Exception
     */
    public function NewYearsDayDataProvider(): array
    {
        return $this->generateRandomDates(1, 1, self::TIMEZONE);
    }

    /**
     * Tests translated name of New Years Day.
     *
     * @throws \Exception
     */
    public function testTranslation(): void
    {
        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(),
            [self::LOCALE => 'Año Nuevo']
        );
    }

    /**
     * Tests type of the holiday defined in this test.
     *
     * @throws \Exception
     */
    public function testHolidayType(): void
    {
        $this->assertHolidayType(self::REGION, self::HOLIDAY, $this->generateRandomYear(), Holiday::TYPE_OFFICIAL);
    }
}
