<?php
/*
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Yasumi\Provider;

use Carbon\Carbon;
use Yasumi\Holiday;

/**
 * Provider for all holidays in the Netherlands.
 */
class Netherlands extends AbstractProvider
{
    /**
     * Initialize holidays for the Netherlands.
     */
    public function initialize()
    {
        $this->timezone = 'Europe/Amsterdam';

        /*
         * New Year's Day
         */
        $this->addHoliday(new Holiday('newYearsDay', ['en-US' => 'New Year\'s Day', 'nl-NL' => 'Nieuwjaar'],
            Carbon::create($this->year, 1, 1, 0, 0, 0, $this->timezone), $this->locale));

        /*
         * Epiphany
         */
        $this->addHoliday(new Holiday('epiphany', ['en-US' => 'Epiphany', 'nl-NL' => 'Drie Koningen'],
            Carbon::create($this->year, 1, 6, 0, 0, 0, $this->timezone), $this->locale, Holiday::TYPE_OTHER));

        /*
         * Valentine's Day
         */
        $this->addHoliday(new Holiday('valentinesDay', ['en-US' => 'Valentine\'s Day', 'nl-NL' => 'Valentijnsdag'],
            Carbon::create($this->year, 2, 14, 0, 0, 0, $this->timezone), $this->locale, Holiday::TYPE_OTHER));

        /*
         * Labour Day
         */
        $this->addHoliday(new Holiday('labourDay', ['en-US' => 'Labour Day', 'nl-NL' => 'Dag van de Arbeid'],
            Carbon::create($this->year, 5, 1, 0, 0, 0, $this->timezone), $this->locale, Holiday::TYPE_OTHER));

        /*
         * Commemoration Day and Liberation Day. Instituted after WWII in 1947.
         */
        if ($this->year >= 1947) {
            $this->addHoliday(new Holiday('commemorationDay',
                ['en-US' => 'Commemoration Day', 'nl-NL' => 'Dodenherdenking'],
                Carbon::create($this->year, 5, 4, 0, 0, 0, $this->timezone), $this->locale, Holiday::TYPE_OBSERVANCE));
            $this->addHoliday(new Holiday('liberationDay', ['en-US' => 'Liberation Day', 'nl-NL' => 'Bevrijdingsdag'],
                Carbon::create($this->year, 5, 5, 0, 0, 0, $this->timezone), $this->locale, Holiday::TYPE_OBSERVANCE));
        }

        /*
         * World Animal Day
         */
        $this->addHoliday(new Holiday('worldAnimalDay', ['en-US' => 'World Animal Day', 'nl-NL' => 'Dierendag'],
            Carbon::create($this->year, 10, 4, 0, 0, 0, $this->timezone), $this->locale, Holiday::TYPE_OTHER));

        /*
         * Halloween
         */
        $this->addHoliday(new Holiday('halloween', ['en-US' => 'Halloween', 'nl-NL' => 'Halloween'],
            Carbon::create($this->year, 10, 31, 0, 0, 0, $this->timezone), $this->locale, Holiday::TYPE_OBSERVANCE));

        /**
         * St. Martins Day
         */
        $this->addHoliday(new Holiday('stMartinsDay', ['en-US' => 'St. Martin\'s Day', 'nl-NL' => 'Sint Maarten'],
            Carbon::create($this->year, 11, 11, 0, 0, 0, $this->timezone), $this->locale, Holiday::TYPE_OBSERVANCE));

        /**
         * St. Nicholas' Day
         */
        $this->addHoliday(new Holiday('stNicholasDay', ['en-US' => 'St. Nicholas\' Day', 'nl-NL' => 'Sinterklaas'],
            Carbon::create($this->year, 12, 5, 0, 0, 0, $this->timezone), $this->locale, Holiday::TYPE_OBSERVANCE));

        /**
         * Christmas day
         */
        $this->addHoliday(new Holiday('christmasDay', ['en-US' => 'Christmas', 'nl-NL' => 'Eerste Kerstdag'],
            Carbon::create($this->year, 12, 25, 0, 0, 0, $this->timezone), $this->locale));

        /**
         * Second Christmas Day / Boxing Day
         */
        $this->addHoliday(new Holiday('secondChristmasDay', ['en-US' => 'Boxing Day', 'nl-NL' => 'Tweede Kerstdag'],
            Carbon::create($this->year, 12, 26, 0, 0, 0, $this->timezone), $this->locale));

        /**
         * Kings Day.
         *
         * King's Day is celebrated from 2014 onwards on April 27th. If this happens to be on a Sunday, it will be
         * celebrated the day before instead.
         */
        if ($this->year >= 2014) {
            $date = Carbon::create($this->year, 4, 27, 0, 0, 0, $this->timezone);

            if ($date->dayOfWeek === 0) {
                $date = $date->subDay();
            }

            $this->addHoliday(new Holiday('kingsDay', ['en-US' => 'Kings Day', 'nl-NL' => 'Koningsdag'], $date,
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
            $date = Carbon::create($this->year, 4, 30, 0, 0, 0, $this->timezone);
            if ($this->year <= 1948) {
                $date = Carbon::create($this->year, 8, 31, 0, 0, 0, $this->timezone);
            }

            // Determine substitution day
            if ($date->dayOfWeek === 0) {
                $date = ($this->year < 1980) ? $date->addDay() : $date->subDay();
            }

            $this->addHoliday(new Holiday('queensDay', ['en-US' => 'Queen\'s Day', 'nl-NL' => 'Koninginnedag'], $date,
                $this->locale));
        }

        /**
         * Summertime.
         *
         * Start of Summertime takes place on the last sunday of march. (Summertime is the common name for Daylight Saving
         * Time).
         */
        $this->addHoliday(new Holiday('summerTime', ['en-US' => 'Summertime', 'nl-NL' => 'Zomertijd'],
            new Carbon('last sunday of march ' . $this->year, $this->timezone), $this->locale, Holiday::TYPE_SEASON));

        /**
         * Wintertime.
         *
         * Start of Wintertime takes place on the last sunday of october. (Wintertime is actually the end of Summertime.
         * Summertime is the common name for Daylight Saving Time).
         */
        $this->addHoliday(new Holiday('winterTime', ['en-US' => 'Wintertime', 'nl-NL' => 'Wintertijd'],
            new Carbon('last sunday of october ' . $this->year, $this->timezone), $this->locale, Holiday::TYPE_SEASON));

        /**
         * Prince's Day.
         *
         * Prinsjesdag (English: Prince's Day) is the day on which the reigning monarch of the Netherlands addresses a joint
         * session of the Dutch Senate and House of Representatives.
         */
        $this->addHoliday(new Holiday('princesDay', ['en-US' => 'Prince\'s Day', 'nl-NL' => 'Prinsjesdag'],
            new Carbon('third tuesday of september ' . $this->year, $this->timezone), $this->locale,
            Holiday::TYPE_OTHER));

        /**
         * Father's Day.
         *
         * Father's Day is a celebration honoring fathers and celebrating fatherhood, paternal bonds, and the influence of
         * fathers in society. In the Netherlands, Father's Day (Dutch: Vaderdag) is celebrated on the third Sunday of June and
         * is not a public holiday.
         */
        $this->addHoliday(new Holiday('fathersDay', ['en-US' => 'Father\'s Day', 'nl-NL' => 'Vaderdag'],
            new Carbon('third sunday of june ' . $this->year, $this->timezone), $this->locale, Holiday::TYPE_OTHER));

        /**
         * Mother's Day.
         *
         * Mother's Day is a modern celebration honoring one's own mother, as well as motherhood, maternal bonds, and the
         * influence of mothers in society. In the Netherlands, Mother's Day (Dutch: Moederdag) is celebrated on the second
         * Sunday of May and is not a public holiday.
         */
        $this->addHoliday(new Holiday('mothersDay', ['en-US' => 'Mother\'s Day', 'nl-NL' => 'Moederdag'],
            new Carbon('second sunday of may ' . $this->year, $this->timezone), $this->locale, Holiday::TYPE_OTHER));

        /**
         * Easter.
         *
         * Easter is a festival and holiday celebrating the resurrection of Jesus Christ from the dead. Easter is celebrated on
         * a date based on a certain number of days after March 21st. The date of Easter Day was defined by the Council of
         * Nicaea in AD325 as the Sunday after the first full moon which falls on or after the Spring Equinox.
         */
        $easter = Carbon::create($this->year, 3, 21, 0, 0, 0, $this->timezone)->addDays(easter_days($this->year));
        $this->addHoliday(new Holiday('easter', ['en-US' => 'Easter Sunday', 'nl-NL' => 'Eerste Paasdag'], $easter,
            $this->locale));

        /**
         * Easter Monday.
         */
        $easterMonday = clone $easter;
        $this->addHoliday(new Holiday('easterMonday', ['en-US' => 'Easter Monday', 'nl-NL' => 'Tweede Paasdag'],
            $easterMonday->addDay(), $this->locale));

        /**
         * Pentecost (Whitsunday).
         *
         * Pentecost a feast commemorating the descent of the Holy Spirit upon the Apostles and other followers of Jesus Christ.
         * It is celebrated 49 days after Easter and always takes place on Sunday.
         */
        $pentecost = clone $easter;
        $this->addHoliday(new Holiday('pentecost', ['en-US' => 'Whitsunday', 'nl-NL' => 'Eerste Pinksterdag'],
            $pentecost->addDays(49), $this->locale));

        /**
         * Pentecost (Whitmonday).
         */
        $pentecost = clone $easter;
        $this->addHoliday(new Holiday('pentecostMonday', ['en-US' => 'Whitmonday', 'nl-NL' => 'Tweede Pinksterdag'],
            $pentecost->addDays(50), $this->locale));

        /**
         * Carnival.
         *
         * Carnival (Dutch: Carnaval) is originally an European Pagan spring festival, with an emphasis on role-reversal and
         * suspension of social norms. The feast became assimilated by the Catholic Church and was celebrated in the three days
         * preceding Ash Wednesday and Lent.
         */
        $carnivalDay1 = clone $easter;
        $this->addHoliday(new Holiday('carnivalDay', ['en-US' => 'Carnival', 'nl-NL' => 'Carnaval'],
            $carnivalDay1->subDays(49), $this->locale, Holiday::TYPE_OBSERVANCE));

        /**
         * Second Day of Carnival.
         */
        $carnivalDay2 = clone $easter;
        $this->addHoliday(new Holiday('secondCarnivalDay', ['en-US' => 'Carnival', 'nl-NL' => 'Carnaval'],
            $carnivalDay2->subDays(48), $this->locale, Holiday::TYPE_OBSERVANCE));

        /**
         * Third Day of Carnival.
         */
        $carnivalDay3 = clone $easter;
        $this->addHoliday(new Holiday('thirdCarnivalDay', ['en-US' => 'Carnival', 'nl-NL' => 'Carnaval'],
            $carnivalDay3->subDays(47), $this->locale, Holiday::TYPE_OBSERVANCE));

        /**
         * Ash Wednesday.
         *
         * Ash Wednesday, a day of fasting, is the first day of Lent in Western Christianity. It occurs 46 days (40 fasting
         * days, if the 6 Sundays, which are not days of fast, are excluded) before Easter and can fall as early as 4 February
         * or as late as 10 March.
         */
        $ashWednesday = clone $easter;
        $this->addHoliday(new Holiday('ashWednesday', ['en-US' => 'Ash Wednesday', 'nl-NL' => 'Aswoensdag'],
            $ashWednesday->subDays(46), $this->locale, Holiday::TYPE_OBSERVANCE));

        /**
         * Good Friday.
         *
         * Good Friday is a Christian religious holiday commemorating the crucifixion of Jesus Christ and his death at Calvary.
         * The holiday is observed during Holy Week as part of the Paschal Triduum on the Friday preceding Easter Sunday, and
         * may coincide with the Jewish observance of Passover.
         */
        $goodFriday = clone $easter;
        $this->addHoliday(new Holiday('goodFriday', ['en-US' => 'Good Friday', 'nl-NL' => 'Goede Vrijdag'],
            $goodFriday->subDays(2), $this->locale, Holiday::TYPE_OBSERVANCE));

        /**
         * Ascension Day.
         *
         * Ascension Day commemorates the bodily Ascension of Jesus into heaven. It is one of the ecumenical feasts of Christian
         * churches. Ascension Day is traditionally celebrated on a Thursday, the fortieth day of Easter although some Catholic
         * provinces have moved the observance to the following Sunday.
         */
        $ascensionDay = clone $easter;
        $this->addHoliday(new Holiday('ascensionDay', ['en-US' => 'Ascension Day', 'nl-NL' => 'Hemelvaart'],
            $ascensionDay->addDays(39), $this->locale));
    }
}
