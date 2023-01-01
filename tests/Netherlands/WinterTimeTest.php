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
 * Class for testing Wintertime in the Netherlands.
 */
final class WinterTimeTest extends DaylightSavingTime
{
    /** The name of the holiday */
    public const HOLIDAY = 'winterTime';

    /* List of transition dates that deviate from the known/defined rules.
     * PHP derives the transition dates from the tz database which are
     * different for some years */
    private array $deviantTransitions = [
        1916 => '1916-09-30',
        1917 => '1917-09-17',
        1922 => '1922-10-08',
        1933 => '1933-10-08',
        1939 => '1939-10-08',
        1942 => '1942-11-02',
        1943 => '1943-10-04',
        1944 => '1944-10-02',
        1945 => '1945-09-16',
        1978 => '1978-10-01',
    ];

    public function __construct()
    {
        parent::__construct();

        // No wintertime defined for 1940
        if (false !== ($key = array_search(1940, $this->observedYears, true))) {
            unset($this->observedYears[(int) $key]);
        }

        // In version 2022f of the tz db, a correction for some years weere made for the wintertime
        // transitions. See: https://github.com/eggert/tz/blob/2022f/europe
        if (1 === strcmp(\intltz_get_tz_data_version(), '2022f')) {
            $this->swapObservation([1946]);

            $this->deviantTransitions[1918] = '1918-09-16';
            $this->deviantTransitions[1919] = '1919-10-04';
            $this->deviantTransitions[1920] = '1920-10-23';
            $this->deviantTransitions[1921] = '1921-10-25';
            $this->deviantTransitions[1922] = '1922-10-07';
            $this->deviantTransitions[1923] = '1923-10-06';
            $this->deviantTransitions[1924] = '1924-10-04';
            $this->deviantTransitions[1925] = '1925-10-03';
            $this->deviantTransitions[1926] = '1926-10-02';
            $this->deviantTransitions[1927] = '1927-10-01';
            $this->deviantTransitions[1939] = '1939-11-19';
            $this->deviantTransitions[1944] = '1944-09-17';
            $this->deviantTransitions[1946] = '1946-10-07';
        }
    }

    /**
     * Tests Wintertime.
     *
     * @throws \Exception
     */
    public function testWintertime(): void
    {
        $this->assertNotHoliday(self::REGION, self::HOLIDAY, $this->randomYearFromArray($this->unobservedYears));

        $year = $this->randomYearFromArray($this->observedYears);
        $expected = "last monday of september $year";

        if ($year >= 1922) {
            $expected = "first sunday of october $year";
        }

        if ($year >= 1977) {
            $expected = "last sunday of september $year";
        }

        if ($year >= 1996) {
            $expected = "last sunday of october $year";
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
            [self::LOCALE => 'wintertijd']
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
