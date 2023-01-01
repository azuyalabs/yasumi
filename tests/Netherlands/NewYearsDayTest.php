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

namespace Yasumi\tests\Netherlands;

use Yasumi\Holiday;
use Yasumi\tests\HolidayTestCase;

/**
 * Class for testing New Years Day in the Netherlands.
 */
class NewYearsDayTest extends NetherlandsBaseTestCase implements HolidayTestCase
{
    /**
     * The name of the holiday to be tested.
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
     * Tests the translated name of the holiday defined in this test.
     *
     * @throws \Exception
     */
    public function testTranslation(): void
    {
        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(),
            [self::LOCALE => 'Nieuwjaar']
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
