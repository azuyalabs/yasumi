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
 * Provider for all holidays in the Netherlands.
 */
class Netherlands extends AbstractProvider
{
    use CommonHolidays, ChristianHolidays;

    /**
     * Code to identify this Holiday Provider. Typically this is the ISO3166 code corresponding to the respective
     * country or sub-region.
     */
    const ID = 'NL';

    /**
     * Initialize holidays for the Netherlands.
     *
     * @throws \InvalidArgumentException
     * @throws \Yasumi\Exception\UnknownLocaleException
     */
    public function initialize()
    {
        $this->timezone = 'Europe/Amsterdam';

        // Add common holidays
        $this->addHoliday($this->newYearsDay($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->internationalWorkersDay($this->year, $this->timezone, $this->locale,
            Holiday::TYPE_OTHER));
        $this->addHoliday($this->valentinesDay($this->year, $this->timezone, $this->locale, Holiday::TYPE_OTHER));

        // World Animal Day is celebrated since 1931
        if ($this->year >= 1931) {
            $this->addHoliday($this->worldAnimalDay($this->year, $this->timezone, $this->locale, Holiday::TYPE_OTHER));
        }

        $this->addHoliday($this->stMartinsDay($this->year, $this->timezone, $this->locale, Holiday::TYPE_OBSERVANCE));
        $this->addHoliday($this->fathersDay($this->year, $this->timezone, $this->locale, Holiday::TYPE_OTHER));
        $this->addHoliday($this->mothersDay($this->year, $this->timezone, $this->locale, Holiday::TYPE_OTHER));

        // Add Christian holidays
        $this->addHoliday($this->easter($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->easterMonday($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->pentecost($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->pentecostMonday($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->ascensionDay($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->goodFriday($this->year, $this->timezone, $this->locale, Holiday::TYPE_OBSERVANCE));
        $this->addHoliday($this->ashWednesday($this->year, $this->timezone, $this->locale, Holiday::TYPE_OBSERVANCE));
        $this->addHoliday($this->epiphany($this->year, $this->timezone, $this->locale, Holiday::TYPE_OTHER));
        $this->addHoliday($this->christmasDay($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->secondChristmasDay($this->year, $this->timezone, $this->locale));

        /**
         * Commemoration Day and Liberation Day. Instituted after WWII in 1947.
         */
        if ($this->year >= 1947) {
            $this->addHoliday(new Holiday('commemorationDay',
                ['en_US' => 'Commemoration Day', 'nl_NL' => 'Dodenherdenking'],
                new DateTime("$this->year-5-4", new DateTimeZone($this->timezone)), $this->locale,
                Holiday::TYPE_OBSERVANCE));
            $this->addHoliday(new Holiday('liberationDay', ['en_US' => 'Liberation Day', 'nl_NL' => 'Bevrijdingsdag'],
                new DateTime("$this->year-5-5", new DateTimeZone($this->timezone)), $this->locale,
                Holiday::TYPE_OBSERVANCE));
        }

        /**
         * Kings Day.
         *
         * King's Day is celebrated from 2014 onwards on April 27th. If this happens to be on a Sunday, it will be
         * celebrated the day before instead.
         */
        if ($this->year >= 2014) {
            $date = new DateTime("$this->year-4-27", new DateTimeZone($this->timezone));

            if (0 === (int)$date->format('w')) {
                $date->sub(new DateInterval('P1D'));
            }

            $this->addHoliday(new Holiday('kingsDay', ['en_US' => 'Kings Day', 'nl_NL' => 'Koningsdag'], $date,
                $this->locale));
        }

        /**
         * Queen's Day.
         *
         * Queen's Day was celebrated between 1891 and 1948 (inclusive) on August 31. Between 1949 and 2013 (inclusive) it
         * was celebrated April 30. If these dates are on a Sunday, Queen's Day was celebrated one day later until 1980
         * (on the following Monday), starting 1980 one day earlier (on the preceding Saturday).
         */
        if ($this->year >= 1891 && $this->year <= 2013) {
            $date = new DateTime("$this->year-4-30", new DateTimeZone($this->timezone));
            if ($this->year <= 1948) {
                $date = new DateTime("$this->year-8-31", new DateTimeZone($this->timezone));
            }

            // Determine substitution day
            if (0 === (int)$date->format('w')) {
                ($this->year < 1980) ? $date->add(new DateInterval('P1D')) : $date->sub(new DateInterval('P1D'));
            }

            $this->addHoliday(new Holiday('queensDay', ['en_US' => 'Queen\'s Day', 'nl_NL' => 'Koninginnedag'], $date,
                $this->locale));
        }

        /**
         * Prince's Day.
         *
         * Prinsjesdag (English: Prince's Day) is the day on which the reigning monarch of the Netherlands addresses a joint
         * session of the Dutch Senate and House of Representatives.
         */
        $this->addHoliday(new Holiday('princesDay', ['en_US' => 'Prince\'s Day', 'nl_NL' => 'Prinsjesdag'],
            new DateTime("third tuesday of september $this->year", new DateTimeZone($this->timezone)), $this->locale,
            Holiday::TYPE_OTHER));

        /**
         * Halloween
         */
        $this->addHoliday(new Holiday('halloween', ['en_US' => 'Halloween', 'nl_NL' => 'Halloween'],
            new DateTime("$this->year-10-31", new DateTimeZone($this->timezone)), $this->locale,
            Holiday::TYPE_OBSERVANCE));

        /**
         * St. Nicholas' Day
         */
        $this->addHoliday(new Holiday('stNicholasDay', ['en_US' => 'St. Nicholas\' Day', 'nl_NL' => 'Sinterklaas'],
            new DateTime("$this->year-12-5", new DateTimeZone($this->timezone)), $this->locale,
            Holiday::TYPE_OBSERVANCE));

        /**
         * Summertime.
         *
         * Start of Summertime takes place on the last sunday of march. (Summertime is the common name for Daylight Saving
         * Time).
         */
        $this->addHoliday(new Holiday('summerTime', ['en_US' => 'Summertime', 'nl_NL' => 'Zomertijd'],
            new DateTime("last sunday of march $this->year", new DateTimeZone($this->timezone)), $this->locale,
            Holiday::TYPE_SEASON));

        /**
         * Wintertime.
         *
         * Start of Wintertime takes place on the last sunday of october. (Wintertime is actually the end of Summertime.
         * Summertime is the common name for Daylight Saving Time).
         */
        $this->addHoliday(new Holiday('winterTime', ['en_US' => 'Wintertime', 'nl_NL' => 'Wintertijd'],
            new DateTime("last sunday of october $this->year", new DateTimeZone($this->timezone)), $this->locale,
            Holiday::TYPE_SEASON));

        /**
         * Carnival.
         *
         * Carnival (Dutch: Carnaval) is originally an European Pagan spring festival, with an emphasis on role-reversal
         * and suspension of social norms. The feast became assimilated by the Catholic Church and was celebrated in the
         * three days preceding Ash Wednesday and Lent.
         */
        $easter       = $this->calculateEaster($this->year, $this->timezone);
        $carnivalDay1 = clone $easter;
        $this->addHoliday(new Holiday('carnivalDay', ['en_US' => 'Carnival', 'nl_NL' => 'Carnaval'],
            $carnivalDay1->sub(new DateInterval('P49D')), $this->locale, Holiday::TYPE_OBSERVANCE));

        /**
         * Second Day of Carnival.
         */
        $carnivalDay2 = clone $easter;
        $this->addHoliday(new Holiday('secondCarnivalDay', ['en_US' => 'Carnival', 'nl_NL' => 'Carnaval'],
            $carnivalDay2->sub(new DateInterval('P48D')), $this->locale, Holiday::TYPE_OBSERVANCE));

        /**
         * Third Day of Carnival.
         */
        $carnivalDay3 = clone $easter;
        $this->addHoliday(new Holiday('thirdCarnivalDay', ['en_US' => 'Carnival', 'nl_NL' => 'Carnaval'],
            $carnivalDay3->sub(new DateInterval('P47D')), $this->locale, Holiday::TYPE_OBSERVANCE));
    }
}
