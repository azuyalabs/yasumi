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

/**
 * Class for testing Summertime in the Netherlands.
 */
final class SummerTimeTest extends DaylightSavingTime
{
    /** The name of the holiday */
    public const HOLIDAY = 'summerTime';

    /* List of transition dates that deviate from the known/defined rules.
     * PHP derives the transition dates from the tz database which are
     * different for some years */
    private array $deviantTransitions = [
        1916 => '1916-04-30',
        1917 => '1917-04-16',
        1919 => '1919-04-07',
        1918 => '1918-04-01',
        1920 => '1920-04-05',
        1921 => '1921-04-04',
        1922 => '1922-03-26',
        1923 => '1923-06-01',
        1924 => '1924-03-30',
        1925 => '1925-06-05',
        1932 => '1932-05-22',
        1937 => '1937-05-22',
        1943 => '1943-03-29',
        1944 => '1944-04-03',
        1945 => '1945-04-02',
    ];

    public function __construct()
    {
        parent::__construct();

        // No summertime defined for 1942
        if (false !== ($key = array_search(1942, $this->observedYears, true))) {
            unset($this->observedYears[(int) $key]);
        }

        // In version 2022f of the tz db, a correction for some years weere made for the summertime
        // transitions. See: https://github.com/eggert/tz/blob/2022f/europe
        if (1 === strcmp(\intltz_get_tz_data_version(), '2022f')) {
            $this->swapObservation([1946]);

            $this->deviantTransitions[1918] = '1918-04-15';
            $this->deviantTransitions[1919] = '1919-03-01';
            $this->deviantTransitions[1920] = '1920-02-14';
            $this->deviantTransitions[1921] = '1921-03-14';
            $this->deviantTransitions[1922] = '1922-03-25';
            $this->deviantTransitions[1923] = '1923-04-21';
            $this->deviantTransitions[1924] = '1924-03-29';
            $this->deviantTransitions[1925] = '1925-04-04';
            $this->deviantTransitions[1926] = '1926-04-17';
            $this->deviantTransitions[1927] = '1927-04-09';
            $this->deviantTransitions[1928] = '1928-04-14';
            $this->deviantTransitions[1929] = '1929-04-21';
            $this->deviantTransitions[1931] = '1931-04-19';
            $this->deviantTransitions[1930] = '1930-04-13';
            $this->deviantTransitions[1932] = '1932-04-03';
            $this->deviantTransitions[1933] = '1933-03-26';
            $this->deviantTransitions[1934] = '1934-04-08';
            $this->deviantTransitions[1935] = '1935-03-31';
            $this->deviantTransitions[1936] = '1936-04-19';
            $this->deviantTransitions[1937] = '1937-04-04';
            $this->deviantTransitions[1938] = '1938-03-27';
            $this->deviantTransitions[1939] = '1939-04-16';
            $this->deviantTransitions[1940] = '1940-02-25';
            $this->deviantTransitions[1946] = '1946-05-19';
        }
    }

    /**
     * Tests Summertime.
     *
     * @throws \Exception
     */
    public function testSummertime(): void
    {
        $this->assertNotHoliday(self::REGION, self::HOLIDAY, $this->randomYearFromArray($this->unobservedYears));

        $year = $this->randomYearFromArray($this->observedYears);
        $expected = "first sunday of april $year";

        if ($year >= 1922) {
            $expected = "may 15th $year";
        }

        if ($year >= 1943) {
            $expected = "first sunday of april $year";
        }

        if ($year >= 1981) {
            $expected = "last sunday of march $year";
        }

        if (array_key_exists($year, $this->deviantTransitions)) {
            $expected = $this->deviantTransitions[$year];
        }

        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new \DateTime($expected, new \DateTimeZone(self::TIMEZONE))
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
            [self::LOCALE => 'zomertijd']
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
