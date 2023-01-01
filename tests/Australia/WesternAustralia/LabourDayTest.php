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

namespace Yasumi\tests\Australia\WesternAustralia;

use Yasumi\Holiday;
use Yasumi\tests\HolidayTestCase;

/**
 * Class for testing Labour Day in Western Australia (Australia)..
 */
class LabourDayTest extends WesternAustraliaBaseTestCase implements HolidayTestCase
{
    /**
     * The name of the holiday.
     */
    public const HOLIDAY = 'labourDay';

    /**
     * Tests Labour Day.
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
            [2010, '2010-03-01'],
            [2011, '2011-03-07'],
            [2012, '2012-03-05'],
            [2013, '2013-03-04'],
            [2014, '2014-03-03'],
            [2015, '2015-03-02'],
            [2016, '2016-03-07'],
            [2017, '2017-03-06'],
            [2018, '2018-03-05'],
            [2019, '2019-03-04'],
            [2020, '2020-03-02'],
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
            $this->generateRandomYear(1990),
            [self::LOCALE => 'Labour Day']
        );
    }

    /**
     * Tests type of the holiday defined in this test.
     *
     * @throws \Exception
     */
    public function testHolidayType(): void
    {
        $this->assertHolidayType($this->region, self::HOLIDAY, $this->generateRandomYear(1990), Holiday::TYPE_OFFICIAL);
    }
}
