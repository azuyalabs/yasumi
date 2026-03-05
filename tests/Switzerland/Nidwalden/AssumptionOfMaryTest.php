<?php

declare(strict_types = 1);

/**
 * This file is part of the 'Yasumi' package.
 *
 * The easy PHP Library for calculating holidays.
 *
 * Copyright (c) 2015 - 2026 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <me at sachatelgenhof dot com>
 */

namespace Yasumi\tests\Switzerland\Nidwalden;

use Yasumi\Holiday;
use Yasumi\tests\HolidayTestCase;

/**
 * Class for testing the day of the Assumption of Mary in Nidwalden (Switzerland).
 */
class AssumptionOfMaryTest extends NidwaldenBaseTestCase implements HolidayTestCase
{
    /**
     * The name of the holiday.
     */
    public const HOLIDAY = 'assumptionOfMary';

    /**
     * Tests the day of the Assumption of Mary.
     *
     * @param int       $year     the year for which the day of the Assumption of Mary needs to be tested
     * @param \DateTime $expected the expected date
     */
    #[\PHPUnit\Framework\Attributes\DataProvider('AssumptionOfMaryDataProvider')]
    public function testAssumptionOfMary(int $year, \DateTimeInterface $expected): void
    {
        $this->assertHoliday(self::REGION, self::HOLIDAY, $year, $expected);
    }

    /**
     * Tests translated name of the day of the Assumption of Mary.
     *
     * @throws \Exception
     */
    public function testTranslation(): void
    {
        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            static::generateRandomYear(),
            [self::LOCALE => 'Mariä Himmelfahrt']
        );
    }

    /**
     * Tests type of the holiday defined in this test.
     *
     * @throws \Exception
     */
    public function testHolidayType(): void
    {
        $this->assertHolidayType(self::REGION, self::HOLIDAY, static::generateRandomYear(), Holiday::TYPE_OTHER);
    }

    /**
     * Returns a list of random test dates used for assertion of the day of the Assumption of Mary.
     *
     * @return array<array> list of test dates for the day of the Assumption of Mary
     *
     * @throws \Exception
     */
    public static function AssumptionOfMaryDataProvider(): array
    {
        return static::generateRandomDates(8, 15, self::TIMEZONE);
    }
}
