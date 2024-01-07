<?php

declare(strict_types=1);

/*
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 - 2024 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <me at sachatelgenhof dot com>
 */

namespace Yasumi\Provider;

use Yasumi\Exception\UnknownLocaleException;
use Yasumi\Holiday;
use Yasumi\SubstituteHoliday;

/**
 * Provider for all holidays in the South Korea except for election day and temporary public holiday.
 *
 * @see https://en.wikipedia.org/wiki/Public_holidays_in_South_Korea
 */
class SouthKorea extends AbstractProvider
{
    use CommonHolidays;
    use ChristianHolidays;

    /**
     * Code to identify this Holiday Provider. Typically, this is the ISO3166 code corresponding to the respective
     * country or sub-region.
     */
    public const ID = 'KR';

    /**
     * Dates in Gregorian calendar of Seollal, Buddha's Birthday, and Chuseok (~ 2050).
     *
     * The Korean calendar is derived from the Chinese calendar. Although not being an official calendar, the
     * traditional Korean calendar is still maintained by the government. The current version is based on China's
     * Shixian calendar, which was in turn developed by Jesuit scholars. However, because the Korean calendar is now
     * based on the moon's shape seen from Korea, occasionally the calendar diverges from the traditional Chinese
     * calendar by one day, even though the underlying rule is the same.
     *
     * @see https://en.wikipedia.org/wiki/Korean_calendar
     *
     * To convert from lunar calendar to Gregorian calendar, lunar observation is necessary.
     * There is no perfect formula, and as it moves away from the current date, the error becomes bigger.
     * Korea Astronomy and Space Science Institute (KASI) is supporting the converter until 2050.
     * For more information, please refer to the paper below.
     * 박(2017)총,32(3),407-420.
     * @see https://koreascience.kr/article/JAKO201706163145174.pdf - Korea Astronomy and Space Science Institute
     * @see https://astro.kasi.re.kr/life/pageView/8 - web utility for conversion and retrieve
     */
    public const LUNAR_HOLIDAY = [
        'seollal' => [
            1985 => '1985-2-20', 1986 => '1986-2-9', 1987 => '1987-1-29', 1988 => '1988-2-18', 1989 => '1989-2-6',
            1990 => '1990-1-27', 1991 => '1991-2-15', 1992 => '1992-2-4', 1993 => '1993-1-23', 1994 => '1994-2-10',
            1995 => '1995-1-31', 1996 => '1996-2-19', 1997 => '1997-2-8', 1998 => '1998-1-28', 1999 => '1999-2-16',
            2000 => '2000-2-5', 2001 => '2001-1-24', 2002 => '2002-2-12', 2003 => '2003-2-1', 2004 => '2004-1-22',
            2005 => '2005-2-9', 2006 => '2006-1-29', 2007 => '2007-2-18', 2008 => '2008-2-7', 2009 => '2009-1-26',
            2010 => '2010-2-14', 2011 => '2011-2-3', 2012 => '2012-1-23', 2013 => '2013-2-10', 2014 => '2014-1-31',
            2015 => '2015-2-19', 2016 => '2016-2-8', 2017 => '2017-1-28', 2018 => '2018-2-16', 2019 => '2019-2-5',
            2020 => '2020-1-25', 2021 => '2021-2-12', 2022 => '2022-2-1', 2023 => '2023-1-22', 2024 => '2024-2-10',
            2025 => '2025-1-29', 2026 => '2026-2-17', 2027 => '2027-2-7', 2028 => '2028-1-27', 2029 => '2029-2-13',
            2030 => '2030-2-3', 2031 => '2031-1-23', 2032 => '2032-2-11', 2033 => '2033-1-31', 2034 => '2034-2-19',
            2035 => '2035-2-8', 2036 => '2036-1-28', 2037 => '2037-2-15', 2038 => '2038-2-4', 2039 => '2039-1-24',
            2040 => '2040-2-12', 2041 => '2041-2-1', 2042 => '2042-1-22', 2043 => '2043-2-10', 2044 => '2044-1-30',
            2045 => '2045-2-17', 2046 => '2046-2-6', 2047 => '2047-1-26', 2048 => '2048-2-14', 2049 => '2049-2-2',
            2050 => '2050-1-23',
        ],
        'buddhasBirthday' => [
            1975 => '1975-5-18', 1976 => '1976-5-6', 1977 => '1977-5-25', 1978 => '1978-5-14', 1979 => '1979-5-3',
            1980 => '1980-5-21', 1981 => '1981-5-11', 1982 => '1982-5-1', 1983 => '1983-5-20', 1984 => '1984-5-8',
            1985 => '1985-5-27', 1986 => '1986-5-16', 1987 => '1987-5-5', 1988 => '1988-5-23', 1989 => '1989-5-12',
            1990 => '1990-5-2', 1991 => '1991-5-21', 1992 => '1992-5-10', 1993 => '1993-5-28', 1994 => '1994-5-18',
            1995 => '1995-5-7', 1996 => '1996-5-24', 1997 => '1997-5-14', 1998 => '1998-5-3', 1999 => '1999-5-22',
            2000 => '2000-5-11', 2001 => '2001-5-1', 2002 => '2002-5-19', 2003 => '2003-5-8', 2004 => '2004-5-26',
            2005 => '2005-5-15', 2006 => '2006-5-5', 2007 => '2007-5-24', 2008 => '2008-5-12', 2009 => '2009-5-2',
            2010 => '2010-5-21', 2011 => '2011-5-10', 2012 => '2012-5-28', 2013 => '2013-5-17', 2014 => '2014-5-6',
            2015 => '2015-5-25', 2016 => '2016-5-14', 2017 => '2017-5-3', 2018 => '2018-5-22', 2019 => '2019-5-12',
            2020 => '2020-4-30', 2021 => '2021-5-19', 2022 => '2022-5-8', 2023 => '2023-5-27', 2024 => '2024-5-15',
            2025 => '2025-5-5', 2026 => '2026-5-24', 2027 => '2027-5-13', 2028 => '2028-5-2', 2029 => '2029-5-20',
            2030 => '2030-5-9', 2031 => '2031-5-28', 2032 => '2032-5-16', 2033 => '2033-5-6', 2034 => '2034-5-25',
            2035 => '2035-5-15', 2036 => '2036-5-3', 2037 => '2037-5-22', 2038 => '2038-5-11', 2039 => '2039-4-30',
            2040 => '2040-5-18', 2041 => '2041-5-7', 2042 => '2042-5-26', 2043 => '2043-5-16', 2044 => '2044-5-5',
            2045 => '2045-5-24', 2046 => '2046-5-13', 2047 => '2047-5-2', 2048 => '2048-5-20', 2049 => '2049-5-9',
            2050 => '2050-5-28',
        ],
        'chuseok' => [
            1949 => '1949-10-6', 1950 => '1950-9-26', 1951 => '1951-9-15', 1952 => '1952-10-3', 1953 => '1953-9-22',
            1954 => '1954-9-11', 1955 => '1955-9-30', 1956 => '1956-9-19', 1957 => '1957-9-8', 1958 => '1958-9-27',
            1959 => '1959-9-17', 1960 => '1960-10-5', 1961 => '1961-9-24', 1962 => '1962-9-13', 1963 => '1963-10-2',
            1964 => '1964-9-20', 1965 => '1965-9-10', 1966 => '1966-9-29', 1967 => '1967-9-18', 1968 => '1968-10-6',
            1969 => '1969-9-26', 1970 => '1970-9-15', 1971 => '1971-10-3', 1972 => '1972-9-22', 1973 => '1973-9-11',
            1974 => '1974-9-30', 1975 => '1975-9-20', 1976 => '1976-9-8', 1977 => '1977-9-27', 1978 => '1978-9-17',
            1979 => '1979-10-5', 1980 => '1980-9-23', 1981 => '1981-9-12', 1982 => '1982-10-1', 1983 => '1983-9-21',
            1984 => '1984-9-10', 1985 => '1985-9-29', 1986 => '1986-9-18', 1987 => '1987-10-7', 1988 => '1988-9-25',
            1989 => '1989-9-14', 1990 => '1990-10-3', 1991 => '1991-9-22', 1992 => '1992-9-11', 1993 => '1993-9-30',
            1994 => '1994-9-20', 1995 => '1995-9-9', 1996 => '1996-9-27', 1997 => '1997-9-16', 1998 => '1998-10-5',
            1999 => '1999-9-24', 2000 => '2000-9-12', 2001 => '2001-10-1', 2002 => '2002-9-21', 2003 => '2003-9-11',
            2004 => '2004-9-28', 2005 => '2005-9-18', 2006 => '2006-10-6', 2007 => '2007-9-25', 2008 => '2008-9-14',
            2009 => '2009-10-3', 2010 => '2010-9-22', 2011 => '2011-9-12', 2012 => '2012-9-30', 2013 => '2013-9-19',
            2014 => '2014-9-8', 2015 => '2015-9-27', 2016 => '2016-9-15', 2017 => '2017-10-4', 2018 => '2018-9-24',
            2019 => '2019-9-13', 2020 => '2020-10-1', 2021 => '2021-9-21', 2022 => '2022-9-10', 2023 => '2023-9-29',
            2024 => '2024-9-17', 2025 => '2025-10-6', 2026 => '2026-9-25', 2027 => '2027-9-15', 2028 => '2028-10-3',
            2029 => '2029-9-22', 2030 => '2030-9-12', 2031 => '2031-10-1', 2032 => '2032-9-19', 2033 => '2033-9-8',
            2034 => '2034-9-27', 2035 => '2035-9-16', 2036 => '2036-10-4', 2037 => '2037-9-24', 2038 => '2038-9-13',
            2039 => '2039-10-2', 2040 => '2040-9-21', 2041 => '2041-9-10', 2042 => '2042-9-28', 2043 => '2043-9-17',
            2044 => '2044-10-5', 2045 => '2045-9-25', 2046 => '2046-9-15', 2047 => '2047-10-4', 2048 => '2048-9-22',
            2049 => '2049-9-11', 2050 => '2050-9-30',
        ],
    ];

    /**
     * Collection of all historically recognized holidays in South Korea.
     *
     * Aggregated collection of all historically recognized holidays of South Korea After the government was established.
     * This collection also includes items that are now obsolete and excluded from holidays.
     */
    public const HOLIDAY_NAMES = [
        'newYearsDay' => [],
        'dayAfterNewYearsDay' => [],
        'twoDaysLaterNewYearsDay' => [
            'en' => 'Two Days Later New Year’s Day',
            'ko' => '새해 연휴',
        ],
        'seollal' => [
            'en' => 'Seollal',
            'ko' => '설날',
        ],
        'dayBeforeSeollal' => [
            'en' => 'Day before Seollal',
            'ko' => '설날 연휴',
        ],
        'dayAfterSeollal' => [
            'en' => 'Day after Seollal',
            'ko' => '설날 연휴',
        ],
        'independenceMovementDay' => [
            'en' => 'Independence Movement Day',
            'ko' => '삼일절',
        ],
        'arborDay' => [
            'en' => 'Arbor Day',
            'ko' => '식목일',
        ],
        'buddhasBirthday' => [
            'en' => 'Buddha’s Birthday',
            'ko' => '부처님오신날',
        ],
        'childrensDay' => [
            'en' => 'Children’s Day',
            'ko' => '어린이날',
        ],
        'memorialDay' => [
            'en' => 'Memorial Day',
            'ko' => '현충일',
        ],
        'constitutionDay' => [
            'en' => 'Constitution Day',
            'ko' => '제헌절',
        ],
        'liberationDay' => [
            'en' => 'Liberation Day',
            'ko' => '광복절',
        ],
        'chuseok' => [
            'en' => 'Chuseok',
            'ko' => '추석',
        ],
        'dayBeforeChuseok' => [
            'en' => 'Day before Chuseok',
            'ko' => '추석 연휴',
        ],
        'dayAfterChuseok' => [
            'en' => 'Day after Chuseok',
            'ko' => '추석 연휴',
        ],
        'armedForcesDay' => [
            'en' => 'Armed Forces Day',
            'ko' => '국군의 날',
        ],
        'nationalFoundationDay' => [
            'en' => 'National Foundation Day',
            'ko' => '개천절',
        ],
        'hangulDay' => [
            'en' => 'Hangul Day',
            'ko' => '한글날',
        ],
        'unitedNationsDay' => [
            'en' => 'United Nations Day',
            'ko' => '유엔의 날',
        ],
        'christmasDay' => [],
    ];

    /**
     * Initialize holidays for South Korea.
     *
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    public function initialize(): void
    {
        $this->timezone = 'Asia/Seoul';

        // Fast-fail when before 1949
        if ($this->year < 1949) {
            return;
        }

        $officialHolidays = $this->year < 2013 ? $this->calculateBefore2013($this->year) : $this->calculateCurrent();

        foreach ($officialHolidays as $holiday) {
            $this->addHoliday($this->{$holiday}($this->year, $this->timezone, $this->locale));
        }

        // Substitute Holidays
        $this->calculateSubstituteHolidays($this->year);
    }

    public function getSources(): array
    {
        return [
            'https://en.wikipedia.org/wiki/Public_holidays_in_South_Korea',
            'https://ko.wikipedia.org/wiki/%EB%8C%80%ED%95%9C%EB%AF%BC%EA%B5%AD%EC%9D%98_%EA%B3%B5%ED%9C%B4%EC%9D%BC',
            'https://english.visitkorea.or.kr/enu/TRV/TV_ENG_1_1.jsp',
        ];
    }

    public function addHoliday(?Holiday $holiday): void
    {
        if (isset($holiday)) {
            parent::addHoliday($holiday);
        }
    }

    /**
     * The day after New Year's Day (January 2)
     * This day was established in 1949 and then removed as a public holiday in 1999.
     */
    protected function dayAfterNewYearsDay(
        int $year,
        string $timezone,
        string $locale,
        string $type = Holiday::TYPE_OFFICIAL
    ): Holiday {
        return new Holiday(
            'dayAfterNewYearsDay',
            $this->getTranslations('dayAfterNewYearsDay', $year),
            new \DateTime("{$year}-1-2", DateTimeZoneFactory::getDateTimeZone($timezone)),
            $locale,
            $type
        );
    }

    /**
     * Two days after the New Year's (January 3)
     * This day was established in 1949 and then removed as a public holiday in 1990.
     */
    protected function twoDaysLaterNewYearsDay(
        int $year,
        string $timezone,
        string $locale,
        string $type = Holiday::TYPE_OFFICIAL
    ): Holiday {
        return new Holiday(
            'twoDaysLaterNewYearsDay',
            $this->getTranslations('twoDaysLaterNewYearsDay', $year),
            new \DateTime("{$year}-1-3", DateTimeZoneFactory::getDateTimeZone($timezone)),
            $locale,
            $type
        );
    }

    /**
     * Seollal (Korean New Year's Day).
     * Seollal is held on the 1st day of the 1st lunar month and was established from 1985.
     *
     * Seollal was celebrated with only one day off when it was established in 1985, and then changed to a three-day holiday in 1989.
     *
     * @see https://en.wikipedia.org/wiki/Korean_New_Year
     */
    protected function seollal(
        int $year,
        string $timezone,
        string $locale,
        string $type = Holiday::TYPE_OFFICIAL
    ): ?Holiday {
        if (! isset(self::LUNAR_HOLIDAY['seollal'][$year])) {
            return null;
        }

        $seollal = self::LUNAR_HOLIDAY['seollal'][$year];

        return new Holiday(
            'seollal',
            $this->getTranslations('seollal', $year),
            new \DateTime($seollal, DateTimeZoneFactory::getDateTimeZone($timezone)),
            $locale,
            $type
        );
    }

    /**
     * The day before Seollal (Korean New Year's Day).
     * Seollal is held on the 1st day of the 1st lunar month and was established from 1985.
     *
     * Seollal was celebrated with only one day off when it was established in 1985, and then changed to a three-day holiday in 1989.
     *
     * @see https://en.wikipedia.org/wiki/Korean_New_Year
     */
    protected function dayBeforeSeollal(
        int $year,
        string $timezone,
        string $locale,
        string $type = Holiday::TYPE_OFFICIAL
    ): ?Holiday {
        if (! isset(self::LUNAR_HOLIDAY['seollal'][$year])) {
            return null;
        }

        $seollal = self::LUNAR_HOLIDAY['seollal'][$year];

        return new Holiday(
            'dayBeforeSeollal',
            $this->getTranslations('dayBeforeSeollal', $year),
            new \DateTime("-1 day {$seollal}", DateTimeZoneFactory::getDateTimeZone($timezone)),
            $locale,
            $type
        );
    }

    /**
     * The day after Seollal (Korean New Year's Day).
     * Seollal is held on the 1st day of the 1st lunar month and was established from 1985.
     *
     * Seollal was celebrated with only one day off when it was established in 1985, and then changed to a three-day holiday in 1989.
     *
     * @see https://en.wikipedia.org/wiki/Korean_New_Year
     */
    protected function dayAfterSeollal(
        int $year,
        string $timezone,
        string $locale,
        string $type = Holiday::TYPE_OFFICIAL
    ): ?Holiday {
        if (! isset(self::LUNAR_HOLIDAY['seollal'][$year])) {
            return null;
        }

        $seollal = self::LUNAR_HOLIDAY['seollal'][$year];

        return new Holiday(
            'dayAfterSeollal',
            $this->getTranslations('dayAfterSeollal', $year),
            new \DateTime("+1 day {$seollal}", DateTimeZoneFactory::getDateTimeZone($timezone)),
            $locale,
            $type
        );
    }

    /**
     * Independence Movement Day.
     * Independence Movement Day is held on March 1st and was established from 1949.
     *
     * @see https://en.wikipedia.org/wiki/Independence_Movement_Day
     */
    protected function independenceMovementDay(
        int $year,
        string $timezone,
        string $locale,
        string $type = Holiday::TYPE_OFFICIAL
    ): Holiday {
        return new Holiday(
            'independenceMovementDay',
            $this->getTranslations('independenceMovementDay', $year),
            new \DateTime("{$year}-3-1", DateTimeZoneFactory::getDateTimeZone($timezone)),
            $locale,
            $type
        );
    }

    /**
     * Sikmogil (Arbor Day).
     * Sikmogil is held on April 5th and established since 1949, but was removed as a public holiday in 2006.
     *
     * @see https://en.wikipedia.org/wiki/Sikmogil
     */
    protected function arborDay(
        int $year,
        string $timezone,
        string $locale,
        string $type = Holiday::TYPE_OFFICIAL
    ): Holiday {
        $datetime = 1960 === $year ? "{$year}-3-21" : "{$year}-4-5";

        return new Holiday(
            'arborDay',
            $this->getTranslations('arborDay', $year),
            new \DateTime($datetime, DateTimeZoneFactory::getDateTimeZone($timezone)),
            $locale,
            $type
        );
    }

    /**
     * Buddha's Birthday.
     * Buddha's Birthday is held on the 8th day of the 4th lunar month and was established since 1975.
     *
     * @see https://en.wikipedia.org/wiki/Buddha%27s_Birthday
     */
    protected function buddhasBirthday(
        int $year,
        string $timezone,
        string $locale,
        string $type = Holiday::TYPE_OFFICIAL
    ): ?Holiday {
        if (! isset(self::LUNAR_HOLIDAY['buddhasBirthday'][$year])) {
            return null;
        }

        $buddhasBirthday = self::LUNAR_HOLIDAY['buddhasBirthday'][$year];

        return new Holiday(
            'buddhasBirthday',
            $this->getTranslations('buddhasBirthday', $year),
            new \DateTime($buddhasBirthday, DateTimeZoneFactory::getDateTimeZone($timezone)),
            $locale,
            $type
        );
    }

    /**
     * Children's Day.
     * Children's Day is held on May 5th and established since 1975.
     *
     * @see https://en.wikipedia.org/wiki/Children%27s_Day#South_Korea
     */
    protected function childrensDay(
        int $year,
        string $timezone,
        string $locale,
        string $type = Holiday::TYPE_OFFICIAL
    ): Holiday {
        return new Holiday(
            'childrensDay',
            $this->getTranslations('childrensDay', $year),
            new \DateTime("{$year}-5-5", DateTimeZoneFactory::getDateTimeZone($timezone)),
            $locale,
            $type
        );
    }

    /**
     * Memorial Day.
     * Memorial Day is held on June 6th and established since 1956.
     *
     * @see https://en.wikipedia.org/wiki/Memorial_Day_(South_Korea)
     */
    protected function memorialDay(
        int $year,
        string $timezone,
        string $locale,
        string $type = Holiday::TYPE_OFFICIAL
    ): Holiday {
        return new Holiday(
            'memorialDay',
            $this->getTranslations('memorialDay', $year),
            new \DateTime("{$year}-6-6", DateTimeZoneFactory::getDateTimeZone($timezone)),
            $locale,
            $type
        );
    }

    /**
     * Constitution Day.
     * Constitution Day is held on July 17th and established since 1949.
     *
     * It was originally a public holiday recognized by the South Korean government,
     * but was removed as a public holiday in 2008 and is now a national day rather than a public holiday.
     *
     * @see https://en.wikipedia.org/wiki/Constitution_Day_(South_Korea)
     */
    protected function constitutionDay(
        int $year,
        string $timezone,
        string $locale,
        string $type = Holiday::TYPE_OFFICIAL
    ): Holiday {
        return new Holiday(
            'constitutionDay',
            $this->getTranslations('constitutionDay', $year),
            new \DateTime("{$year}-7-17", DateTimeZoneFactory::getDateTimeZone($timezone)),
            $locale,
            $type
        );
    }

    /**
     * Liberation Day.
     * Liberation Day is held on August 15th and established since 1949.
     *
     * @see https://en.wikipedia.org/wiki/National_Liberation_Day_of_Korea
     */
    protected function liberationDay(
        int $year,
        string $timezone,
        string $locale,
        string $type = Holiday::TYPE_OFFICIAL
    ): Holiday {
        return new Holiday(
            'liberationDay',
            $this->getTranslations('liberationDay', $year),
            new \DateTime("{$year}-8-15", DateTimeZoneFactory::getDateTimeZone($timezone)),
            $locale,
            $type
        );
    }

    /**
     * Chuseok (Korean Thanksgiving Day).
     *
     * Chuseok, one of the biggest holidays in Korea, is a major harvest festival and a three-day holiday celebrated on
     * the 15th day of the 8th month of the lunar calendar on the full moon.
     * Chuseok was a one-day holiday when it was established in 1945, but was changed to a three-day holiday in 1989.
     *
     * @see https://en.wikipedia.org/wiki/Chuseok
     */
    protected function chuseok(
        int $year,
        string $timezone,
        string $locale,
        string $type = Holiday::TYPE_OFFICIAL
    ): ?Holiday {
        if (! isset(self::LUNAR_HOLIDAY['chuseok'][$year])) {
            return null;
        }

        $choseok = self::LUNAR_HOLIDAY['chuseok'][$year];

        return new Holiday(
            'chuseok',
            $this->getTranslations('chuseok', $year),
            new \DateTime($choseok, DateTimeZoneFactory::getDateTimeZone($timezone)),
            $locale,
            $type
        );
    }

    /**
     * The day before Chuseok (Korean Thanksgiving Day).
     *
     * Chuseok, one of the biggest holidays in Korea, is a major harvest festival and a three-day holiday celebrated on
     * the 15th day of the 8th month of the lunar calendar on the full moon.
     * Chuseok was a one-day holiday when it was established in 1945, but was changed to a three-day holiday in 1989.
     *
     * @see https://en.wikipedia.org/wiki/Chuseok
     */
    protected function dayBeforeChuseok(
        int $year,
        string $timezone,
        string $locale,
        string $type = Holiday::TYPE_OFFICIAL
    ): ?Holiday {
        if (! isset(self::LUNAR_HOLIDAY['chuseok'][$year])) {
            return null;
        }

        $choseok = self::LUNAR_HOLIDAY['chuseok'][$year];

        return new Holiday(
            'dayBeforeChuseok',
            $this->getTranslations('dayBeforeChuseok', $year),
            new \DateTime("-1 day {$choseok}", DateTimeZoneFactory::getDateTimeZone($timezone)),
            $locale,
            $type
        );
    }

    /**
     * The day after Chuseok (Korean Thanksgiving Day).
     *
     * Chuseok, one of the biggest holidays in Korea, is a major harvest festival and a three-day holiday celebrated on
     * the 15th day of the 8th month of the lunar calendar on the full moon.
     * Chuseok was a one-day holiday when it was established in 1945, but was changed to a three-day holiday in 1989.
     *
     * @see https://en.wikipedia.org/wiki/Chuseok
     */
    protected function dayAfterChuseok(
        int $year,
        string $timezone,
        string $locale,
        string $type = Holiday::TYPE_OFFICIAL
    ): ?Holiday {
        if (! isset(self::LUNAR_HOLIDAY['chuseok'][$year])) {
            return null;
        }

        $choseok = self::LUNAR_HOLIDAY['chuseok'][$year];

        return new Holiday(
            'dayAfterChuseok',
            $this->getTranslations('dayAfterChuseok', $year),
            new \DateTime("+1 day {$choseok}", DateTimeZoneFactory::getDateTimeZone($timezone)),
            $locale,
            $type
        );
    }

    /**
     * Armed Forces Day.
     * Armed Forces Day is held on October 1st and established since 1956.
     *
     * Armed Forces Day, established in 1956, was made a public holiday in 1976 and then removed again in 1991.
     *
     * @see unitedNationsDay
     * @see https://en.wikipedia.org/wiki/Armed_Forces_Day_(South_Korea)
     */
    protected function armedForcesDay(
        int $year,
        string $timezone,
        string $locale,
        string $type = Holiday::TYPE_OFFICIAL
    ): Holiday {
        return new Holiday(
            'armedForcesDay',
            $this->getTranslations('armedForcesDay', $year),
            new \DateTime("{$year}-10-1", DateTimeZoneFactory::getDateTimeZone($timezone)),
            $locale,
            $type
        );
    }

    /**
     * Gaecheonjeol (National Foundation Day).
     * Gaecheonjeol is held on October 3rd and established since 1949.
     *
     * @see https://en.wikipedia.org/wiki/Gaecheonjeol
     */
    protected function nationalFoundationDay(
        int $year,
        string $timezone,
        string $locale,
        string $type = Holiday::TYPE_OFFICIAL
    ): Holiday {
        return new Holiday(
            'nationalFoundationDay',
            $this->getTranslations('nationalFoundationDay', $year),
            new \DateTime("{$year}-10-3", DateTimeZoneFactory::getDateTimeZone($timezone)),
            $locale,
            $type
        );
    }

    /**
     * Hangul Day.
     * Hangul Day is held on October 9th and established since 1949.
     *
     * Hangul Day, established in 1949, was removed as a public holiday in 1991 and included again in 2013.
     *
     * @see https://en.wikipedia.org/wiki/Hangul_Day
     */
    protected function hangulDay(
        int $year,
        string $timezone,
        string $locale,
        string $type = Holiday::TYPE_OFFICIAL
    ): Holiday {
        return new Holiday(
            'hangulDay',
            $this->getTranslations('hangulDay', $year),
            new \DateTime("{$year}-10-9", DateTimeZoneFactory::getDateTimeZone($timezone)),
            $locale,
            $type
        );
    }

    /**
     * United Nations Day.
     *
     * On September 18, 1950, the day of the formation of the United Nations, International United Nations Day was established as a public holiday.
     * Later, on September 3, 1976, United Nations Day was removed as a public holiday and Armed Forces Day was established as a new public holiday.
     *
     * @see https://ko.wikipedia.org/wiki/%EC%9C%A0%EC%97%94%EC%9D%98_%EB%82%A0#%EB%8C%80%ED%95%9C%EB%AF%BC%EA%B5%AD
     */
    protected function unitedNationsDay(
        int $year,
        string $timezone,
        string $locale,
        string $type = Holiday::TYPE_OFFICIAL
    ): Holiday {
        return new Holiday(
            'unitedNationsDay',
            $this->getTranslations('unitedNationsDay', $year),
            new \DateTime("{$year}-10-24", DateTimeZoneFactory::getDateTimeZone($timezone)),
            $locale,
            $type
        );
    }

    /**
     * Get holiday names for translation.
     *
     * @return array<string>
     */
    protected function getTranslations(string $key, int $year): array
    {
        $names = self::HOLIDAY_NAMES[$key] ?? [];

        if ('arborDay' === $key && 1960 === $year) {
            $names = ['en' => 'Arbor Day', 'ko' => '사방의 날'];
        }

        return $names;
    }

    /**
     * Holidays in used from 1949 until 2012.
     *
     * @return array<string> list of holidays
     */
    private function calculateBefore2013(int $year): array
    {
        $officialHolidays = [];

        if ($year >= 1949) {
            $officialHolidays[] = 'independenceMovementDay';
            $officialHolidays[] = 'liberationDay';
            $officialHolidays[] = 'nationalFoundationDay';
            $officialHolidays[] = 'newYearsDay';
            $officialHolidays[] = 'chuseok';
            $officialHolidays[] = 'christmasDay';

            if ($year >= 1950 && $year < 1976) {
                $officialHolidays[] = 'unitedNationsDay';
            }

            if ($year >= 1956) {
                $officialHolidays[] = 'memorialDay';
            }

            if ($year >= 1975) {
                $officialHolidays[] = 'childrensDay';
                $officialHolidays[] = 'buddhasBirthday';
            }

            if ($year >= 1976 && $year <= 1990) {
                $officialHolidays[] = 'armedForcesDay';
            }

            if ($year >= 1985) {
                $officialHolidays[] = 'seollal';
            }

            if ($year >= 1986) {
                $officialHolidays[] = 'dayAfterChuseok';
            }

            if ($year >= 1989) {
                $officialHolidays[] = 'dayBeforeChuseok';
                $officialHolidays[] = 'dayBeforeSeollal';
                $officialHolidays[] = 'dayAfterSeollal';
            }

            if ($year <= 1989) {
                $officialHolidays[] = 'twoDaysLaterNewYearsDay';
            }

            if ($year <= 1990 || $year > 2012) {
                $officialHolidays[] = 'hangulDay';
            }

            if ($year <= 1998) {
                $officialHolidays[] = 'dayAfterNewYearsDay';
            }

            if ($year <= 2005) {
                $officialHolidays[] = 'arborDay';
            }

            if ($year < 2008) {
                $officialHolidays[] = 'constitutionDay';
            }
        }

        return $officialHolidays;
    }

    /**
     * Holidays in use since 2013.
     *
     * @return array<string> list of holidays
     */
    private function calculateCurrent(): array
    {
        return [
            'newYearsDay',
            'dayBeforeSeollal',
            'seollal',
            'dayAfterSeollal',
            'independenceMovementDay',
            'buddhasBirthday',
            'childrensDay',
            'memorialDay',
            'liberationDay',
            'dayBeforeChuseok',
            'chuseok',
            'dayAfterChuseok',
            'nationalFoundationDay',
            'hangulDay',
            'christmasDay',
        ];
    }

    /**
     * Substitute Holidays up to 2022.
     * Related statutes: Article 3 Alternative Statutory Holidays of the Regulations on Holidays of Government Offices.
     *
     * Since 2014, it has been applied only on Seollal, Chuseok and Children's Day.
     * Due to the lunar calendar, public holidays can overlap even if it's not a Sunday.
     * When public holidays fall on each other, the first non-public holiday after the holiday becomes a public holiday.
     * As an exception, Children's Day also applies on Saturday.
     *
     * Since new legislation about public holiday was enacted in June 2021,
     * this function is used to calculate the holidays up to 2022.
     *
     * @throws \Exception
     */
    private function calculateOldSubstituteHolidays(int $year): void
    {
        // Add substitute holidays by fixed entries.
        switch ($year) {
            case 1959:
                $this->addSubstituteHoliday($this->getHoliday('arborDay'), "{$year}-4-6");
                break;
            case 1960:
                $this->addSubstituteHoliday($this->getHoliday('constitutionDay'), "{$year}-7-18");
                $this->addSubstituteHoliday($this->getHoliday('hangulDay'), "{$year}-10-10");
                $this->addSubstituteHoliday($this->getHoliday('christmasDay'), "{$year}-12-26");
                break;
            case 1989:
                $this->addSubstituteHoliday($this->getHoliday('armedForcesDay'), "{$year}-10-2");
                break;
            case 2014:
                $this->addSubstituteHoliday($this->getHoliday('dayBeforeChuseok'), "{$year}-9-10");
                break;
            case 2015:
                $this->addSubstituteHoliday($this->getHoliday('chuseok'), "{$year}-9-29");
                break;
            case 2016:
                $this->addSubstituteHoliday($this->getHoliday('dayBeforeSeollal'), "{$year}-2-10");
                break;
            case 2017:
                $this->addSubstituteHoliday($this->getHoliday('dayAfterSeollal'), "{$year}-1-30");
                $this->addSubstituteHoliday($this->getHoliday('dayBeforeChuseok'), "{$year}-10-6");
                break;
            case 2018:
                $this->addSubstituteHoliday($this->getHoliday('childrensDay'), "{$year}-5-7");
                $this->addSubstituteHoliday($this->getHoliday('dayBeforeChuseok'), "{$year}-9-26");
                break;
            case 2019:
                $this->addSubstituteHoliday($this->getHoliday('childrensDay'), "{$year}-5-6");
                break;
            case 2020:
                $this->addSubstituteHoliday($this->getHoliday('dayAfterSeollal'), "{$year}-1-27");
                break;
            case 2021:
                $this->addSubstituteHoliday($this->getHoliday('liberationDay'), "{$year}-8-16");
                $this->addSubstituteHoliday($this->getHoliday('nationalFoundationDay'), "{$year}-10-4");
                $this->addSubstituteHoliday($this->getHoliday('hangulDay'), "{$year}-10-11");
                break;
            case 2022:
                $this->addSubstituteHoliday($this->getHoliday('dayAfterChuseok'), "{$year}-9-12");
                $this->addSubstituteHoliday($this->getHoliday('hangulDay'), "{$year}-10-10");
                break;
        }
    }

    /**
     * Substitute Holidays.
     *
     * Since 2022, it has been applied for all public holidays.
     * When public holidays overlap on each other or weekend,
     * the first working day after the holiday becomes a substitute holiday.
     *
     * @throws \Exception
     */
    private function calculateSubstituteHolidays(int $year): void
    {
        if ($year < 2023) {
            $this->calculateOldSubstituteHolidays($year);

            return;
        }

        // List of holidays allowed for substitution.
        $acceptedHolidays = $this->calculateAcceptedSubstituteHolidays($year);

        // Step 1. Build a temporary table that aggregates holidays by date.
        $dates = [];
        foreach ($this->getHolidayDates() as $name => $day) {
            $holiday = $this->getHoliday((string) $name);
            $dates[$day][] = $name;

            if (! isset($acceptedHolidays[$name])) {
                continue;
            }

            if (! $holiday instanceof Holiday) {
                continue;
            }

            $dayOfWeek = (int) $holiday->format('w');
            if (\in_array($dayOfWeek, $acceptedHolidays[$name], true)) {
                $dates[$day]['weekend:'.$day] = $name;
            }
        }

        // Step 2. Add substitute holidays by referring to the temporary table.
        $tz = DateTimeZoneFactory::getDateTimeZone($this->timezone);
        foreach ($dates as $day => $names) {
            $count = \count($names);
            if ($count < 2) {
                continue;
            }

            // In a temporary table, public holidays are keyed by numeric number.
            // And weekends are keyed by string start with 'weekend:'.
            // For the substitute, we will use first item in queue.
            $origin = $this->getHoliday((string) $names[0]);
            $nextWorkingDay = \DateTime::createFromFormat('Y-m-d', $day, $tz);
            if ($nextWorkingDay instanceof \DateTime) {
                $workDay = $this->nextWorkingDay($nextWorkingDay);
                $this->addSubstituteHoliday($origin, $workDay->format('Y-m-d'));
            }
        }
    }

    /**
     * Return a dictionary of substitute holiday
     * Government-recognized holidays will be replaced with an alternative holiday if they overlap with a Saturday or Sunday.
     * This dictionary contains information about which day of the week the holiday is replaced when it falls on.
     *
     * @return array<string, array<int>>
     */
    private function calculateAcceptedSubstituteHolidays(int $year): array
    {
        // List of holidays allowed for substitution.
        // This dictionary has key => value mappings.
        // each key is key of holiday and value contains day of week (saturday or sunday or both)
        // value meaning : 0 = saturday, 1 = sunday
        $acceptedHolidays = [];

        if ($year < 2023) {
            return $acceptedHolidays;
        }

        // When deciding on alternative holidays, place lunar holidays first for consistent rules.
        // These holidays will substitute for the sunday only.
        $acceptedHolidays += array_fill_keys([
            'dayBeforeSeollal', 'seollal', 'dayAfterSeollal',
            'dayBeforeChuseok', 'chuseok', 'dayAfterChuseok',
        ], [0]);

        // These holidays will substitute for any weekend days (Sunday and Saturday).
        // 'buddhasBirthday' and 'christmasDay' included as alternative holiday in May 2023.
        $acceptedHolidays += array_fill_keys([
            'childrensDay', 'independenceMovementDay', 'liberationDay',
            'nationalFoundationDay', 'hangulDay', 'buddhasBirthday', 'christmasDay',
        ], [0, 6]);

        return $acceptedHolidays;
    }

    /**
     * Helper method to find a first working day after specific date.
     */
    private function nextWorkingDay(\DateTime $date): \DateTime
    {
        $interval = new \DateInterval('P1D');
        $next = clone $date;
        do {
            $next->add($interval);
        } while (! $this->isWorkingDay($next));

        return $next;
    }

    /**
     * Helper method to add substitute holiday.
     *
     * Add a substitute holiday from origin holiday to different date.
     *
     * @throws \Exception
     */
    private function addSubstituteHoliday(?Holiday $origin, string $date_str): void
    {
        if (! $origin instanceof Holiday) {
            return;
        }

        $this->addHoliday(new SubstituteHoliday(
            $origin,
            [],
            new \DateTime($date_str, DateTimeZoneFactory::getDateTimeZone($this->timezone)),
            $this->locale
        ));
    }
}
