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

use DateTime;
use DateTimeZone;
use Yasumi\Holiday;

/**
 * Provider for all holidays in Slovakia.
 *
 * Resources:
 *    1/    "Zákon č. 241/1993 Z. z.Zákon Národnej rady Slovenskej republiky o štátnych sviatkoch,
 *        dňoch pracovného pokoja a pamätných dňoch"
 *        [national law]
 *
 *    2/    http://www.zakonypreludi.sk/zz/1993-241
 *
 *
 * English:
 *        https://en.wikipedia.org/wiki/Public_holidays_in_Slovakia
 *        [short version, not accurate with national/bank holiday type]
 *
 * Note: there are only 5 national holidays celebrated in Slovakia: 1. January, 5. July, 29. August, 1. September, 17.
 * November.
 *
 * Note: All bank holidays and national days in Slovakia are based on historic events or Catolic church feasts.
 *
 * Note: Slovak holidays are valid since 1993-01-01, the day od dissolution of Czechoslovakia into Czech republic and
 * Slovakia.
 * @see     https://en.wikipedia.org/wiki/Dissolution_of_Czechoslovakia
 *
 *
 * @package Yasumi\Provider
 * @author  Andrej Rypak (dakujem) <xrypak@gmail.com>
 */
class Slovakia extends AbstractProvider
{
    use CommonHolidays, ChristianHolidays;

    /**
     * Code to identify this Holiday Provider. Typically this is the ISO3166 code corresponding to the respective
     * country or sub-region.
     */
    const ID = 'SK';

    /**
     * Initialize holidays for Slovakia.
     *
     * @throws \InvalidArgumentException
     * @throws \Yasumi\Exception\UnknownLocaleException
     */
    public function initialize()
    {
        $this->timezone = 'Europe/Bratislava';

        // 1.1.
        $this->addHoliday($this->newYearsDay($this->year, $this->timezone, $this->locale, Holiday::TYPE_NATIONAL));
        // 6.1.
        $this->addHoliday($this->epiphany($this->year, $this->timezone, $this->locale, Holiday::TYPE_BANK));
        // 1.5.
        $this->addHoliday($this->internationalWorkersDay($this->year, $this->timezone, $this->locale,
            Holiday::TYPE_BANK));
        // 8.5.
        $this->addHoliday($this->victoryInEuropeDay($this->year, $this->timezone, $this->locale, Holiday::TYPE_BANK));
        // 5.7.
        $this->calculateSaintsCyrilAndMethodiusDay();
        // 29.8.
        $this->calculateSlovakNationalUprisingDay();
        // 1.9.
        $this->calculateSlovakConstitutionDay();
        // 15.9.
        $this->calculateOurLadyOfSorrowsDay();
        // 1.11.
        $this->addHoliday($this->allSaintsDay($this->year, $this->timezone, $this->locale, Holiday::TYPE_BANK));
        // 17.11.
        $this->calculateStruggleForFreedomAndDemocracyDay();
        // 24.12.
        $this->addHoliday($this->christmasEve($this->year, $this->timezone, $this->locale, Holiday::TYPE_BANK));
        // 25.12.
        $this->addHoliday($this->christmasDay($this->year, $this->timezone, $this->locale, Holiday::TYPE_BANK));
        // 26.12.
        $this->addHoliday($this->secondChristmasDay($this->year, $this->timezone, $this->locale, Holiday::TYPE_BANK));

        // variable holidays - easter
        $this->addHoliday($this->goodFriday($this->year, $this->timezone, $this->locale, Holiday::TYPE_BANK));
        $this->addHoliday($this->easterMonday($this->year, $this->timezone, $this->locale, Holiday::TYPE_BANK));
    }

    /**
     * Saints Cyril and Methodius Day
     *
     * @see https://en.wikipedia.org/wiki/Saints_Cyril_and_Methodius
     *
     * Note: this holiday is common for Czech republic and Slovakia.
     *
     * @throws \InvalidArgumentException
     * @throws \Yasumi\Exception\UnknownLocaleException
     */
    public function calculateSaintsCyrilAndMethodiusDay()
    {
        $this->addHoliday(new Holiday('saintsCyrilAndMethodiusDay', [
            'sk_SK' => 'Sviatok svätého Cyrila a Metoda',
            'cs_CZ' => 'Den slovanských věrozvěstů Cyrila a Metoděje',
            'en_US' => 'Saints Cyril and Methodius Day',
        ], new DateTime($this->year . '-07-05', new DateTimeZone($this->timezone)), $this->locale,
            Holiday::TYPE_NATIONAL));
    }

    /**
     * Slovak National Uprising Day
     *
     * @see https://en.wikipedia.org/wiki/Slovak_National_Uprising
     *
     * @throws \InvalidArgumentException
     * @throws \Yasumi\Exception\UnknownLocaleException
     */
    public function calculateSlovakNationalUprisingDay()
    {
        $this->addHoliday(new Holiday('slovakNationalUprisingDay', [
            'sk_SK' => 'Výročie Slovenského národného povstania',
            'en_US' => 'Slovak National Uprising Day',
        ], new DateTime($this->year . '-08-29', new DateTimeZone($this->timezone)), $this->locale,
            Holiday::TYPE_NATIONAL));
    }

    /**
     * Day of the Constitution of the Slovak Republic
     *
     * @see https://en.wikipedia.org/wiki/Constitution_of_Slovakia
     *
     * @throws \InvalidArgumentException
     * @throws \Yasumi\Exception\UnknownLocaleException
     */
    public function calculateSlovakConstitutionDay()
    {
        $this->addHoliday(new Holiday('slovakConstitutionDay', [
            'sk_SK' => 'Deň Ústavy Slovenskej republiky',
            'en_US' => 'Day of the Constitution of the Slovak Republic',
        ], new DateTime($this->year . '-09-01', new DateTimeZone($this->timezone)), $this->locale,
            Holiday::TYPE_NATIONAL));
    }

    /**
     * Our Lady of Sorrows ("Sedembolestná Panna Mária"),
     * is the main patron of slovakia, announced by pope Pius IX. in 1927.
     *
     * Note: This is a Christian church holiday.
     *
     * @see https://en.wikipedia.org/wiki/Our_Lady_of_Sorrows
     * @see https://sk.wikipedia.org/wiki/Sedembolestn%C3%A1_Panna_M%C3%A1ria
     *
     * @throws \InvalidArgumentException
     * @throws \Yasumi\Exception\UnknownLocaleException
     */
    public function calculateOurLadyOfSorrowsDay()
    {
        $this->addHoliday(new Holiday('ourLadyOfSorrowsDay', [
            'sk_SK' => 'Sviatok Sedembolestnej Panny Márie',
            'en_US' => 'Our Lady of Sorrows Day',
        ], new DateTime($this->year . '-09-15', new DateTimeZone($this->timezone)), $this->locale, Holiday::TYPE_BANK));
    }

    /**
     * Struggle for Freedom and Democracy Day
     *
     * Note: this national day is common for Czech republic and Slovakia.
     *
     * @throws \InvalidArgumentException
     * @throws \Yasumi\Exception\UnknownLocaleException
     */
    public function calculateStruggleForFreedomAndDemocracyDay()
    {
        $this->addHoliday(new Holiday('struggleForFreedomAndDemocracyDay', [
            'sk_SK' => 'Deň boja za slobodu a demokraciu',
            'cs_CZ' => 'Den boje za svobodu a demokracii',
            'en_US' => 'Struggle for Freedom and Democracy Day',
        ], new DateTime($this->year . '-11-17', new DateTimeZone($this->timezone)), $this->locale,
            Holiday::TYPE_NATIONAL));
    }
}
