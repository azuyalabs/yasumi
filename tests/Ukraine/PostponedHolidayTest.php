<?php

declare(strict_types=1);
/**
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 - 2020 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <me@sachatelgenhof.com>
 */

namespace Yasumi\tests\Ukraine;

use DateTime;
use DateTimeZone;
use Exception;
use ReflectionException;
use Yasumi\Holiday;
use Yasumi\Provider\Ukraine;
use Yasumi\tests\YasumiTestCaseInterface;
use Yasumi\Yasumi;

/**
 * Class PostponedHolidayTest
 * @package Yasumi\tests\Ukraine
 */
class PostponedHolidayTest extends UkraineBaseTestCase implements YasumiTestCaseInterface
{
    /**
     * Tests the postponement of holidays on saturday (weekend).
     * @throws Exception
     * @throws ReflectionException
     */
    public function testSaturdayPostponement()
    {
        // 2020-05-09 victoryDay (День перемоги)
        $year = 2020;
        $holiday = 'victoryDay';

        $this->assertHolidayWithPostponement(
            self::REGION,
            $holiday,
            $year,
            new DateTime("$year-05-09", new DateTimeZone(self::TIMEZONE)),
            new DateTime("$year-05-11", new DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests the postponement of holidays on sunday (weekend).
     * @throws Exception
     * @throws ReflectionException
     */
    public function testSundayPostponement(): void
    {
        // 2020-06-28 constitutionDay (День Конституції)
        $year = 2020;
        $holiday = 'constitutionDay';

        $this->assertHolidayWithPostponement(
            self::REGION,
            $holiday,
            $year,
            new DateTime("$year-06-28", new DateTimeZone(self::TIMEZONE)),
            new DateTime("$year-06-29", new DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests the postponement of new year (1. January) on a weekend.
     * Special: no postponement at new year (1. January) on a weekend.
     * @throws Exception
     * @throws ReflectionException
     */
    public function testNewYearNoPostponement(): void
    {
        // 2022-01-01 (Saturday) constitutionDay (Новий Рік)
        $year = 2022;
        $holiday = 'newYearsDay';

        $this->assertHolidayWithPostponement(
            self::REGION,
            $holiday,
            $year,
            new DateTime("$year-01-01", new DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests the postponement of Catholic Christmas Day (25. December) on a weekend.
     * Special: no postponement at Catholic Christmas Day (25. December) on a weekend.
     * @throws Exception
     * @throws ReflectionException
     */
    public function testCatholicChristmasDayNoPostponement(): void
    {
        // 2022-12-25 (Sunday) catholicChristmasDay (Католицький день Різдва)
        $year = 2022;
        $holiday = 'catholicChristmasDay';

        $this->assertHolidayWithPostponement(
            self::REGION,
            $holiday,
            $year,
            new DateTime("$year-12-25", new DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Dummy: Tests the translated name of the holiday defined in this test.
     * @throws ReflectionException
     */
    public function testTranslation(): void
    {
        $this->assertTrue(true);
    }

    /**
     * Dummy: Tests type of the holiday defined in this test.
     * @throws ReflectionException
     */
    public function testHolidayType(): void
    {
        $this->assertTrue(true);
    }

    /**
     * Asserts that the expected date is indeed a holiday for that given year and name
     *
     * @param string $provider the holiday provider (i.e. country/state) for which the holiday need to be tested
     * @param string $shortName string the short name of the holiday to be checked against
     * @param int $year holiday calendar year
     * @param DateTime $expected the official date to be checked against
     * @param DateTime $expected the postponed date to be checked against
     *
     * @throws UnknownLocaleException
     * @throws InvalidDateException
     * @throws InvalidArgumentException
     * @throws RuntimeException
     * @throws AssertionFailedError
     * @throws ReflectionException
     */
    public function assertHolidayWithPostponement(
        string $provider,
        string $shortName,
        int $year,
        DateTime $expectedOfficial,
        DateTime $expectedPostponed = null
    ): void {
        $holidays = Yasumi::create($provider, $year);

        $holidayOfficial = $holidays->getHoliday($shortName);
        $this->assertInstanceOf(Holiday::class, $holidayOfficial);
        $this->assertNotNull($holidayOfficial);
        $this->assertEquals($expectedOfficial, $holidayOfficial);
        $this->assertTrue($holidays->isHoliday($holidayOfficial));
        $this->assertEquals(Holiday::TYPE_OFFICIAL, $holidayOfficial->getType());

        $holidayPostponed = $holidays->getHoliday($shortName . 'Postponed');
        if ($expectedPostponed === null) {
            // without postponement
            $this->assertNull($holidayPostponed);
        } else {
            // with postponement
            $this->assertInstanceOf(Holiday::class, $holidayPostponed);
            $this->assertNotNull($holidayPostponed);
            $this->assertEquals($expectedPostponed, $holidayPostponed);
            $this->assertTrue($holidays->isHoliday($holidayPostponed));
            $this->assertEquals(Ukraine::TYPE_POSTPONED, $holidayPostponed->getType());
        }

        unset($holidayOfficial, $holidayPostponed, $holidays);
    }
}
