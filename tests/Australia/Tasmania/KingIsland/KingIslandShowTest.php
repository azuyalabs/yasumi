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

namespace Yasumi\tests\Australia\Tasmania\KingIsland;

use Yasumi\Holiday;
use Yasumi\tests\HolidayTestCase;

/**
 * Class for testing King Island Show Day in King Island (Australia)..
 */
class KingIslandShowTest extends KingIslandBaseTestCase implements HolidayTestCase
{
    /**
     * The name of the holiday.
     */
    public const HOLIDAY = 'kingIslandShow';

    /**
     * Tests King Island Show Day.
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
            [2010, '2010-03-02'],
            [2011, '2011-03-01'],
            [2012, '2012-03-06'],
            [2013, '2013-03-05'],
            [2014, '2014-03-04'],
            [2015, '2015-03-03'],
            [2016, '2016-03-01'],
            [2017, '2017-03-07'],
            [2018, '2018-03-06'],
            [2019, '2019-03-05'],
            [2020, '2020-03-03'],
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
            [self::LOCALE => 'King Island Show']
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
