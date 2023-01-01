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

namespace Yasumi\tests;

/**
 * Trait containing useful functions that generate random dates/years.
 */
trait Randomizer
{
    protected static string $defaultTimezone;

    /**
     * Returns a list of random test dates used for assertion of holidays.
     *
     * @param int         $month      month (number) for which the test date needs to be generated
     * @param int         $day        day (number) for which the test date needs to be generated
     * @param string|null $timezone   name of the timezone for which the dates need to be generated
     * @param int|null    $iterations number of iterations (i.e., samples) that need to be generated (default: 10).
     * @param int|null    $range      year range from which dates will be generated (default: 1000)
     *
     * @return array<array> list of random test dates used for assertion of holidays
     *
     * @throws \Exception
     */
    public function generateRandomDates(
        int $month,
        int $day,
        string $timezone = null,
        int $iterations = null,
        int $range = null
    ): array {
        $data = [];
        $range ??= 1000;
        for ($y = 1; $y <= ($iterations ?? 10); ++$y) {
            $year = (int) self::dateTimeBetween("-$range years", "+$range years")->format('Y');
            $data[] = [$year, new \DateTime("$year-$month-$day", new \DateTimeZone($timezone ?? 'UTC'))];
        }

        return $data;
    }

    /**
     * Returns a list of random easter test dates used for assertion of holidays.
     *
     * @param string|null $timezone   name of the timezone for which the dates need to be generated
     * @param int|null    $iterations number of iterations (i.e., samples) that need to be generated (default: 10).
     * @param int|null    $range      year range from which dates will be generated (default: 1000)
     *
     * @return array<array> list of random easter test dates used for assertion of holidays
     *
     * @throws \Exception
     */
    public function generateRandomEasterDates(
        string $timezone = null,
        int $iterations = null,
        int $range = null
    ): array {
        $data = [];
        $range ??= 1000;

        for ($i = 1; $i <= ($iterations ?? 10); ++$i) {
            $year = (int) self::dateTimeBetween("-$range years", "+$range years")->format('Y');
            $date = $this->calculateEaster($year, $timezone ?? 'UTC');

            $data[] = [$year, $date->format('Y-m-d')];
        }

        return $data;
    }

    /**
     * Returns a list of random Easter Monday test dates used for assertion of holidays.
     *
     * @param string|null $timezone   name of the timezone for which the dates need to be generated
     * @param int|null    $iterations number of iterations (i.e., samples) that need to be generated (default: 10).
     * @param int|null    $range      year range from which dates will be generated (default: 1000)
     *
     * @return array<array> list of random Easter Monday test dates used for assertion of holidays
     *
     * @throws \Exception
     */
    public function generateRandomEasterMondayDates(
        string $timezone = null,
        int $iterations = null,
        int $range = null
    ): array {
        $range ??= 1000;

        return $this->generateRandomModifiedEasterDates(static function (\DateTime $date): void {
            $date->add(new \DateInterval('P1D'));
        }, $timezone ?? 'UTC', $iterations ?? 10, $range);
    }

    /**
     * Returns a list of random modified Easter day test dates for assertion of holidays.
     *
     * @param callable    $cb         callback(DateTime $date) to modify $date by custom rules
     * @param string|null $timezone   name of the timezone for which the dates need to be generated
     * @param int|null    $iterations number of iterations (i.e., samples) that need to be generated (default: 10).
     * @param int|null    $range      year range from which dates will be generated (default: 1000)
     *
     * @return array<array> list of random modified Easter day test dates for assertion of holidays
     *
     * @throws \Exception
     */
    public function generateRandomModifiedEasterDates(
        callable $cb,
        string $timezone = null,
        int $iterations = null,
        int $range = null
    ): array {
        $data = [];
        $range ??= 1000;
        for ($i = 1; $i <= ($iterations ?? 10); ++$i) {
            $year = (int) self::dateTimeBetween("-$range years", "+$range years")->format('Y');
            $date = $this->calculateEaster($year, $timezone ?? 'UTC');

            $cb($date);

            $data[] = [$year, $date->format('Y-m-d')];
        }

        return $data;
    }

    /**
     * Returns a list of random Good Friday test dates used for assertion of holidays.
     *
     * @param string|null $timezone   name of the timezone for which the dates need to be generated
     * @param int|null    $iterations number of iterations (i.e., samples) that need to be generated (default: 10).
     * @param int|null    $range      year range from which dates will be generated (default: 1000)
     *
     * @return array<array> list of random Good Friday test dates used for assertion of holidays
     *
     * @throws \Exception
     */
    public function generateRandomGoodFridayDates(
        string $timezone = null,
        int $iterations = null,
        int $range = null
    ): array {
        $range ??= 1000;

        return $this->generateRandomModifiedEasterDates(static function (\DateTime $date): void {
            $date->sub(new \DateInterval('P2D'));
        }, $timezone ?? 'UTC', $iterations ?? 10, $range);
    }

    /**
     * Returns a list of random Pentecost test dates used for assertion of holidays.
     *
     * @param string|null $timezone   name of the timezone for which the dates need to be generated
     * @param int|null    $iterations number of iterations (i.e., samples) that need to be generated (default: 10).
     * @param int|null    $range      year range from which dates will be generated (default: 1000)
     *
     * @return array<array> list of random Pentecost test dates used for assertion of holidays
     *
     * @throws \Exception
     */
    public function generateRandomPentecostDates(
        string $timezone = null,
        int $iterations = null,
        int $range = null
    ): array {
        $range ??= 1000;

        return $this->generateRandomModifiedEasterDates(static function (\DateTime $date): void {
            $date->add(new \DateInterval('P49D'));
        }, $timezone ?? 'UTC', $iterations ?? 10, $range);
    }

    /**
     * Returns a list of random test dates used for assertion of holidays. If the date falls in a weekend, the random
     * holiday day moves to Monday.
     *
     * @param int         $month      month (number) for which the test date needs to be generated
     * @param int         $day        day (number) for which the test date needs to be generated
     * @param string|null $timezone   name of the timezone for which the dates need to be generated
     * @param int|null    $iterations number of iterations (i.e., samples) that need to be generated (default: 10).
     * @param int|null    $range      year range from which dates will be generated (default: 1000)
     *
     * @return array<array> list of random test dates used for assertion of holidays
     *
     * @throws \Exception
     */
    public function generateRandomDatesWithHolidayMovedToMonday(
        int $month,
        int $day,
        string $timezone = null,
        int $iterations = null,
        int $range = null
    ): array {
        return $this->generateRandomDatesWithModifier($month, $day, function ($range, \DateTime $date): void {
            if ($this->isWeekend($date)) {
                $date->modify('next monday');
            }
        }, $iterations ?? 10, $range, $timezone ?? 'UTC');
    }

    /**
     * Returns a list of random test dates used for assertion of holidays with an applied callback.
     *
     * @param int         $month      month (number) for which the test date needs to be generated
     * @param int         $day        day (number) for which the test date needs to be generated
     * @param callable    $callback   callback(int $year, \DateTime $dateTime) to modify $dateTime by custom rules
     * @param int         $iterations number of iterations (i.e., samples) that need to be generated (default: 10).
     * @param int         $range      year range from which dates will be generated (default: 1000)
     * @param string|null $timezone   name of the timezone for which the dates need to be generated
     *
     * @return array<array> list of random test dates used for assertion of holidays with an applied callback
     *
     * @throws \Exception
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
            $date = new \DateTime("$year-$month-$day", new \DateTimeZone($timezone ?? 'UTC'));

            $callback($year, $date);

            $data[] = [$year, $date->format('Y-m-d')];
        }

        return $data;
    }

    /**
     * Generates a random year (number).
     *
     * @param int|null $lowerLimit lower limit for generating a year number (default: 1000)
     * @param int|null $upperLimit upper limit for generating a year number (default: 9999)
     *
     * @return int a year number
     *
     * @throws \Exception
     */
    public function generateRandomYear(
        int $lowerLimit = null,
        int $upperLimit = null
    ): int {
        return self::numberBetween($lowerLimit ?? 1000, $upperLimit ?? 9999);
    }

    /**
     * Checks if given $dateTime is a weekend.
     *
     * @param \DateTimeInterface $dateTime    date for which weekend will be checked
     * @param array<int>         $weekendDays weekend days. Saturday and Sunday are used by default.
     *
     * @return bool true if $dateTime is a weekend, false otherwise
     */
    public function isWeekend(
        \DateTimeInterface $dateTime,
        array $weekendDays = [0, 6]
    ): bool {
        return \in_array((int) $dateTime->format('w'), $weekendDays, true);
    }

    /**
     * Returns a random number between $int1 and $int2 (any order).
     *
     * @throws \Exception
     *
     * @example 79907610
     */
    public static function numberBetween(int $int1 = 0, int $int2 = 2_147_483_647): int
    {
        $min = min($int1, $int2);
        $max = max($int1, $int2);

        return random_int($min, $max);
    }

    /**
     * Get a DateTime object based on a random date between two given dates.
     * Accepts date strings that can be recognized by `strtotime`.
     *
     * @param \DateTime|string $startDate Defaults to 30 years ago
     * @param \DateTime|string $endDate   Defaults to "now"
     * @param string|null      $timezone  time zone in which the date time should be set, default to DateTime::$defaultTimezone, if set, otherwise the result of `date_default_timezone_get`
     *
     * @throws \Exception
     *
     * @see http://php.net/manual/en/timezones.php
     * @see http://php.net/manual/en/function.date-default-timezone-get.php
     *
     * @example DateTime('1999-02-02 11:42:52')
     */
    public static function dateTimeBetween($startDate = '-30 years', $endDate = 'now', $timezone = null): \DateTimeInterface
    {
        $startTimestamp = $startDate instanceof \DateTime ? $startDate->getTimestamp() : strtotime($startDate);

        if (!$startTimestamp) {
            throw new \RuntimeException('unable to get timestamp for the start date');
        }

        $endTimestamp = static::getMaxTimestamp($endDate);

        if (!$endTimestamp) {
            throw new \RuntimeException('unable to get timestamp for the end date');
        }

        if ($startTimestamp > $endTimestamp) {
            throw new \InvalidArgumentException('Start date must be anterior to end date.');
        }

        $timestamp = random_int($startTimestamp, $endTimestamp);

        return static::setTimezone(
            new \DateTime('@'.$timestamp),
            $timezone
        );
    }

    public function randomYearFromArray(array $years): int
    {
        if ([] === $years) {
            throw new \InvalidArgumentException(' years array must not be empty');
        }

        return $years[(int) array_rand($years)];
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
     * @param int    $year     year for which Easter needs to be calculated
     * @param string $timezone timezone in which Easter is celebrated
     *
     * @return \DateTime date of Easter
     *
     * @throws \Exception
     *
     * @see  easter_days
     * @see https://github.com/php/php-src/blob/c8aa6f3a9a3d2c114d0c5e0c9fdd0a465dbb54a5/ext/calendar/easter.c
     * @see http://www.gmarts.org/index.php?go=415#EasterMallen
     * @see http://www.tondering.dk/claus/cal/easter.php
     */
    protected function calculateEaster(int $year, string $timezone): \DateTimeInterface
    {
        if (\extension_loaded('calendar')) {
            $easter_days = easter_days($year);
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

        $easter = new \DateTime("$year-3-21", new \DateTimeZone($timezone));
        $easter->add(new \DateInterval('P'.$easter_days.'D'));

        return $easter;
    }

    /**
     * @param \DateTime|string|float|int $max
     *
     * @return int|false
     */
    protected static function getMaxTimestamp($max = 'now')
    {
        if (is_numeric($max)) {
            $ts = (int) $max;
        } elseif ($max instanceof \DateTime) {
            $ts = $max->getTimestamp();
        } else {
            $ts = strtotime(empty($max) ? 'now' : $max);
        }

        return $ts;
    }

    private static function setTimezone(\DateTimeInterface $dt, ?string $timezone): \DateTimeInterface
    {
        return $dt->setTimezone(new \DateTimeZone(static::resolveTimezone($timezone)));
    }

    private static function resolveTimezone(?string $timezone): string
    {
        return $timezone ?? (static::$defaultTimezone ?? date_default_timezone_get());
    }
}
