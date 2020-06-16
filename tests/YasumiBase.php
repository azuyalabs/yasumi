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

namespace Yasumi\tests;

use DateInterval;
use DateTime;
use DateTimeInterface;
use DateTimeZone;
use Exception;
use Faker\Factory as Faker;
use InvalidArgumentException;
use PHPUnit\Framework\AssertionFailedError;
use ReflectionException;
use RuntimeException;
use Yasumi\Exception\InvalidDateException;
use Yasumi\Exception\UnknownLocaleException;
use Yasumi\Filters\BankHolidaysFilter;
use Yasumi\Filters\ObservedHolidaysFilter;
use Yasumi\Filters\OfficialHolidaysFilter;
use Yasumi\Filters\OtherHolidaysFilter;
use Yasumi\Filters\SeasonalHolidaysFilter;
use Yasumi\Holiday;
use Yasumi\SubstituteHoliday;
use Yasumi\Yasumi;

/**
 * Trait YasumiBase.
 *
 * Trait containing some base function for testing Yasumi.
 */
trait YasumiBase
{
    /**
     * Asserts that the expected holidays are indeed a holiday for the given provider and year
     *
     * @param array $expectedHolidays list of all known holidays of the given provider
     * @param string $provider the holiday provider (i.e. country/state) for which the holidays need to be
     *                                       tested
     * @param int $year holiday calendar year
     * @param string $type The type of holiday. Use the following constants: TYPE_OFFICIAL,
     *                                       TYPE_OBSERVANCE, TYPE_SEASON, TYPE_BANK or TYPE_OTHER.
     *
     * @throws InvalidArgumentException
     * @throws RuntimeException
     * @throws UnknownLocaleException
     * @throws ReflectionException
     */
    public function assertDefinedHolidays(
        array $expectedHolidays,
        string $provider,
        int $year,
        string $type
    ): void {
        $holidays = Yasumi::create($provider, $year);

        switch ($type) {
            case Holiday::TYPE_OFFICIAL:
                $holidays = new OfficialHolidaysFilter($holidays->getIterator());
                break;
            case Holiday::TYPE_OBSERVANCE:
                $holidays = new ObservedHolidaysFilter($holidays->getIterator());
                break;
            case Holiday::TYPE_SEASON:
                $holidays = new SeasonalHolidaysFilter($holidays->getIterator());
                break;
            case Holiday::TYPE_BANK:
                $holidays = new BankHolidaysFilter($holidays->getIterator());
                break;
            case Holiday::TYPE_OTHER:
                $holidays = new OtherHolidaysFilter($holidays->getIterator());
                break;
        }

        // Loop through all known holidays and assert they are defined by the provider class
        foreach ($expectedHolidays as $holiday) {
            $this->assertArrayHasKey($holiday, \iterator_to_array($holidays));
        }
    }

    /**
     * Asserts that the expected date is indeed a holiday for that given year and name
     *
     * @param string $provider the holiday provider (i.e. country/state) for which the holiday need to be tested
     * @param string $key string the key of the holiday to be checked against
     * @param int $year holiday calendar year
     * @param DateTime $expected the date to be checked against
     *
     * @throws UnknownLocaleException
     * @throws InvalidDateException
     * @throws InvalidArgumentException
     * @throws RuntimeException
     * @throws AssertionFailedError
     * @throws ReflectionException
     */
    public function assertHoliday(
        string $provider,
        string $key,
        int $year,
        DateTime $expected
    ): void {
        $holidays = Yasumi::create($provider, $year);
        $holiday = $holidays->getHoliday($key);

        $this->assertInstanceOf(Holiday::class, $holiday);
        $this->assertEquals($expected, $holiday);
        $this->assertTrue($holidays->isHoliday($holiday));
    }

    /**
     * Asserts that the expected date is indeed a substitute holiday for that given year and name
     *
     * @param string $provider the holiday provider (i.e. country/state) for which the holiday need to be tested
     * @param string $key string the key of the substituted holiday to be checked against
     * @param int $year holiday calendar year
     * @param DateTime $expected the date to be checked against
     *
     * @throws UnknownLocaleException
     * @throws InvalidDateException
     * @throws InvalidArgumentException
     * @throws RuntimeException
     * @throws AssertionFailedError
     * @throws ReflectionException
     */
    public function assertSubstituteHoliday(
        string $provider,
        string $key,
        int $year,
        DateTime $expected
    ): void {
        $holidays = Yasumi::create($provider, $year);
        $holiday = $holidays->getHoliday('substituteHoliday:' . $key);

        $this->assertInstanceOf(SubstituteHoliday::class, $holiday);
        $this->assertEquals($expected, $holiday);
        $this->assertTrue($holidays->isHoliday($holiday));
    }

    /**
     * Asserts that the given substitute holiday for that given year does not exist.
     *
     * @param string $provider the holiday provider (i.e. country/state) for which the holiday need to be tested
     * @param string $key the key of the substituted holiday to be checked against
     * @param int $year holiday calendar year
     *
     * @throws InvalidArgumentException
     * @throws RuntimeException
     * @throws UnknownLocaleException
     * @throws InvalidDateException
     * @throws AssertionFailedError
     * @throws ReflectionException
     */
    public function assertNotSubstituteHoliday(
        string $provider,
        string $key,
        int $year
    ): void {
        $this->assertNotHoliday(
            $provider,
            'substituteHoliday:' . $key,
            $year
        );
    }

    /**
     * Asserts that the given holiday for that given year does not exist.
     *
     * @param string $provider the holiday provider (i.e. country/state) for which the holiday need to be tested
     * @param string $key the key of the holiday to be checked against
     * @param int $year holiday calendar year
     *
     * @throws InvalidArgumentException
     * @throws RuntimeException
     * @throws UnknownLocaleException
     * @throws InvalidDateException
     * @throws AssertionFailedError
     * @throws ReflectionException
     */
    public function assertNotHoliday(
        string $provider,
        string $key,
        int $year
    ): void {
        $holidays = Yasumi::create($provider, $year);
        $holiday = $holidays->getHoliday($key);

        $this->assertNull($holiday);
    }

    /**
     * Asserts that the expected name is indeed provided as a translated holiday name for that given year and name
     *
     * @param string $provider the holiday provider (i.e. country/state) for which the holiday need to be tested
     * @param string $key string the key of the holiday to be checked against
     * @param int $year holiday calendar year
     * @param array $translations the translations to be checked against
     *
     * @throws InvalidArgumentException
     * @throws RuntimeException
     * @throws UnknownLocaleException
     * @throws AssertionFailedError
     * @throws ReflectionException
     */
    public function assertTranslatedHolidayName(
        string $provider,
        string $key,
        int $year,
        array $translations
    ): void {
        $holidays = Yasumi::create($provider, $year);
        $holiday = $holidays->getHoliday($key);

        $this->assertInstanceOf(Holiday::class, $holiday);
        $this->assertTrue($holidays->isHoliday($holiday));

        if (\is_array($translations) && !empty($translations)) {
            foreach ($translations as $locale => $name) {
                $locales = [$locale];
                $parts = \explode('_', $locale);
                while (\array_pop($parts) && $parts) {
                    $locales[] = \implode('_', $parts);
                }

                $translation = null;
                foreach ($locales as $l) {
                    if (isset($holiday->translations[$l])) {
                        $translation = $holiday->translations[$l];
                        break;
                    }
                }

                $this->assertTrue(isset($translation));
                $this->assertEquals($name, $translation);
            }
        }
    }

    /**
     * Asserts that the expected type is indeed the associated type of the given holiday
     *
     * @param string $provider the holiday provider (i.e. country/region) for which the holiday need to be tested
     * @param string $key string the key of the holiday to be checked against
     * @param int $year holiday calendar year
     * @param string $type the type to be checked against
     *
     * @throws InvalidArgumentException
     * @throws RuntimeException
     * @throws AssertionFailedError
     * @throws UnknownLocaleException
     * @throws ReflectionException
     */
    public function assertHolidayType(
        string $provider,
        string $key,
        int $year,
        string $type
    ): void {
        $holidays = Yasumi::create($provider, $year);
        $holiday = $holidays->getHoliday($key);

        $this->assertInstanceOf(Holiday::class, $holiday);
        $this->assertEquals($type, $holiday->getType());
    }

    /**
     * Asserts that the expected week day is indeed the week day for the given holiday and year
     *
     * @param string $provider the holiday provider (i.e. country/state) for which the holiday need to be
     *                                  tested
     * @param string $key string the key of the holiday to be checked against
     * @param int $year holiday calendar year
     * @param string $expectedDayOfWeek the expected week day (i.e. "Saturday", "Sunday", etc.)
     *
     * @throws AssertionFailedError
     * @throws InvalidArgumentException
     * @throws RuntimeException
     * @throws UnknownLocaleException
     * @throws ReflectionException
     */
    public function assertDayOfWeek(
        string $provider,
        string $key,
        int $year,
        string $expectedDayOfWeek
    ): void {
        $holidays = Yasumi::create($provider, $year);
        $holiday = $holidays->getHoliday($key);

        $this->assertInstanceOf(Holiday::class, $holiday);
        $this->assertTrue($holidays->isHoliday($holiday));
        $this->assertEquals($expectedDayOfWeek, $holiday->format('l'));
    }

    /**
     * Returns a list of random test dates used for assertion of holidays.
     *
     * @param int $month month (number) for which the test date needs to be generated
     * @param int $day day (number) for which the test date needs to be generated
     * @param string $timezone name of the timezone for which the dates need to be generated
     * @param int $iterations number of iterations (i.e. samples) that need to be generated (default: 10)
     * @param int $range year range from which dates will be generated (default: 1000)
     *
     * @return array list of random test dates used for assertion of holidays.
     * @throws Exception
     */
    public function generateRandomDates(
        int $month,
        int $day,
        string $timezone = null,
        int $iterations = null,
        int $range = null
    ): array {
        $data = [];
        $range = $range ?? 1000;
        for ($y = 1; $y <= ($iterations ?? 10); $y++) {
            $year = (int) Faker::create()->dateTimeBetween("-$range years", "+$range years")->format('Y');
            $data[] = [$year, new DateTime("$year-$month-$day", new DateTimeZone($timezone ?? 'UTC'))];
        }

        return $data;
    }

    /**
     * Returns a list of random easter test dates used for assertion of holidays.
     *
     * @param string $timezone name of the timezone for which the dates need to be generated
     * @param int $iterations number of iterations (i.e. samples) that need to be generated (default: 10)
     * @param int $range year range from which dates will be generated (default: 1000)
     *
     * @return array list of random easter test dates used for assertion of holidays.
     * @throws Exception
     */
    public function generateRandomEasterDates(
        string $timezone = null,
        int $iterations = null,
        int $range = null
    ): array {
        $data = [];
        $range = $range ?? 1000;

        for ($i = 1; $i <= ($iterations ?? 10); ++$i) {
            $year = (int) Faker::create()->dateTimeBetween("-$range years", "+$range years")->format('Y');
            $date = $this->calculateEaster($year, $timezone ?? 'UTC');

            $data[] = [$year, $date->format('Y-m-d')];
        }

        return $data;
    }

    /**
     * Calculates the date for Easter.
     *
     * Easter is a festival and holiday celebrating the resurrection of Jesus Christ from the dead. Easter is celebrated
     * on a date based on a certain number of days after March 21st.
     *
     * This function uses the standard PHP 'easter_days' function if the calendar extension is enabled. In case the
     * calendar function is not enabled, a fallback calculation has been implemented that is based on the same
     * 'easter_days' c function.
     *
     * Note: In calendrical calculations, frequently operations called integer division are used.
     *
     * @param int $year the year for which Easter needs to be calculated
     * @param string $timezone the timezone in which Easter is celebrated
     *
     * @return DateTime date of Easter
     * @throws Exception
     * @see  easter_days
     *
     * @link https://github.com/php/php-src/blob/c8aa6f3a9a3d2c114d0c5e0c9fdd0a465dbb54a5/ext/calendar/easter.c
     * @link http://www.gmarts.org/index.php?go=415#EasterMallen
     * @link http://www.tondering.dk/claus/cal/easter.php
     *
     */
    protected function calculateEaster(int $year, string $timezone): DateTime
    {
        if (\extension_loaded('calendar')) {
            $easter_days = \easter_days($year);
        } else {
            $golden = (($year % 19) + 1); // The Golden Number

            // The Julian calendar applies to the original method from 326AD. The Gregorian calendar was first
            // introduced in October 1582 in Italy. Easter algorithms using the Gregorian calendar apply to years
            // 1583 AD to 4099 (A day adjustment is required in or shortly after 4100 AD).
            // After 1752, most western churches have adopted the current algorithm.
            if ($year <= 1752) {
                $dom = ($year + (int) ($year / 4) + 5) % 7; // The 'Dominical number' - finding a Sunday
                if ($dom < 0) {
                    $dom += 7;
                }

                $pfm = (3 - (11 * $golden) - 7) % 30; // Uncorrected date of the Paschal full moon
                if ($pfm < 0) {
                    $pfm += 30;
                }
            } else {
                $dom = ($year + (int) ($year / 4) - (int) ($year / 100) + (int) ($year / 400)) % 7; // The 'Dominical number' - finding a Sunday
                if ($dom < 0) {
                    $dom += 7;
                }

                $solar = (int) (($year - 1600) / 100) - (int) (($year - 1600) / 400); // The solar correction
                $lunar = (int) (((int) (($year - 1400) / 100) * 8) / 25); // The lunar correction

                $pfm = (3 - (11 * $golden) + $solar - $lunar) % 30; // Uncorrected date of the Paschal full moon
                if ($pfm < 0) {
                    $pfm += 30;
                }
            }

            // Corrected date of the Paschal full moon, - days after 21st March
            if ((29 === $pfm) || (28 === $pfm && $golden > 11)) {
                --$pfm;
            }

            $tmp = (4 - $pfm - $dom) % 7;
            if ($tmp < 0) {
                $tmp += 7;
            }

            $easter_days = ($pfm + $tmp + 1); // Easter as the number of days after 21st March
        }

        $easter = new DateTime("$year-3-21", new DateTimeZone($timezone));
        $easter->add(new DateInterval('P' . $easter_days . 'D'));

        return $easter;
    }

    /**
     * Returns a list of random Easter Monday test dates used for assertion of holidays.
     *
     * @param string $timezone name of the timezone for which the dates need to be generated
     * @param int $iterations number of iterations (i.e. samples) that need to be generated (default: 10)
     * @param int $range year range from which dates will be generated (default: 1000)
     *
     * @return array list of random Easter Monday test dates used for assertion of holidays.
     *
     * @throws Exception
     */
    public function generateRandomEasterMondayDates(
        string $timezone = null,
        int $iterations = null,
        int $range = null
    ): array {
        $range = $range ?? 1000;
        return $this->generateRandomModifiedEasterDates(static function (DateTime $date) {
            $date->add(new DateInterval('P1D'));
        }, $timezone ?? 'UTC', $iterations ?? 10, $range);
    }

    /**
     * Returns a list of random modified Easter day test dates for assertion of holidays.
     *
     * @param callable $cb callback(DateTime $date) to modify $date by custom rules
     * @param string $timezone name of the timezone for which the dates need to be generated
     * @param int $iterations number of iterations (i.e. samples) that need to be generated (default: 10)
     * @param int $range year range from which dates will be generated (default: 1000)
     *
     * @return array list of random modified Easter day test dates for assertion of holidays.
     * @throws Exception
     */
    public function generateRandomModifiedEasterDates(
        callable $cb,
        string $timezone = null,
        int $iterations = null,
        int $range = null
    ): array {
        $data = [];
        $range = $range ?? 1000;
        for ($i = 1; $i <= ($iterations ?? 10); ++$i) {
            $year = (int) Faker::create()->dateTimeBetween("-$range years", "+$range years")->format('Y');
            $date = $this->calculateEaster($year, $timezone ?? 'UTC');

            $cb($date);

            $data[] = [$year, $date->format('Y-m-d')];
        }

        return $data;
    }

    /**
     * Returns a list of random Good Friday test dates used for assertion of holidays.
     *
     * @param string $timezone name of the timezone for which the dates need to be generated
     * @param int $iterations number of iterations (i.e. samples) that need to be generated (default: 10)
     * @param int $range year range from which dates will be generated (default: 1000)
     *
     * @return array list of random Good Friday test dates used for assertion of holidays.
     *
     * @throws Exception
     */
    public function generateRandomGoodFridayDates(
        string $timezone = null,
        int $iterations = null,
        int $range = null
    ): array {
        $range = $range ?? 1000;

        return $this->generateRandomModifiedEasterDates(static function (DateTime $date) {
            $date->sub(new DateInterval('P2D'));
        }, $timezone ?? 'UTC', $iterations ?? 10, $range);
    }

    /**
     * Returns a list of random Pentecost test dates used for assertion of holidays.
     *
     * @param string $timezone name of the timezone for which the dates need to be generated
     * @param int $iterations number of iterations (i.e. samples) that need to be generated (default: 10)
     * @param int $range year range from which dates will be generated (default: 1000)
     *
     * @return array list of random Pentecost test dates used for assertion of holidays.
     *
     * @throws Exception
     */
    public function generateRandomPentecostDates(
        string $timezone = null,
        int $iterations = null,
        int $range = null
    ): array {
        $range = $range ?? 1000;

        return $this->generateRandomModifiedEasterDates(static function (DateTime $date) {
            $date->add(new DateInterval('P49D'));
        }, $timezone ?? 'UTC', $iterations ?? 10, $range);
    }

    /**
     * Returns a list of random test dates used for assertion of holidays. If the date falls in a weekend, random
     * holiday day is moved to to Monday.
     *
     * @param int $month month (number) for which the test date needs to be generated
     * @param int $day day (number) for which the test date needs to be generated
     * @param string $timezone name of the timezone for which the dates need to be generated
     * @param int $iterations number of iterations (i.e. samples) that need to be generated (default: 10)
     * @param int $range year range from which dates will be generated (default: 1000)
     *
     * @return array list of random test dates used for assertion of holidays.
     * @throws Exception
     */
    public function generateRandomDatesWithHolidayMovedToMonday(
        int $month,
        int $day,
        string $timezone = null,
        int $iterations = null,
        int $range = null
    ): array {
        return $this->generateRandomDatesWithModifier($month, $day, function ($range, DateTime $date) {
            if ($this->isWeekend($date)) {
                $date->modify('next monday');
            }
        }, $iterations ?? 10, $range, $timezone ?? 'UTC');
    }

    /**
     * Returns a list of random test dates used for assertion of holidays with applied callback.
     *
     * @param int $month month (number) for which the test date needs to be generated
     * @param int $day day (number) for which the test date needs to be generated
     * @param callable $callback callback(int $year, \DateTime $dateTime) to modify $dateTime by custom rules
     * @param int $iterations number of iterations (i.e. samples) that need to be generated (default: 10)
     * @param int $range year range from which dates will be generated (default: 1000)
     * @param string $timezone name of the timezone for which the dates need to be generated
     *
     * @return array list of random test dates used for assertion of holidays with applied callback.
     *
     * @throws Exception
     */
    public function generateRandomDatesWithModifier(
        int $month,
        int $day,
        callable $callback,
        int $iterations,
        int $range,
        string $timezone = null
    ): array {
        $data = [];

        for ($i = 1; $i <= $iterations; ++$i) {
            $year = $this->generateRandomYear($range);
            $date = new DateTime("{$year}-{$month}-{$day}", new DateTimeZone($timezone ?? 'UTC'));

            $callback($year, $date);

            $data[] = [$year, $date->format('Y-m-d')];
        }

        return $data;
    }

    /**
     * Generates a random year (number).
     *
     * @param int $lowerLimit the lower limit for generating a year number (default: 1000)
     * @param int $upperLimit the upper limit for generating a year number (default: 9999)
     *
     * @return int a year number
     */
    public function generateRandomYear(
        int $lowerLimit = null,
        int $upperLimit = null
    ): int {
        return (int) Faker::create()->numberBetween($lowerLimit ?? 1000, $upperLimit ?? 9999);
    }

    /**
     * Checks if given $dateTime is a weekend.
     *
     * @param DateTimeInterface $dateTime date for which weekend will be checked.
     * @param array $weekendDays weekend days. Saturday and Sunday are used by default.
     *
     * @return bool true if $dateTime is a weekend, false otherwise
     */
    public function isWeekend(
        DateTimeInterface $dateTime,
        array $weekendDays = [0, 6]
    ): bool {
        return \in_array((int) $dateTime->format('w'), $weekendDays, true);
    }
}
