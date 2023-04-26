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

namespace Yasumi\tests\Denmark;

use Yasumi\Holiday;

/**
 * Class for testing summer time in Denmark.
 *
 * @see: https://en.wikipedia.org/wiki/Time_in_the_Danish_Realm#History
 */
final class SummerTimeTest extends DaylightSavingTime
{
    /** The name of the holiday */
    public const HOLIDAY = 'summerTime';

    /* List of transition dates that deviate from the known/defined rules.
     * PHP derives the transition dates from the tz database which appear to
     * be different for some dates */
    private array $deviantTransitions = [
        1916 => '1916-05-14',
        1940 => '1940-05-14',
        1943 => '1943-03-29',
        1944 => '1944-04-03',
        1945 => '1945-04-02',
        1946 => '1946-05-01',
        1947 => '1947-05-04',
        1948 => '1948-05-09',
    ];

    public function __construct()
    {
        parent::__construct();

        // no summertime defined in 1942
        if (false !== ($key = array_search(1942, $this->observedYears, true))) {
            unset($this->observedYears[(int) $key]);
        }

        // In version 2022f of the tz db, a correction for some years weere made for the summertime
        // transitions. See: https://github.com/eggert/tz/blob/2022f/europe
        if (1 === strcmp(\intltz_get_tz_data_version(), '2022f')) {
            $this->swapObservation([1917, 1918, 1949]);

            $this->deviantTransitions[1916] = '1916-04-30';
            $this->deviantTransitions[1917] = '1917-04-16';
            $this->deviantTransitions[1918] = '1918-04-15';
            $this->deviantTransitions[1940] = '1940-04-01';
            $this->deviantTransitions[1946] = '1946-04-14';
            $this->deviantTransitions[1947] = '1947-04-06';
            $this->deviantTransitions[1948] = '1948-04-18';
            $this->deviantTransitions[1949] = '1949-04-10';
        }
    }

    /**
     * Tests the holiday defined in this test.
     *
     * @throws \Exception
     */
    public function testSummerTime(): void
    {
        $this->assertNotHoliday(self::REGION, self::HOLIDAY, $this->randomYearFromArray($this->unobservedYears));

        $year = $this->randomYearFromArray($this->observedYears);
        $expectedDate = new \DateTime("last sunday of march $year", new \DateTimeZone(self::TIMEZONE));

        if (array_key_exists($year, $this->deviantTransitions)) {
            $expectedDate = new \DateTime($this->deviantTransitions[$year], new \DateTimeZone(self::TIMEZONE));
        }

        // Since 1980 Summertime in Denmark starts on the last day of March. In 1980 itself however, it started on April, 6th.
        if (1980 === $year) {
            $expectedDate = new \DateTime('1980-04-06', new \DateTimeZone(self::TIMEZONE));
        }

        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            $expectedDate
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
            self::REGION,
            self::HOLIDAY,
            $this->randomYearFromArray($this->observedYears),
            [self::LOCALE => 'sommertid starter']
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
            self::REGION,
            self::HOLIDAY,
            $this->randomYearFromArray($this->observedYears),
            Holiday::TYPE_SEASON
        );
    }
}
