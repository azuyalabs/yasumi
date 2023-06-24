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
}
