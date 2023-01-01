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

namespace Yasumi\tests\Switzerland\Zug;

use Yasumi\Holiday;
use Yasumi\tests\HolidayTestCase;

/**
 * Class for testing All Saints' Day in Zug (Switzerland).
 */
class AllSaintsDayTest extends ZugBaseTestCase implements HolidayTestCase
{
    /**
     * The name of the holiday.
     */
    public const HOLIDAY = 'allSaintsDay';

    /**
     * Tests All Saints' Day.
     *
     * @dataProvider AllSaintsDayDataProvider
     *
     * @param int       $year     the year for which All Saints' Day needs to be tested
     * @param \DateTime $expected the expected date
     */
    public function testAllSaintsDay(int $year, \DateTimeInterface $expected): void
    {
        $this->assertHoliday(self::REGION, self::HOLIDAY, $year, $expected);
    }

    /**
     * Tests translated name of All Saints' Day.
     *
     * @throws \Exception
     */
    public function testTranslation(): void
    {
        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(),
            [self::LOCALE => 'Allerheiligen']
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
     * Returns a list of random test dates used for assertion of All Saints' Day.
     *
     * @return array<array> list of test dates for All Saints' Day
     *
     * @throws \Exception
     */
    public function AllSaintsDayDataProvider(): array
    {
        return $this->generateRandomDates(11, 1, self::TIMEZONE);
    }
}
