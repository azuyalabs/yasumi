<?php
/**
 *  This file is part of the Yasumi package.
 *
 *  Copyright (c) 2015 - 2016 AzuyaLabs
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <stelgenhof@gmail.com>
 */

namespace Yasumi\Provider;

use DateInterval;
use DateTime;
use DateTimeZone;
use Yasumi\Holiday;

/**
 * Provider for all holidays in Greece.
 */
class Greece extends AbstractProvider
{
    use CommonHolidays, ChristianHolidays;

    /**
     * Code to identify this Holiday Provider. Typically this is the ISO3166 code corresponding to the respective
     * country or sub-region.
     */
    const ID = 'GR';

    /**
     * Initialize holidays for Greece.
     */
    public function initialize()
    {
        $this->timezone = 'Europe/Athens';

        // Add common holidays
        $this->addHoliday($this->newYearsDay($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->internationalWorkersDay($this->year, $this->timezone, $this->locale));

        // Add Christian holidays
        $this->addHoliday($this->epiphany($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->annunciation($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->goodFriday($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->easter($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->easterMonday($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->ascensionDay($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->pentecost($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->pentecostMonday($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->assumptionOfMary($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->christmasDay($this->year, $this->timezone, $this->locale));

        // Calculate other holidays
        $this->calculateThreeHolyHierarchs();
        $this->calculateCleanMonday();
        $this->calculateIndependenceDay();
        $this->calculateOhiDay();
        $this->calculatePolytechnio();
    }

    /**
     * The Three Holy Hierarchs.
     *
     * Commemoration of the patron saints of education (St. Basil the Great, St. Gregory the Theologian, St. John
     * Chrysostom).
     *
     * @see https://en.wikipedia.org/wiki/Three_Holy_Hierarchs
     */
    public function calculateThreeHolyHierarchs()
    {
        $this->addHoliday(new Holiday('threeHolyHierarchs', ['el_GR' => 'Τριών Ιεραρχών'],
            new DateTime("$this->year-1-30", new DateTimeZone($this->timezone)), $this->locale, Holiday::TYPE_OTHER));
    }

    /**
     * Clean Monday.
     *
     * Also known as Pure Monday, Ash Monday, Monday of Lent or Green Monday,
     * it is the first day of Great Lent in the Eastern Orthodox Christian.
     * It is a movable feast that occurs at the beginning of the 7th week before Orthodox Easter Sunday.
     *
     * @see https://en.wikipedia.org/wiki/Clean_Monday
     */
    public function calculateCleanMonday()
    {
        $this->addHoliday(new Holiday('cleanMonday', ['el_GR' => 'Καθαρά Δευτέρα'],
            $this->calculateEaster($this->year, $this->timezone)->sub(new DateInterval('P48D')), $this->locale));
    }

    /**
     * Calculate the Easter date for Orthodox churches.
     *
     * @param int    $year     the year for which Easter needs to be calculated
     * @param string $timezone the timezone in which Easter is celebrated
     *
     * @return \Datetime date of Orthodox Easter
     *
     * @link http://php.net/manual/en/function.easter-date.php#83794
     * @link https://en.wikipedia.org/wiki/Computus#Adaptation_for_Western_Easter_of_Meeus.27_Julian_algorithm
     */
    public function calculateEaster($year, $timezone)
    {
        $a     = $year % 4;
        $b     = $year % 7;
        $c     = $year % 19;
        $d     = (19 * $c + 15) % 30;
        $e     = (2 * $a + 4 * $b - $d + 34) % 7;
        $month = floor(($d + $e + 114) / 31);
        $day   = (($d + $e + 114) % 31) + 1;

        return (new DateTime("$year-$month-$day", new DateTimeZone($timezone)))->add(new DateInterval('P13D'));
    }

    /*
     * Independence Day.
     *
     * Anniversary of the declaration of the start of Greek War of Independence from the Ottoman Empire, in 1821.
     *
     * @link https://en.wikipedia.org/wiki/Greek_War_of_Independence
     */

    public function calculateIndependenceDay()
    {
        if ($this->year >= 1821) {
            $this->addHoliday(new Holiday('independenceDay', ['el_GR' => 'Εικοστή Πέμπτη Μαρτίου'],
                new DateTime("$this->year-3-25", new DateTimeZone($this->timezone)), $this->locale));
        }
    }

    /*
     * Ohi Day.
     *
     * Celebration of the Greek refusal to the Italian ultimatum of 1940.
     *
     * @link https://en.wikipedia.org/wiki/Ohi_Day
     */
    public function calculateOhiDay()
    {
        if ($this->year >= 1940) {
            $this->addHoliday(new Holiday('ohiDay', ['el_GR' => 'Επέτειος του Όχι'],
                new DateTime("$this->year-10-28", new DateTimeZone($this->timezone)), $this->locale));
        }
    }

    /*
     * Polytechnio.
     *
     * Anniversary of the 1973 students protests against the junta of the colonels (1967–1974).
     *
     * @link https://en.wikipedia.org/wiki/Athens_Polytechnic_uprising
     */
    public function calculatePolytechnio()
    {
        if ($this->year >= 1973) {
            $this->addHoliday(new Holiday('polytechnio', ['el_GR' => 'Πολυτεχνείο'],
                new DateTime("$this->year-11-17", new DateTimeZone($this->timezone)), $this->locale,
                Holiday::TYPE_OTHER));
        }
    }
}
