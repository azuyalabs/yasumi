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
 * Class for testing summer time in Denmark.
 *
 * @see: https://en.wikipedia.org/wiki/Time_in_the_Danish_Realm#History
 */
final class SummerTimeTest extends DaylightSavingTime
{
    /** The name of the holiday */
    public const HOLIDAY = 'summerTime';

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

        // no summertime defined for 1942
        if (false !== ($key = array_search(1942, $this->observedYears, true))) {
            unset($this->observedYears[(int) $key]);
        }
    }

    /**
     * Tests the holiday defined in this test.
     *
     * @throws Exception
     */
    public function testSummerTime(): void
    {
        $this->assertNotHoliday(self::REGION, self::HOLIDAY, $this->randomYearFromArray($this->unobservedYears));

        $year = $this->randomYearFromArray($this->observedYears);
        $expectedDate = new DateTime("last sunday of march $year", new DateTimeZone(self::TIMEZONE));

        if (array_key_exists($year, $this->deviantTransitions)) {
            $expectedDate = new DateTime($this->deviantTransitions[$year], new DateTimeZone(self::TIMEZONE));
        }

        // Since 1980 Summertime in Denmark starts on the last day of March. In 1980 itself however, it started on April, 6th.
        if (1980 === $year) {
            $expectedDate = new DateTime('1980-04-06', new DateTimeZone(self::TIMEZONE));
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
     * @throws Exception
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
