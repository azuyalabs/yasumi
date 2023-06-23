<?php

declare(strict_types=1);

namespace Yasumi\tests\Mexico;

use Yasumi\Holiday;
use Yasumi\Provider\Mexico;
use Yasumi\tests\HolidayTestCase;

/**
 * Class for testing Virgin of Guadalupe in Mexico.
 */
class VirginOfGuadalupeTest extends MexicoBaseTestCase implements HolidayTestCase
{
    /**
     * The name of the holiday to be tested
     */
    public const HOLIDAY = 'virginOfGuadalupe';

    /**
     * Tests Virgin of Guadalupe.
     *
     * @throws \Exception
     */
    public function testVirginOfGuadalupe(): void
    {
        $year = 2023; // Year to test
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new \DateTime("$year-12-12", new \DateTimeZone(self::TIMEZONE))
        );
    }
}
