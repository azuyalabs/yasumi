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

use DateTime;
use DateTimeZone;
use Exception;
use Yasumi\Holiday;

/**
 * Class for testing Summertime in the Netherlands.
 */
final class SummertimeTest extends DaylightSavingTime
{
    /** The name of the holiday */
    public const HOLIDAY = 'summerTime';

    public function __construct()
    {
        parent::__construct();

        // no summertime defined for 1942
        if (false !== ($key = array_search(1942, $this->observedYears, true))) {
            unset($this->observedYears[(int) $key]);
        }
    }

    /**
     * Tests Summertime.
     *
     * @throws Exception
     */
    public function testSummertime(): void
    {
        $this->assertNotHoliday(self::REGION, self::HOLIDAY, $this->randomYearFromArray($this->unobservedYears));

        $year = $this->generateRandomYear(1977, 1980);
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new DateTime("first sunday of april $year", new DateTimeZone(self::TIMEZONE))
        );

        $year = $this->generateRandomYear(1981, 2037);
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new DateTime("last sunday of march $year", new DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests the translated name of the holiday defined in this test.
     *
     * @throws Exception
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
     * @throws Exception
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
