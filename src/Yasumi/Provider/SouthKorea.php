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

namespace Yasumi\Provider;

use DateInterval;
use DateTime;
use Yasumi\Exception\InvalidDateException;
use Yasumi\Exception\UnknownLocaleException;
use Yasumi\Holiday;
use Yasumi\SubstituteHoliday;

/**
 * Provider for all holidays in the South Korea except for election day and temporary public holiday.
 *
 * @link https://en.wikipedia.org/wiki/Public_holidays_in_South_Korea
 */
class SouthKorea extends AbstractProvider
{
    use CommonHolidays, ChristianHolidays;

    /**
     * Code to identify this Holiday Provider. Typically this is the ISO3166 code corresponding to the respective
     * country or sub-region.
     */
    public const ID = 'KR';

    /**
     * Dates in Gregorian calendar of Seollal, Buddha's Birthday, and Chuseok (~ 2050)
     *
     * The Korean calendar is derived from the Chinese calendar. Although not being an official calendar, the
     * traditional Korean calendar is still maintained by the government. The current version is based on China's
     * Shixian calendar, which was in turn developed by Jesuit scholars. However, because the Korean calendar is now
     * based on the moon's shape seen from Korea, occasionally the calendar diverges from the traditional Chinese
     * calendar by one day, even though the underlying rule is the same.
     * @link https://en.wikipedia.org/wiki/Korean_calendar
     *
     * To convert from lunar calendar to Gregorian calendar, lunar observation is necessary.
     * There is no perfect formula, and as it moves away from the current date, the error becomes bigger.
     * Korea Astronomy and Space Science Institute (KASI) is supporting the converter until 2050.
     * For more information, please refer to the paper below.
     * 박(2017)총,32(3),407-420.
     * @link https://www.kasi.re.kr/kor/research/paper/20170259 - Korea Astronomy and Space Science Institute
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
            2035 => '2035-2-8', 2036 => '2036-1-28', 2037 => '2037-2-15', 2038 => '2038-2-4', 2039 => '2037-1-24',
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
            2000 => '2000-5-11', 2001 => '2001-4-30', 2002 => '2002-5-19', 2003 => '2003-5-8', 2004 => '2004-5-26',
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
            1994 => '1994-9-20', 1995 => '1950-9-9', 1996 => '1996-9-27', 1997 => '1997-9-16', 1998 => '1998-10-5',
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
     * Initialize holidays for South Korea.
     *
     * @throws InvalidDateException
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    public function initialize(): void
    {
        $this->timezone = 'Asia/Seoul';

        // Add common holidays
        $this->calculateNewYearsDay();
        if ($this->year >= 1949) {
            $this->addHoliday($this->christmasDay($this->year, $this->timezone, $this->locale));
        }

        // Calculate lunar holidays
        $this->calculateSeollal();
        $this->calculateBuddhasBirthday();
        $this->calculateChuseok();

        // Calculate other holidays
        $this->calculateIndependenceMovementDay();
        $this->calculateArborDay();
        $this->calculateChildrensDay();
        $this->calculateMemorialDay();
        $this->calculateConstitutionDay();
        $this->calculateLiberationDay();
        $this->calculateArmedForcesDay();
        $this->calculateNationalFoundationDay();
        $this->calculateHangulDay();
        $this->calculateSubstituteHolidays();
    }

    /**
     * New Year's Day. New Year's Day is held on January 1st and established since 1950.
     * From the enactment of the First Law to 1998, there was a two or three-day break in the New Year.
     *
     * @link https://en.wikipedia.org/wiki/New_Year%27s_Day#East_Asian
     *
     * @throws \Exception
     */
    public function calculateNewYearsDay(): void
    {
        if ($this->year >= 1950) {
            $this->addHoliday($this->newYearsDay($this->year, $this->timezone, $this->locale));
            if ($this->year <= 1998) {
                $this->addHoliday(new Holiday(
                    'dayAfterNewYearsDay',
                    [],
                    new DateTime("$this->year-1-2", DateTimeZoneFactory::getDateTimeZone($this->timezone)),
                    $this->locale
                ));
            }
            if ($this->year <= 1990) {
                $this->addHoliday(new Holiday(
                    'twoDaysLaterNewYearsDay',
                    ['en' => 'Two Days Later New Year’s Day', 'ko' => '새해 연휴'],
                    new DateTime("$this->year-1-3", DateTimeZoneFactory::getDateTimeZone($this->timezone)),
                    $this->locale
                ));
            }
        }
    }

    /**
     * Seollal (Korean New Year's Day).
     * Seollal is held on the 1st day of the 1st lunar month and was established from 1985.
     *
     * @link https://en.wikipedia.org/wiki/Korean_New_Year
     *
     * @throws \Exception
     */
    public function calculateSeollal(): void
    {
        if ($this->year >= 1985 && isset(self::LUNAR_HOLIDAY['seollal'][$this->year])) {
            $seollal = new DateTime(self::LUNAR_HOLIDAY['seollal'][$this->year], DateTimeZoneFactory::getDateTimeZone($this->timezone));
            $this->addHoliday(new Holiday(
                'seollal',
                ['en' => 'Seollal', 'ko' => '설날'],
                $seollal,
                $this->locale
            ));
            if ($this->year > 1989) {
                $dayBeforeSeollal = clone $seollal;
                $dayBeforeSeollal->sub(new DateInterval('P1D'));
                $this->addHoliday(new Holiday(
                    'dayBeforeSeollal',
                    ['en' => 'Day before Seollal', 'ko' => '설날 연휴'],
                    $dayBeforeSeollal,
                    $this->locale
                ));
                $dayAfterSeollal = clone $seollal;
                $dayAfterSeollal->add(new DateInterval('P1D'));
                $this->addHoliday(new Holiday(
                    'dayAfterSeollal',
                    ['en' => 'Day after Seollal', 'ko' => '설날 연휴'],
                    $dayAfterSeollal,
                    $this->locale
                ));
            }
        }
    }

    /**
     * Buddha's Birthday is held on the 8th day of the 4th lunar month and was established since 1975.
     *
     * @link https://en.wikipedia.org/wiki/Buddha%27s_Birthday
     *
     * @throws \Exception
     */
    public function calculateBuddhasBirthday(): void
    {
        if ($this->year >= 1975 && isset(self::LUNAR_HOLIDAY['buddhasBirthday'][$this->year])) {
            $this->addHoliday(new Holiday(
                'buddhasBirthday',
                ['en' => 'Buddha’s Birthday', 'ko' => '부처님오신날'],
                new DateTime(self::LUNAR_HOLIDAY['buddhasBirthday'][$this->year], DateTimeZoneFactory::getDateTimeZone($this->timezone)),
                $this->locale
            ));
        }
    }

    /**
     * Chuseok (Korean Thanksgiving Day).
     *
     * Chuseok, one of the biggest holidays in Korea, is a major harvest festival and a three-day holiday celebrated on
     * the 15th day of the 8th month of the lunar calendar on the full moon.
     *
     * @link https://en.wikipedia.org/wiki/Chuseok
     *
     * @throws \Exception
     */
    public function calculateChuseok(): void
    {
        if ($this->year >= 1949 && isset(self::LUNAR_HOLIDAY['chuseok'][$this->year])) {
            // Chuseok
            $chuseok = new Holiday(
                'chuseok',
                ['en' => 'Chuseok', 'ko' => '추석'],
                new DateTime(self::LUNAR_HOLIDAY['chuseok'][$this->year], DateTimeZoneFactory::getDateTimeZone($this->timezone)),
                $this->locale
            );
            $this->addHoliday($chuseok);

            // Day after Chuseok
            if ($this->year >= 1986) {
                $this->addHoliday(new Holiday(
                    'dayAfterChuseok',
                    ['en' => 'Day after Chuseok', 'ko' => '추석 연휴'],
                    (clone $chuseok)->add(new DateInterval('P1D')),
                    $this->locale
                ));
            }

            // Day before Chuseok
            if ($this->year >= 1989) {
                $this->addHoliday(new Holiday(
                    'dayBeforeChuseok',
                    ['en' => 'Day before Chuseok', 'ko' => '추석 연휴'],
                    (clone $chuseok)->sub(new DateInterval('P1D')),
                    $this->locale
                ));
            }
        }
    }

    /**
     * Independence Movement Day. Independence Movement Day is held on March 1st and was established from 1949.
     *
     * @link https://en.wikipedia.org/wiki/Independence_Movement_Day
     *
     * @throws \Exception
     */
    public function calculateIndependenceMovementDay(): void
    {
        if ($this->year >= 1949) {
            $this->addHoliday(new Holiday(
                'independenceMovementDay',
                ['en' => 'Independence Movement Day', 'ko' => '삼일절'],
                new DateTime("$this->year-3-1", DateTimeZoneFactory::getDateTimeZone($this->timezone)),
                $this->locale
            ));
        }
    }

    /**
     * Sikmogil (Arbor Day). Sikmogil is held on May 5th and established since 1949.
     *
     * @link https://en.wikipedia.org/wiki/Sikmogil
     *
     * @throws \Exception
     */
    public function calculateArborDay(): void
    {
        if (($this->year >= 1949 && $this->year < 1960) || ($this->year > 1960 && $this->year < 2006)) {
            $this->addHoliday(new Holiday(
                'arborDay',
                ['en' => 'Arbor Day', 'ko' => '식목일'],
                new DateTime("$this->year-4-5", DateTimeZoneFactory::getDateTimeZone($this->timezone)),
                $this->locale
            ));
        }
    }

    /**
     * Children's Day. Children's Day is held on May 5th and established since 1970.
     *
     * @link https://en.wikipedia.org/wiki/Children%27s_Day#South_Korea
     *
     * @throws \Exception
     */
    public function calculateChildrensDay(): void
    {
        if ($this->year >= 1970) {
            $this->addHoliday(new Holiday(
                'childrensDay',
                ['en' => 'Children’s Day', 'ko' => '어린이날'],
                new DateTime("$this->year-5-5", DateTimeZoneFactory::getDateTimeZone($this->timezone)),
                $this->locale
            ));
        }
    }

    /**
     * Memorial Day. Memorial Day is held on June 6th and established since 1956.
     *
     * @link https://en.wikipedia.org/wiki/Memorial_Day_(South_Korea)
     *
     * @throws \Exception
     */
    public function calculateMemorialDay(): void
    {
        if ($this->year >= 1966) {
            $this->addHoliday(new Holiday(
                'memorialDay',
                ['en' => 'Memorial Day', 'ko' => '현충일'],
                new DateTime("$this->year-6-6", DateTimeZoneFactory::getDateTimeZone($this->timezone)),
                $this->locale
            ));
        }
    }

    /**
     * Constitution Day.
     *
     * Constitution Day is held on July 17th and established since 1949.
     * Officially, it is a strict national holiday, but government offices and banks work normally after 2008.
     *
     * @link https://en.wikipedia.org/wiki/Constitution_Day_(South_Korea)
     *
     * @throws \Exception
     */
    public function calculateConstitutionDay(): void
    {
        if ($this->year >= 1949 && $this->year < 2008) {
            $this->addHoliday(new Holiday(
                'constitutionDay',
                ['en' => 'Constitution Day', 'ko' => '제헌절'],
                new DateTime("$this->year-7-17", DateTimeZoneFactory::getDateTimeZone($this->timezone)),
                $this->locale
            ));
        }
    }

    /**
     * Liberation Day. Liberation Day is held on August 15th and established since 1949.
     *
     * @link https://en.wikipedia.org/wiki/National_Liberation_Day_of_Korea
     *
     * @throws \Exception
     */
    public function calculateLiberationDay(): void
    {
        if ($this->year >= 1949) {
            $this->addHoliday(new Holiday(
                'liberationDay',
                ['en' => 'Liberation Day', 'ko' => '광복절'],
                new DateTime("$this->year-8-15", DateTimeZoneFactory::getDateTimeZone($this->timezone)),
                $this->locale
            ));
        }
    }

    /**
     * Armed Forces Day. Armed Forces Day is held on October 1st and established since 1956.
     *
     * @link https://en.wikipedia.org/wiki/Armed_Forces_Day_(South_Korea)
     *
     * @throws \Exception
     */
    public function calculateArmedForcesDay(): void
    {
        if ($this->year >= 1956 && $this->year <= 1990) {
            $this->addHoliday(new Holiday(
                'armedForcesDay',
                ['en' => 'Armed Forces Day', 'ko' => '국군의 날'],
                new DateTime("$this->year-10-1", DateTimeZoneFactory::getDateTimeZone($this->timezone)),
                $this->locale
            ));
        }
    }

    /**
     * Gaecheonjeol (National Foundation Day). Gaecheonjeol is held on October 3rd and established since 1949.
     *
     * @link https://en.wikipedia.org/wiki/Gaecheonjeol
     *
     * @throws \Exception
     */
    public function calculateNationalFoundationDay(): void
    {
        if ($this->year >= 1949) {
            $this->addHoliday(new Holiday(
                'nationalFoundationDay',
                ['en' => 'National Foundation Day', 'ko' => '개천절'],
                new DateTime("$this->year-10-3", DateTimeZoneFactory::getDateTimeZone($this->timezone)),
                $this->locale
            ));
        }
    }

    /**
     * Hangul Day. Hangul Day is held on October 9th and established since 1949.
     *
     * @link https://en.wikipedia.org/wiki/Hangul_Day
     *
     * @throws \Exception
     */
    public function calculateHangulDay(): void
    {
        if (($this->year >= 1949 && $this->year <= 1990) || $this->year > 2012) {
            $this->addHoliday(new Holiday(
                'hangulDay',
                ['en' => 'Hangul Day', 'ko' => '한글날'],
                new DateTime("$this->year-10-9", DateTimeZoneFactory::getDateTimeZone($this->timezone)),
                $this->locale
            ));
        }
    }

    /**
     * Substitute Holidays.
     * Related statutes: Article 3 Alternative Statutory Holidays of the Regulations on Holidays of Government Offices
     *
     * Since 2014, it has been applied only on Seollal, Chuseok and Children's Day.
     * Due to the lunar calendar, public holidays can overlap even if it's not a Sunday.
     * When public holidays fall on each other, the first non-public holiday after the holiday becomes a public holiday.
     * As an exception, Children's Day also applies on Saturday.
     *
     * @throws \Exception
     */
    public function calculateSubstituteHolidays(): void
    {
        if ($this->year <= 2013) {
            return;
        }

        // Initialize holidays variable
        $holidays = $this->getHolidays();
        $acceptedHolidays = [
            'dayBeforeSeollal', 'seollal', 'dayAfterSeollal',
            'dayBeforeChuseok', 'chuseok', 'dayAfterChuseok',
            'childrensDay',
        ];

        // Loop through all holidays
        foreach ($holidays as $key => $holiday) {
            // Get list of holiday dates except this
            $holidayDates = \array_map(static function ($holiday) use ($key) {
                return $holiday->getKey() === $key ? false : (string) $holiday;
            }, $holidays);

            // Only process accepted holidays and conditions
            if (\in_array($key, $acceptedHolidays, true)
                && (
                    0 === (int) $holiday->format('w')
                    || \in_array($holiday, $holidayDates, false)
                    || (6 === (int) $holiday->format('w') && 'childrensDay' === $key)
                )
            ) {
                $date = clone $holiday;

                // Find next week day (not being another holiday)
                while (0 === (int) $date->format('w')
                    || (6 === (int) $date->format('w') && 'childrensDay' === $key)
                    || \in_array($date, $holidayDates, false)) {
                    $date->add(new DateInterval('P1D'));
                    continue;
                }

                // Add a new holiday that is substituting the original holiday
                $substitute = new SubstituteHoliday(
                    $holiday,
                    [],
                    $date,
                    $this->locale
                );

                // Add a new holiday that is substituting the original holiday
                $this->addHoliday($substitute);

                // Add substitute holiday to the list
                $holidays[] = $substitute;
            }
        }
    }
}
