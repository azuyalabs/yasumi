<?php

declare(strict_types=1);

namespace Yasumi\tests\Mexico;

use Yasumi\Holiday;
use Yasumi\Provider\Mexico;
use Yasumi\tests\HolidayTestCase;

/**
 * Class for testing Day of the Dead in Mexico.
 */
class DayOfTheDeadTest extends MexicoBaseTestCase implements HolidayTestCase
{
    /**
     * The name of the holiday to be tested
     */
    public const HOLIDAY = 'dayOfTheDead';

    /**
     * Tests Day of the Dead.
     *
     * @throws \Exception
     */
    public function testDayOfTheDead(): void
    {
        $year = 2023; // Year to test
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new \DateTime("$year-11-02", new \DateTimeZone(self::TIMEZONE))
        );
    }
}
