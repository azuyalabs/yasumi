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
 * Class for testing Adelaide Cup Day in South Australia (Australia)..
 */
class AdelaideCupDayTest extends SouthAustraliaBaseTestCase implements HolidayTestCase
{
    /**
     * The name of the holiday.
     */
    public const HOLIDAY = 'adelaideCup';

    /**
     * The year in which the holiday was first established.
     */
    public const ESTABLISHMENT_YEAR = 1973;

    /**
     * Tests Adelaide Cup Day.
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
            [2000, '2000-05-15'],
            [2001, '2001-05-21'],
            [2002, '2002-05-20'],
            [2003, '2003-05-19'],
            [2004, '2004-05-17'],
            [2005, '2005-05-16'],
            [2006, '2006-03-13'],
            [2007, '2007-03-12'],
            [2008, '2008-03-10'],
            [2009, '2009-03-09'],
            [2010, '2010-03-08'],
            [2011, '2011-03-14'],
            [2012, '2012-03-12'],
            [2013, '2013-03-11'],
            [2014, '2014-03-10'],
            [2015, '2015-03-09'],
            [2016, '2016-03-14'],
            [2017, '2017-03-13'],
            [2018, '2018-03-12'],
            [2019, '2019-03-11'],
            [2020, '2020-03-09'],
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
            $this->generateRandomYear(self::ESTABLISHMENT_YEAR),
            [self::LOCALE => 'Adelaide Cup']
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
            $this->generateRandomYear(self::ESTABLISHMENT_YEAR, 2100),
            Holiday::TYPE_OFFICIAL
        );
    }
}
