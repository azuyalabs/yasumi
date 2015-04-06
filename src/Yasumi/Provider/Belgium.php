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

use DateInterval;
use DateTime;
use DateTimeZone;
use Yasumi\Holiday;

/**
 * Provider for all holidays in Belgium.
 */
class Belgium extends AbstractProvider
{
    /**
     * Initialize holidays for Belgium.
     */
    public function initialize()
    {
        $this->timezone = 'Europe/Brussels';

        /*
         * New Year's Day.
         *
         * New Year's Day is observed on January 1, the first day of the year on the modern Gregorian
         * calendar as well as the Julian calendar.
         */
        $this->addHoliday(new Holiday('newYearsDay', [
            'en_US' => 'New Year\'s Day',
            'nl_NL' => 'Nieuwjaar',
            'nl_BE' => 'Nieuwjaar'
        ], new DateTime("$this->year-1-1", new DateTimeZone($this->timezone)), $this->locale));

        /**
         * Easter.
         *
         * Easter is a festival and holiday celebrating the resurrection of Jesus Christ from the dead. Easter is
         * celebrated on a date based on a certain number of days after March 21st. The date of Easter Day was defined
         * by the Council of Nicaea in AD325 as the Sunday after the first full moon which falls on or after the Spring
         * Equinox.
         */
        $easter = $this->calculateEaster();
        $this->addHoliday(new Holiday('easter', [
            'en_US' => 'Easter Sunday',
            'nl_NL' => 'Eerste Paasdag',
            'nl_BE' => 'Eerste Paasdag'
        ], $easter, $this->locale));

        /**
         * Easter Monday.
         */
        $easterMonday = clone $easter;
        $this->addHoliday(new Holiday('easterMonday', [
            'en_US' => 'Easter Monday',
            'nl_NL' => 'Tweede Paasdag',
            'nl_BE' => 'Paasmaandag'
        ], $easterMonday->add(new DateInterval('P1D')), $this->locale));

        /*
         * Labour Day.
         *
         * Labour Day (Dutch: "Dag van de Arbeid", "Feest van de Arbeid"), is observed on May 1 and is an official
         * holiday.
         */
        $this->addHoliday(new Holiday('labourDay', [
            'en_US' => 'Labour Day',
            'nl_NL' => 'Dag van de arbeid',
            'nl_BE' => 'Dag van de arbeid'
        ], new DateTime("$this->year-5-1", new DateTimeZone($this->timezone)), $this->locale));

        /**
         * Ascension Day.
         *
         * Ascension Day commemorates the bodily Ascension of Jesus into heaven. It is one of the ecumenical feasts of
         * Christian churches. Ascension Day is traditionally celebrated on a Thursday, the fortieth day of Easter
         * although some Catholic provinces have moved the observance to the following Sunday.
         */
        $ascensionDay = clone $easter;
        $this->addHoliday(new Holiday('ascensionDay', [
            'en_US' => 'Ascension Day',
            'nl_NL' => 'Hemelvaart',
            'nl_BE' => 'Hemelvaart'
        ], $ascensionDay->add(new DateInterval('P39D')), $this->locale));

        /**
         * Pentecost (Whitsunday).
         *
         * Pentecost a feast commemorating the descent of the Holy Spirit upon the Apostles and other followers of Jesus
         * Christ. It is celebrated 49 days after Easter and always takes place on Sunday.
         */
        $pentecost = clone $easter;
        $this->addHoliday(new Holiday('pentecost', [
            'en_US' => 'Whitsunday',
            'nl_NL' => 'Eerste Pinksterdag',
            'nl_BE' => 'Eerste Pinksterdag'
        ], $pentecost->add(new DateInterval('P49D')), $this->locale));

        /**
         * Pentecost (Whitmonday).
         */
        $pentecost = clone $easter;
        $this->addHoliday(new Holiday('pentecostMonday', [
            'en_US' => 'Whitmonday',
            'nl_NL' => 'Tweede Pinksterdag',
            'nl_BE' => 'Pinkstermaandag'
        ], $pentecost->add(new DateInterval('P50D')), $this->locale));

        /*
         * Belgian National Day.
         *
         * Belgian National Day is the National Day of Belgium celebrated on 21 July each year.
         */
        $this->addHoliday(new Holiday('nationalDay', [
            'en_US' => 'Belgian National Day',
            'nl_NL' => 'Nationale feestdag',
            'nl_BE' => 'Nationale feestdag'
        ], new DateTime("$this->year-7-21", new DateTimeZone($this->timezone)), $this->locale));

        /**
         * Day of the Assumption of Mary.
         *
         * The Assumption of the Virgin Mary into Heaven, informally known as the Assumption, was the bodily taking up
         * of the Virgin Mary into Heaven at the end of her earthly life. In the churches that observe it, the
         * Assumption is a major feast day, commonly celebrated on August 15.
         */
        $this->addHoliday(new Holiday('assumptionOfMary', [
            'en_US' => 'Assumption of Mary',
            'nl_NL' => 'Onze Lieve Vrouw hemelvaart',
            'nl_BE' => 'Onze Lieve Vrouw hemelvaart'
        ], new DateTime("$this->year-8-15", new DateTimeZone($this->timezone)), $this->locale));

        /**
         * All Saints' Day.
         *
         * All Saints' Day, also known as All Hallows, Solemnity of All Saints, or Feast of All Saints is a solemnity
         * celebrated on 1 November by the Catholic Church and various Protestant denominations in honour of all the saints.
         */
        $this->addHoliday(new Holiday('allSaintsDay', [
            'en_US' => 'All Saints\' Day',
            'nl_NL' => 'Allerheiligen',
            'nl_BE' => 'Allerheiligen'
        ], new DateTime("$this->year-11-1", new DateTimeZone($this->timezone)), $this->locale));

        /**
         * Armistice Day.
         *
         * Armistice Day is commemorated every year on 11 November to mark the armistice signed between the Allies of
         * World War I and Germany at Compiègne, France, for the cessation of hostilities on the Western Front of World
         * War I.
         */
        $this->addHoliday(new Holiday('armisticeDay', [
            'en_US' => 'Armistice Day',
            'nl_NL' => 'Wapenstilstand',
            'nl_BE' => 'Wapenstilstand'
        ], new DateTime("$this->year-11-11", new DateTimeZone($this->timezone)), $this->locale));

        /**
         * Christmas day.
         *
         */
        $this->addHoliday(new Holiday('christmasDay', [
            'en_US' => 'Armistice Day',
            'nl_NL' => 'Wapenstilstand',
            'nl_BE' => 'Wapenstilstand'
        ], new DateTime("$this->year-11-11", new DateTimeZone($this->timezone)), $this->locale));

        /**
         * Christmas day
         */
        $this->addHoliday(new Holiday('christmasDay', [
            'en_US' => 'Christmas',
            'nl_NL' => 'Kerstmis',
            'nl_BE' => 'Kerstmis'
        ], new DateTime("$this->year-12-25", new DateTimeZone($this->timezone)), $this->locale));
    }
}
