<?php

declare(strict_types=1);

/*
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 - 2022 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <me at sachatelgenhof dot com>
 */

namespace Yasumi\Provider;

use DateTime;
use Yasumi\Exception\InvalidDateException;
use Yasumi\Exception\UnknownLocaleException;
use Yasumi\Holiday;

/**
 * Provider for all holidays in Slovakia.
 *
 * Resources:
 *    1/    "Zákon č. 241/1993 Z. z.Zákon Národnej rady Slovenskej republiky o štátnych sviatkoch,
 *        dňoch pracovného pokoja a pamätných dňoch"
 *        [national law]
 *
 *    2/    https://www.zakonypreludi.sk/zz/1993-241
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
 *
 * @see     https://en.wikipedia.org/wiki/Dissolution_of_Czechoslovakia
 *
 * @author  Andrej Rypak (dakujem) <xrypak@gmail.com>
 */
class Slovakia extends AbstractProvider
{
    use CommonHolidays;
    use ChristianHolidays;

    /**
     * Code to identify this Holiday Provider. Typically, this is the ISO3166 code corresponding to the respective
     * country or sub-region.
     */
    public const ID = 'SK';

    /**
     * Initialize holidays for Slovakia.
     *
     * @throws InvalidDateException
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    public function initialize(): void
    {
        $this->timezone = 'Europe/Bratislava';

        // 1.1.
        $this->calculateSlovakIndependenceDay();
        // 6.1.
        $this->addHoliday($this->epiphany($this->year, $this->timezone, $this->locale, Holiday::TYPE_BANK));
        // 1.5.
        $this->addHoliday($this->internationalWorkersDay(
            $this->year,
            $this->timezone,
            $this->locale,
            Holiday::TYPE_BANK
        ));
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

    public function getSources(): array
    {
        return [
            'https://en.wikipedia.org/wiki/Public_holidays_in_Slovakia',
            'https://cs.wikipedia.org/wiki/St%C3%A1tn%C3%AD_sv%C3%A1tky_Slovenska',
        ];
    }

    /**
     * New Year's Day.
     *
     * @see https://en.wikipedia.org/wiki/Public_holidays_in_Slovakia
     *
     * @throws InvalidDateException
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    private function calculateSlovakIndependenceDay(): void
    {
        $this->addHoliday(new Holiday(
            'slovakIndependenceDay',
            [
                'sk' => 'Deň vzniku Slovenskej republiky',
                'en' => 'Day of the Establishment of the Slovak Republic',
            ],
            new DateTime($this->year.'-01-01', DateTimeZoneFactory::getDateTimeZone($this->timezone)),
            $this->locale
        ));
    }

    /**
     * Saints Cyril and Methodius Day.
     *
     * @see https://en.wikipedia.org/wiki/Saints_Cyril_and_Methodius
     *
     * Note: this holiday is common for Czech republic and Slovakia.
     *
     * @throws InvalidDateException
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    private function calculateSaintsCyrilAndMethodiusDay(): void
    {
        $this->addHoliday(new Holiday(
            'saintsCyrilAndMethodiusDay',
            [
                'sk' => 'Sviatok svätého Cyrila a Metoda',
                'cs' => 'Den slovanských věrozvěstů Cyrila a Metoděje',
                'en' => 'Saints Cyril and Methodius Day',
            ],
            new DateTime($this->year.'-07-05', DateTimeZoneFactory::getDateTimeZone($this->timezone)),
            $this->locale,
            Holiday::TYPE_OFFICIAL
        ));
    }

    /**
     * Slovak National Uprising Day.
     *
     * @see https://en.wikipedia.org/wiki/Slovak_National_Uprising
     *
     * @throws InvalidDateException
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    private function calculateSlovakNationalUprisingDay(): void
    {
        $this->addHoliday(new Holiday(
            'slovakNationalUprisingDay',
            [
                'sk' => 'Výročie Slovenského národného povstania',
                'en' => 'Slovak National Uprising Day',
            ],
            new DateTime($this->year.'-08-29', DateTimeZoneFactory::getDateTimeZone($this->timezone)),
            $this->locale,
            Holiday::TYPE_OFFICIAL
        ));
    }

    /**
     * Day of the Constitution of the Slovak Republic.
     *
     * @see https://en.wikipedia.org/wiki/Constitution_of_Slovakia
     *
     * @throws InvalidDateException
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    private function calculateSlovakConstitutionDay(): void
    {
        $this->addHoliday(new Holiday(
            'slovakConstitutionDay',
            [
                'sk' => 'Deň Ústavy Slovenskej republiky',
                'en' => 'Day of the Constitution of the Slovak Republic',
            ],
            new DateTime($this->year.'-09-01', DateTimeZoneFactory::getDateTimeZone($this->timezone)),
            $this->locale,
            Holiday::TYPE_OFFICIAL
        ));
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
     * @throws InvalidDateException
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    private function calculateOurLadyOfSorrowsDay(): void
    {
        $this->addHoliday(new Holiday('ourLadyOfSorrowsDay', [
            'sk' => 'Sviatok Sedembolestnej Panny Márie',
            'en' => 'Our Lady of Sorrows Day',
        ], new DateTime($this->year.'-09-15', DateTimeZoneFactory::getDateTimeZone($this->timezone)), $this->locale, Holiday::TYPE_BANK));
    }

    /**
     * Struggle for Freedom and Democracy Day.
     *
     * Note: this national day is common for Czech republic and Slovakia.
     *
     * @throws InvalidDateException
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    private function calculateStruggleForFreedomAndDemocracyDay(): void
    {
        $this->addHoliday(new Holiday(
            'struggleForFreedomAndDemocracyDay',
            [
                'sk' => 'Deň boja za slobodu a demokraciu',
                'cs' => 'Den boje za svobodu a demokracii',
                'en' => 'Struggle for Freedom and Democracy Day',
            ],
            new DateTime($this->year.'-11-17', DateTimeZoneFactory::getDateTimeZone($this->timezone)),
            $this->locale,
            Holiday::TYPE_OFFICIAL
        ));
    }
}
