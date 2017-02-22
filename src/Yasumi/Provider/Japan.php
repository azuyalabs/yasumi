<?php

/**
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 - 2017 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <stelgenhof@gmail.com>
 */

namespace Yasumi\Provider;

use DateInterval;
use DateTime;
use DateTimeZone;
use Yasumi\Holiday;

/**
 * Provider for all holidays in the Japan.
 */
class Japan extends AbstractProvider
{
    use CommonHolidays;

    /**
     * Code to identify this Holiday Provider. Typically this is the ISO3166 code corresponding to the respective
     * country or sub-region.
     */
    const ID = 'JP';

    /**
     * The gradient parameter of the approximate expression to calculate equinox day.
     */
    const EQUINOX_GRADIENT = 0.242194;

    /**
     * The initial parameter of the approximate expression to calculate vernal equinox day from 1900 to 1979.
     */
    const VERNAL_EQUINOX_PARAM_1979 = 20.8357;

    /**
     * The initial parameter of the approximate expression to calculate vernal equinox day from 1980 to 2099.
     */
    const VERNAL_EQUINOX_PARAM_2099 = 20.8431;

    /**
     * The initial parameter of the approximate expression to calculate vernal equinox day from 2100 to 2150.
     */
    const VERNAL_EQUINOX_PARAM_2150 = 21.8510;

    /**
     * The initial parameter of the approximate expression to calculate autumnal equinox day from 1851 to 1899.
     */
    const AUTUMNAL_EQUINOX_PARAM_1899 = 22.2588;

    /**
     * The initial parameter of the approximate expression to calculate autumnal equinox day from 1900 to 1979.
     */
    const AUTUMNAL_EQUINOX_PARAM_1979 = 23.2588;

    /**
     * The initial parameter of the approximate expression to calculate autumnal equinox day from 1980 to 2099.
     */
    const AUTUMNAL_EQUINOX_PARAM_2099 = 23.2488;

    /**
     * The initial parameter of the approximate expression to calculate autumnal equinox day from 2100 to 2150.
     */
    const AUTUMNAL_EQUINOX_PARAM_2150 = 24.2488;

    /**
     * Initialize holidays for Japan.
     *
     * @throws \InvalidArgumentException
     * @throws \Yasumi\Exception\UnknownLocaleException
     */
    public function initialize()
    {
        $this->timezone = 'Asia/Tokyo';

        /**
         * New Year's Day. New Year's Day in Japan is established since 1948.
         */
        if ($this->year >= 1948) {
            $this->addHoliday($this->newYearsDay($this->year, $this->timezone, $this->locale));
        }

        /**
         * National Foundation Day. National Foundation Day is held on February 11th and established since 1966.
         */
        if ($this->year >= 1966) {
            $holiday = new Holiday('nationalFoundationDay', ['en_US' => 'National Foundation Day', 'ja_JP' => '建国記念の日'],
                new DateTime("$this->year-2-11", new DateTimeZone($this->timezone)), $this->locale);
            $this->addHoliday($holiday);
        }

        /**
         * Showa Day. Showa Day is held on April 29th and established since 2007.
         */
        if ($this->year >= 2007) {
            $this->addHoliday(new Holiday('showaDay', ['en_US' => 'Showa Day', 'ja_JP' => '昭和の日'],
                new DateTime("$this->year-4-29", new DateTimeZone($this->timezone)), $this->locale));
        }

        /**
         * Constitution Memorial Day. Constitution Memorial Day is held on May 3rd and established since 1948.
         */
        if ($this->year >= 1948) {
            $this->addHoliday(new Holiday('constitutionMemorialDay',
                ['en_US' => 'Constitution Memorial Day', 'ja_JP' => '憲法記念日'],
                new DateTime("$this->year-5-3", new DateTimeZone($this->timezone)), $this->locale));
        }

        /**
         * Children's Day. Children's Day is held on May 5th and established since 1948.
         */
        if ($this->year >= 1948) {
            $this->addHoliday(new Holiday('childrensDay', ['en_US' => 'Children\'s Day', 'ja_JP' => '子供の日'],
                new DateTime("$this->year-5-5", new DateTimeZone($this->timezone)), $this->locale));
        }

        /**
         * Mountain Day. Mountain Day is held on August 11th and established since 2016.
         */
        if ($this->year >= 2016) {
            $this->addHoliday(new Holiday('mountainDay', ['en_US' => 'Mountain Day', 'ja_JP' => '山の日'],
                new DateTime("$this->year-8-11", new DateTimeZone($this->timezone)), $this->locale));
        }

        /**
         * Culture Day. Culture Day is held on November 11th and established since 1948.
         */
        if ($this->year >= 1948) {
            $this->addHoliday(new Holiday('cultureDay', ['en_US' => 'Culture Day', 'ja_JP' => '文化の日'],
                new DateTime("$this->year-11-3", new DateTimeZone($this->timezone)), $this->locale));
        }

        /**
         * Labor Thanksgiving Day. Labor Thanksgiving Day is held on November 23rd and established since 1948.
         */
        if ($this->year >= 1948) {
            $this->addHoliday(new Holiday('laborThanksgivingDay',
                ['en_US' => 'Labor Thanksgiving Day', 'ja_JP' => '勤労感謝の日'],
                new DateTime("$this->year-11-23", new DateTimeZone($this->timezone)), $this->locale));
        }

        /**
         * Emperors Birthday. The Emperors Birthday is on December 23rd and celebrated as such since 1989.
         * Prior to the death of Emperor Hirohito in 1989, this holiday was celebrated on April 29. See also "Shōwa Day".
         */
        if ($this->year >= 1989) {
            $this->addHoliday(new Holiday('emperorsBirthday', ['en_US' => 'Emperors Birthday', 'ja_JP' => '天皇誕生日'],
                new DateTime("$this->year-12-23", new DateTimeZone($this->timezone)), $this->locale));
        }

        $this->calculateVernalEquinoxDay();
        $this->calculateComingOfAgeDay();
        $this->calculateGreeneryDay();
        $this->calculateMarineDay();
        $this->calculateRespectForTheAgeDay();
        $this->calculateHealthAndSportsDay();
        $this->calculateAutumnalEquinoxDay();
        $this->calculateSubstituteHolidays();
        $this->calculateBridgeHolidays();
    }

    /**
     * Calculate Vernal Equinox Day.
     *
     * This national holiday was established in 1948 as a day for the admiration
     * of nature and the love of living things. Prior to 1948, the vernal equinox was an imperial ancestor worship
     * festival called Shunki kōrei-sai (春季皇霊祭).
     *
     * @link http://www.h3.dion.ne.jp/~sakatsu/holiday_topic.htm (in Japanese)
     *
     * @throws \InvalidArgumentException
     * @throws \Yasumi\Exception\UnknownLocaleException
     */
    private function calculateVernalEquinoxDay()
    {
        $day = null;
        if ($this->year < 1948) {
            $day = null;
        } elseif ($this->year >= 1948 && $this->year <= 1979) {
            $day = floor(self::VERNAL_EQUINOX_PARAM_1979 + self::EQUINOX_GRADIENT * ($this->year - 1980) - floor(($this->year - 1983) / 4));
        } elseif ($this->year <= 2099) {
            $day = floor(self::VERNAL_EQUINOX_PARAM_2099 + self::EQUINOX_GRADIENT * ($this->year - 1980) - floor(($this->year - 1980) / 4));
        } elseif ($this->year <= 2150) {
            $day = floor(self::VERNAL_EQUINOX_PARAM_2150 + self::EQUINOX_GRADIENT * ($this->year - 1980) - floor(($this->year - 1980) / 4));
        } elseif ($this->year > 2150) {
            $day = null;
        }

        if (null !== $day) {
            $this->addHoliday(new Holiday('vernalEquinoxDay', ['en_US' => 'Vernal Equinox Day', 'ja_JP' => '春分の日'],
                new DateTime("$this->year-3-$day", new DateTimeZone($this->timezone)), $this->locale));
        }
    }

    /**
     * Calculate Coming of Age Day.
     *
     * Coming of Age Day was established after 1948 on January 15th. After 2000 it was changed to be the second monday
     * of January.
     *
     * @throws \InvalidArgumentException
     * @throws \Yasumi\Exception\UnknownLocaleException
     */
    private function calculateComingOfAgeDay()
    {
        $date = null;
        if ($this->year >= 2000) {
            $date = new DateTime("second monday of january $this->year", new DateTimeZone($this->timezone));
        } elseif ($this->year >= 1948) {
            $date = new DateTime("$this->year-1-15", new DateTimeZone($this->timezone));
        }
        if (null !== $date) {
            $this->addHoliday(new Holiday('comingOfAgeDay', ['en_US' => 'Coming of Age Day', 'ja_JP' => '成人の日'], $date,
                $this->locale));
        }
    }

    /**
     * Calculates Greenery Day.
     *
     * Greenery Day was established from 1989 on April 29th. After 2007 it was changed to be May 4th.
     *
     * @throws \InvalidArgumentException
     * @throws \Yasumi\Exception\UnknownLocaleException
     */
    private function calculateGreeneryDay()
    {
        $date = null;
        if ($this->year >= 2007) {
            $date = new DateTime("$this->year-5-4", new DateTimeZone($this->timezone));
        } elseif ($this->year >= 1989) {
            $date = new DateTime("$this->year-4-29", new DateTimeZone($this->timezone));
        }
        if (null !== $date) {
            $this->addHoliday(new Holiday('greeneryDay', ['en_US' => 'Greenery Day', 'ja_JP' => '緑の日'], $date,
                $this->locale));
        }
    }

    /**
     * Calculates Marine Day.
     *
     * Marine Day was established since 1996 on July 20th. After 2003 it was changed to be the third monday of July.
     *
     * @throws \InvalidArgumentException
     * @throws \Yasumi\Exception\UnknownLocaleException
     */
    private function calculateMarineDay()
    {
        $date = null;
        if ($this->year >= 2003) {
            $date = new DateTime("third monday of july $this->year", new DateTimeZone($this->timezone));
        } elseif ($this->year >= 1996) {
            $date = new DateTime("$this->year-7-20", new DateTimeZone($this->timezone));
        }
        if (null !== $date) {
            $this->addHoliday(new Holiday('marineDay', ['en_US' => 'Marine Day', 'ja_JP' => '海の日'], $date,
                $this->locale));
        }
    }

    /**
     * Calculates Respect for the Age Day.
     *
     * Respect for the Age Day was established since 1996 on September 15th. After 2003 it was changed to be the third
     * monday of September.
     *
     * @throws \InvalidArgumentException
     * @throws \Yasumi\Exception\UnknownLocaleException
     */
    private function calculateRespectForTheAgeDay()
    {
        $date = null;
        if ($this->year >= 2003) {
            $date = new DateTime("third monday of september $this->year", new DateTimeZone($this->timezone));
        } elseif ($this->year >= 1996) {
            $date = new DateTime("$this->year-9-15", new DateTimeZone($this->timezone));
        }
        if (null !== $date) {
            $this->addHoliday(new Holiday('respectfortheAgedDay',
                ['en_US' => 'Respect for the Aged Day', 'ja_JP' => '敬老の日'], $date, $this->locale));
        }
    }

    /**
     * Calculates Health And Sports Day.
     *
     * Health And Sports Day was established since 1966 on October 10th. After 2000 it was changed to be the second
     * monday of October.
     *
     * @throws \InvalidArgumentException
     * @throws \Yasumi\Exception\UnknownLocaleException
     */
    private function calculateHealthAndSportsDay()
    {
        $date = null;
        if ($this->year >= 2000) {
            $date = new DateTime("second monday of october $this->year", new DateTimeZone($this->timezone));
        } elseif ($this->year >= 1996) {
            $date = new DateTime("$this->year-10-10", new DateTimeZone($this->timezone));
        }
        if (null !== $date) {
            $this->addHoliday(new Holiday('healthandSportsDay', ['en_US' => 'Health And Sports Day', 'ja_JP' => '体育の日'],
                $date, $this->locale));
        }
    }

    /**
     * Calculate Autumnal Equinox Day.
     *
     * This national holiday was established in 1948 as a day on which to honor
     * one's ancestors and remember the dead. Prior to 1948, the autumnal equinox was an imperial ancestor worship
     * festival called Shūki kōrei-sai (秋季皇霊祭).
     *
     * @link http://www.h3.dion.ne.jp/~sakatsu/holiday_topic.htm (in Japanese)
     *
     * @throws \InvalidArgumentException
     * @throws \Yasumi\Exception\UnknownLocaleException
     */
    private function calculateAutumnalEquinoxDay()
    {
        $day = null;
        if ($this->year < 1948) {
            $day = null;
        } elseif ($this->year >= 1948 && $this->year <= 1979) {
            $day = floor(self::AUTUMNAL_EQUINOX_PARAM_1979 + self::EQUINOX_GRADIENT * ($this->year - 1980) - floor(($this->year - 1983) / 4));
        } elseif ($this->year <= 2099) {
            $day = floor(self::AUTUMNAL_EQUINOX_PARAM_2099 + self::EQUINOX_GRADIENT * ($this->year - 1980) - floor(($this->year - 1980) / 4));
        } elseif ($this->year <= 2150) {
            $day = floor(self::AUTUMNAL_EQUINOX_PARAM_2150 + self::EQUINOX_GRADIENT * ($this->year - 1980) - floor(($this->year - 1980) / 4));
        } elseif ($this->year > 2150) {
            $day = null;
        }

        if (null !== $day) {
            $this->addHoliday(new Holiday('autumnalEquinoxDay', ['en_US' => 'Autumnal Equinox Day', 'ja_JP' => '秋分の日'],
                new DateTime("$this->year-9-$day", new DateTimeZone($this->timezone)), $this->locale));
        }
    }

    /**
     * Calculate the substitute holidays.
     *
     * Generally if a national holiday falls on a Sunday, the holiday is observed the next working day (not being
     * another holiday).
     *
     * @throws \InvalidArgumentException
     * @throws \Yasumi\Exception\UnknownLocaleException
     */
    private function calculateSubstituteHolidays()
    {
        // Get initial list of holiday dates
        $dates = $this->getHolidayDates();

        // Loop through all holidays
        foreach ($this->getHolidays() as $shortName => $date) {
            $substituteDay = clone $date;

            // If holidays falls on a Sunday
            if (0 === (int) $date->format('w')) {
                if ($this->year >= 2007) {
                    // Find next week day (not being another holiday)
                    while (in_array($substituteDay, $dates)) {
                        $substituteDay->add(new DateInterval('P1D'));
                        continue;
                    }
                } elseif ($date >= '1973-04-12') {
                    $substituteDay->add(new DateInterval('P1D'));
                    if (in_array($substituteDay, $dates)) {
                        continue; // @codeCoverageIgnore
                    }
                } else {
                    continue;
                }

                // Add a new holiday that is substituting the original holiday
                if (null !== $substituteDay) {
                    $substituteHoliday = new Holiday('substituteHoliday:' . $shortName, [
                        'en_US' => $date->translations['en_US'] . ' Observed',
                        'ja_JP' => '振替休日 (' . $date->translations['ja_JP'] . ')',
                    ], $substituteDay, $this->locale);

                    $this->addHoliday($substituteHoliday);
                }
            }
        }
    }

    /**
     * Calculate public bridge holidays.
     *
     * Any day that falls between two other national holidays also becomes a holiday, known as a bridge holiday.
     *
     * @throws \InvalidArgumentException
     * @throws \Yasumi\Exception\UnknownLocaleException
     */
    private function calculateBridgeHolidays()
    {
        // Get initial list of holidays and iterator
        $datesIterator = $this->getIterator();

        // Loop through all defined holidays
        while ($datesIterator->valid()) {
            $previous = $datesIterator->current();
            $datesIterator->next();

            // Skip if next holiday is not set
            if (null === $datesIterator->current()) {
                continue;
            }

            // Determine if gap between holidays is one day and create bridge holiday
            if (2 === (int) $previous->diff($datesIterator->current())->format('%a')) {
                $bridgeDate = clone $previous;
                $bridgeDate->add(new DateInterval('P1D'));

                $this->addHoliday(new Holiday('bridgeDay', [
                    'en_US' => 'Bridge Public holiday',
                    'ja_JP' => '国民の休日',
                ], $bridgeDate, $this->locale));
            }
        }
    }
}
