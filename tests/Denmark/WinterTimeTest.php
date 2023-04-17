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
 * Class for testing winter time in Denmark.
 *
 * @see: https://en.wikipedia.org/wiki/Time_in_the_Danish_Realm#History
 */
final class WinterTimeTest extends DaylightSavingTime
{
    /** The name of the holiday */
    public const HOLIDAY = 'winterTime';

    /* List of transition dates that deviate from the known/defined rules.
     * PHP derives the transition dates from the tz database which appear to
     * be different for some dates */
    private array $deviantTransitions = [
      1916 => '1916-09-30',
      1942 => '1942-11-02',
      1943 => '1943-10-04',
      1944 => '1944-10-02',
      1945 => '1945-08-15',
      1946 => '1946-09-01',
      1947 => '1947-08-10',
      1948 => '1948-08-08',
    ];

    public function __construct()
    {
        parent::__construct();

        // no wintertime defined for 1940
        if (false !== ($key = array_search(1940, $this->observedYears, true))) {
            unset($this->observedYears[(int) $key]);
        }

        // In version 2022f of the tz db, a correction for some years weere made for the wintertime
        // transitions. See: https://github.com/eggert/tz/blob/2022f/europe
        if (1 === strcmp(\intltz_get_tz_data_version(), '2022f')) {
            $this->swapObservation([1918, 1917, 1945, 1946, 1948, 1949]);

            $this->deviantTransitions[1917] = '1917-09-17';
            $this->deviantTransitions[1918] = '1918-09-16';
            $this->deviantTransitions[1945] = '1945-11-18';
            $this->deviantTransitions[1946] = '1946-10-07';
            $this->deviantTransitions[1947] = '1947-10-05';
            $this->deviantTransitions[1948] = '1948-10-03';
            $this->deviantTransitions[1949] = '1949-10-02';
        }
    }

    /**
     * Tests the holiday defined in this test.
     *
     * @throws \Exception
     */
    public function testWinterTime(): void
    {
        $this->assertNotHoliday(self::REGION, self::HOLIDAY, $this->randomYearFromArray($this->unobservedYears));

        $year = $this->randomYearFromArray($this->observedYears);
        $expectedDate = new \DateTime("last sunday of september $year", new \DateTimeZone(self::TIMEZONE));

        if ($year >= 1996) {
            $expectedDate = new \DateTime("last sunday of october $year", new \DateTimeZone(self::TIMEZONE));
        }

        if (array_key_exists($year, $this->deviantTransitions)) {
            $expectedDate = new \DateTime($this->deviantTransitions[$year], new \DateTimeZone(self::TIMEZONE));
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
            [self::LOCALE => 'sommertid slutter']
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
