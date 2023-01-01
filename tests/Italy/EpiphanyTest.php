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

namespace Yasumi\tests\Italy;

use Yasumi\Holiday;
use Yasumi\tests\HolidayTestCase;

/**
 * Class containing tests for Epiphany in Italy.
 */
class EpiphanyTest extends ItalyBaseTestCase implements HolidayTestCase
{
    /**
     * The name of the holiday.
     */
    public const HOLIDAY = 'epiphany';

    /**
     * Tests Epiphany.
     *
     * @dataProvider EpiphanyDataProvider
     *
     * @param int       $year     the year for which Epiphany needs to be tested
     * @param \DateTime $expected the expected date
     */
    public function testEpiphany(int $year, \DateTimeInterface $expected): void
    {
        $this->assertHoliday(self::REGION, self::HOLIDAY, $year, $expected);
    }

    /**
     * Returns a list of random test dates used for assertion of Epiphany.
     *
     * @return array<array> list of test dates for Epiphany
     *
     * @throws \Exception
     */
    public function EpiphanyDataProvider(): array
    {
        return $this->generateRandomDates(1, 6, self::TIMEZONE);
    }

    /**
     * Tests translated name of Epiphany.
     *
     * @throws \Exception
     */
    public function testTranslation(): void
    {
        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(),
            [self::LOCALE => 'Epifania']
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
