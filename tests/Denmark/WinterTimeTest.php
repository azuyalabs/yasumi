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

namespace Yasumi\tests\Denmark;

use DateTime;
use DateTimeZone;
use Exception;
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

    public function __construct()
    {
        parent::__construct();

        // no wintertime defined for 1940
        if (false !== ($key = array_search(1940, $this->observedYears, true))) {
            unset($this->observedYears[(int) $key]);
        }
    }

    /**
     * Tests the holiday defined in this test.
     *
     * @throws Exception
     */
    public function testWinterTime(): void
    {
        $this->assertNotHoliday(self::REGION, self::HOLIDAY, $this->randomYearFromArray($this->unobservedYears));

        $year = $this->generateRandomYear(1980, 1995);
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new DateTime("last sunday of september $year", new DateTimeZone(self::TIMEZONE))
        );

        $year = $this->generateRandomYear(1996, 2036);
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new DateTime("last sunday of october $year", new DateTimeZone(self::TIMEZONE))
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
            [self::LOCALE => 'sommertid slutter']
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
            self::REGION, self::HOLIDAY,
            $this->randomYearFromArray($this->observedYears),
            Holiday::TYPE_SEASON
        );
    }
}
