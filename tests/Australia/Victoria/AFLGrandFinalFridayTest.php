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

namespace Yasumi\tests\Australia\Victoria;

use Yasumi\Holiday;
use Yasumi\tests\HolidayTestCase;

/**
 * Class for testing AFL Grand Final Friday in Victoria (Australia)..
 */
class AFLGrandFinalFridayTest extends VictoriaBaseTestCase implements HolidayTestCase
{
    /**
     * The name of the holiday.
     */
    public const HOLIDAY = 'aflGrandFinalFriday';

    public const ESTABLISHMENT_YEAR = 2015;
    public const LAST_KNOWN_YEAR = 2020;

    /**
     * Tests AFL Grand Final Friday.
     *
     * @dataProvider HolidayDataProvider
     *
     * @param int    $year     the year for which the holiday defined in this test needs to be tested
     * @param string $expected the expected date
     *
     * @throws \Exception
     */
    public function testHoliday(int $year, string $expected): void
    {
        $this->assertHoliday(
            $this->region,
            self::HOLIDAY,
            $year,
            new \DateTime($expected, new \DateTimeZone($this->timezone))
        );
    }

    /**
     * Tests the translated name of the holiday defined in this test.
     *
     * @throws \Exception
     */
    public function testTranslation(): void
    {
        $this->assertTranslatedHolidayName(
            $this->region,
            self::HOLIDAY,
            $this->generateRandomYear(self::ESTABLISHMENT_YEAR, self::LAST_KNOWN_YEAR),
            [self::LOCALE => 'AFL Grand Final Friday']
        );
    }

    /**
     * Tests type of the holiday defined in this test.
     *
     * @throws \Exception
     */
    public function testHolidayType(): void
    {
        $this->assertHolidayType(
            $this->region,
            self::HOLIDAY,
            $this->generateRandomYear(self::ESTABLISHMENT_YEAR, self::LAST_KNOWN_YEAR),
            Holiday::TYPE_OFFICIAL
        );
    }

    /**
     *  Tests that Holiday is not present before establishment year.
     */
    public function testNotHoliday(): void
    {
        $this->assertNotHoliday($this->region, self::HOLIDAY, self::ESTABLISHMENT_YEAR - 1);
    }

    /**
     * Returns a list of test dates.
     *
     * @return array<array> list of test dates for the holiday defined in this test
     */
    public function HolidayDataProvider(): array
    {
        return [
            [2015, '2015-10-02'],
            [2016, '2016-09-30'],
            [2017, '2017-09-29'],
            [2018, '2018-09-28'],
            [2019, '2019-09-27'],
            [2020, '2020-09-25'],
        ];
    }
}
