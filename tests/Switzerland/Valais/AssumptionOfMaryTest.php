<?php

declare(strict_types=1);
/*
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 - 2023 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <me at sachatelgenhof dot com>
 */

namespace Yasumi\tests\Switzerland\Valais;

use Yasumi\Holiday;
use Yasumi\tests\HolidayTestCase;

/**
 * Class for testing the day of the Assumption of Mary in Valais (Switzerland).
 */
class AssumptionOfMaryTest extends ValaisBaseTestCase implements HolidayTestCase
{
    /**
     * The name of the holiday.
     */
    public const HOLIDAY = 'assumptionOfMary';

    /**
     * Tests the day of the Assumption of Mary.
     *
     * @dataProvider AssumptionOfMaryDataProvider
     *
     * @param int       $year     the year for which the day of the Assumption of Mary needs to be tested
     * @param \DateTime $expected the expected date
     */
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
            $this->generateRandomYear(),
            [self::LOCALE => 'Assomption']
        );
    }

    /**
     * Tests type of the holiday defined in this test.
     *
     * @throws \Exception
     */
    public function testHolidayType(): void
    {
        $this->assertHolidayType(self::REGION, self::HOLIDAY, $this->generateRandomYear(), Holiday::TYPE_OTHER);
    }

    /**
     * Returns a list of random test dates used for assertion of the day of the Assumption of Mary.
     *
     * @return array<array> list of test dates for the day of the Assumption of Mary
     *
     * @throws \Exception
     */
    public function AssumptionOfMaryDataProvider(): array
    {
        return $this->generateRandomDates(8, 15, self::TIMEZONE);
    }
}
