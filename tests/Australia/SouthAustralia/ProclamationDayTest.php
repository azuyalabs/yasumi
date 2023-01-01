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

namespace Yasumi\tests\Australia\SouthAustralia;

use Yasumi\Holiday;
use Yasumi\tests\HolidayTestCase;

/**
 * Class for testing Proclamation Day in South Australia (Australia)..
 */
class ProclamationDayTest extends SouthAustraliaBaseTestCase implements HolidayTestCase
{
    /**
     * The name of the holiday.
     */
    public const HOLIDAY = 'proclamationDay';

    /**
     * Tests Proclamation Day.
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
     * Returns a list of test dates.
     *
     * @return array<array> list of test dates for the holiday defined in this test
     */
    public function HolidayDataProvider(): array
    {
        return [
            [2010, '2010-12-28'],
            [2011, '2011-12-27'],
            [2012, '2012-12-26'],
            [2013, '2013-12-26'],
            [2014, '2014-12-26'],
            [2015, '2015-12-28'],
            [2016, '2016-12-27'],
            [2017, '2017-12-26'],
            [2018, '2018-12-26'],
            [2019, '2019-12-26'],
            [2020, '2020-12-28'],
        ];
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
            $this->generateRandomYear(),
            [self::LOCALE => 'Proclamation Day']
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
            $this->generateRandomYear(),
            Holiday::TYPE_OFFICIAL
        );
    }
}
