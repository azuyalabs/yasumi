<?php

declare(strict_types=1);

/*
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 - 2022 AzuyaLabs
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
            $this->swapObservation([1946]);
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
        $expected = "last sunday of september $year";

        if ($year >= 1922) {
            $expected = "first sunday of october $year";
        }

        if ($year >= 1977) {
            $expected = "last sunday of september $year";
        }

        if ($year >= 1996) {
            $expected = "last sunday of october $year";
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
