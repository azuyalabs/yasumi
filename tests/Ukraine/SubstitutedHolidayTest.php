<?php declare(strict_types=1);

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
use InvalidArgumentException;
use PHPUnit\Framework\AssertionFailedError;
use ReflectionException;
use RuntimeException;
use Yasumi\Exception\InvalidDateException;
use Yasumi\Exception\UnknownLocaleException;
use Yasumi\Holiday;
use Yasumi\SubstituteHoliday;
use Yasumi\tests\YasumiTestCaseInterface;
use Yasumi\Yasumi;

/**
 * Class SubstitutedHolidayTest
 * @package Yasumi\tests\Ukraine
 */
class SubstitutedHolidayTest extends UkraineBaseTestCase implements YasumiTestCaseInterface
{
    /**
     * Tests the substitution of holidays on saturday (weekend).
     * @throws Exception
     * @throws ReflectionException
     */
    public function testSaturdaySubstitution(): void
    {
        // 2020-05-09 victoryDay (День перемоги)
        $year = 2020;
        $holiday = 'victoryDay';

        $this->assertHolidayWithSubstitution(
            self::REGION,
            $holiday,
            $year,
            new DateTime("$year-05-09", new DateTimeZone(self::TIMEZONE)),
            new DateTime("$year-05-11", new DateTimeZone(self::TIMEZONE))
        );

        unset($year, $holiday);
    }

    /**
     * Asserts that the expected date is indeed a holiday for that given year and name
     *
     * @param string $provider the holiday provider (i.e. country/state) for which the holiday need to be tested
     * @param string $key string the key of the holiday to be checked against
     * @param int $year holiday calendar year
     * @param DateTime $expectedOfficial the official date to be checked against
     * @param DateTime $expectedSubstitution the substituted date to be checked against
     *
     * @throws UnknownLocaleException
     * @throws InvalidDateException
     * @throws InvalidArgumentException
     * @throws RuntimeException
     * @throws AssertionFailedError
     * @throws ReflectionException
     */
    public function assertHolidayWithSubstitution(
        string $provider,
        string $key,
        int $year,
        DateTime $expectedOfficial,
        DateTime $expectedSubstitution = null
    ): void {
        $holidays = Yasumi::create($provider, $year);

        $holidayOfficial = $holidays->getHoliday($key);
        $this->assertInstanceOf(Holiday::class, $holidayOfficial);
        $this->assertNotNull($holidayOfficial);
        $this->assertEquals($expectedOfficial, $holidayOfficial);
        $this->assertTrue($holidays->isHoliday($holidayOfficial));
        $this->assertEquals(Holiday::TYPE_OFFICIAL, $holidayOfficial->getType());

        $holidaySubstitution = $holidays->getHoliday('substituteHoliday:' . $holidayOfficial->getKey());
        if ($expectedSubstitution === null) {
            // without substitution
            $this->assertNull($holidaySubstitution);
        } else {
            // with substitution
            $this->assertNotNull($holidaySubstitution);
            $this->assertInstanceOf(SubstituteHoliday::class, $holidaySubstitution);
            $this->assertEquals($expectedSubstitution, $holidaySubstitution);
            $this->assertTrue($holidays->isHoliday($holidaySubstitution));
            $this->assertEquals(Holiday::TYPE_OFFICIAL, $holidaySubstitution->getType());
        }

        unset($holidayOfficial, $holidaySubstitution, $holidays);
    }

    /**
     * Tests the substitution of holidays on sunday (weekend).
     * @throws Exception
     * @throws ReflectionException
     */
    public function testSundaySubstitution(): void
    {
        // 2020-06-28 constitutionDay (День Конституції)
        $year = 2020;
        $holiday = 'constitutionDay';

        $this->assertHolidayWithSubstitution(
            self::REGION,
            $holiday,
            $year,
            new DateTime("$year-06-28", new DateTimeZone(self::TIMEZONE)),
            new DateTime("$year-06-29", new DateTimeZone(self::TIMEZONE))
        );

        unset($year, $holiday);
    }

    /**
     * Tests the substitution of new year (1. January) on a weekend.
     * Special: no substitution at new year (1. January) on a weekend.
     * @throws Exception
     * @throws ReflectionException
     */
    public function testNewYearNoSubstitution(): void
    {
        // 2022-01-01 (Saturday) constitutionDay (Новий Рік)
        $year = 2022;
        $holiday = 'newYearsDay';

        $this->assertHolidayWithSubstitution(
            self::REGION,
            $holiday,
            $year,
            new DateTime("$year-01-01", new DateTimeZone(self::TIMEZONE))
        );

        unset($year, $holiday);
    }

    /**
     * Tests the substitution of Catholic Christmas Day (25. December) on a weekend.
     * Special: no substitution at Catholic Christmas Day (25. December) on a weekend.
     * @throws Exception
     * @throws ReflectionException
     */
    public function testCatholicChristmasDayNoSubstitution(): void
    {
        // 2022-12-25 (Sunday) catholicChristmasDay (Католицький день Різдва)
        $year = 2022;
        $holiday = 'catholicChristmasDay';

        $this->assertHolidayWithSubstitution(
            self::REGION,
            $holiday,
            $year,
            new DateTime("$year-12-25", new DateTimeZone(self::TIMEZONE))
        );

        unset($year, $holiday);
    }

    /**
     * Dummy: Tests the translated name of the holiday defined in this test.
     */
    public function testTranslation(): void
    {
        $this->assertTrue(true);
    }

    /**
     * Dummy: Tests type of the holiday defined in this test.
     */
    public function testHolidayType(): void
    {
        $this->assertTrue(true);
    }
}
