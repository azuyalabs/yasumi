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

use DateInterval;
use DateTime;
use Yasumi\Exception\InvalidDateException;
use Yasumi\Exception\UnknownLocaleException;
use Yasumi\Holiday;

/**
 * Provider for all holidays in Argentina.
 */
class Argentina extends AbstractProvider
{
    use CommonHolidays;
    use ChristianHolidays;

    public const PROCLAMATION_OF_INDEPENDENCE_YEAR = 1816;

    /**
     * Code to identify this Holiday Provider. Typically, this is the ISO3166
     * code corresponding to the respective country or sub-region.
     */
    public const ID = 'AR';

    /**
     * Initialize holidays for Argentina.
     *
     * @throws InvalidDateException
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    public function initialize(): void
    {
        $this->timezone = 'America/Argentina/Buenos_Aires';

        // Add common holidays
        $this->addHoliday($this->newYearsDay($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->internationalWorkersDay($this->year, $this->timezone, $this->locale));

        // Add Christian holidays
        $this->addHoliday($this->christmasDay($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->easter($this->year, $this->timezone, $this->locale, Holiday::TYPE_OBSERVANCE));
        $this->addHoliday($this->goodFriday($this->year, $this->timezone, $this->locale, Holiday::TYPE_OBSERVANCE));

        $this->addCarnvalHolidays();
        $this->addRemembranceDay();
        $this->addMalvinasDay();
        $this->addMayRevolution();
        $this->addGeneralMartinMigueldeGuemesDay();
        $this->addFlagDay();
        $this->addGeneralMartinMigueldeGuemesDay();
        $this->addIndependenceDay();
        $this->addGeneralJoseSanMartinDay();
        $this->addRaceDay();
        $this->addNationalSovereigntyDay();
        $this->addImmaculateConceptionDay();
    }

    /**
     * The source of the holidays.
     *
     * @return string[]
     *                  The source URL
     */
    public function getSources(): array
    {
        return [
          'https://en.wikipedia.org/wiki/Public_holidays_in_Argentina',
        ];
    }

    /**
     * Carnaval.
     *
     * Carnaval is the biggest popular festival of country. The festival
     * happens on Day 48 and 47 before Easter.
     *
     * @see https://en.wikipedia.org/wiki/Brazilian_Carnival
     */
    private function addCarnvalHolidays(): void
    {
        if ($this->year >= 1700) {
            $easter = $this->calculateEaster($this->year, $this->timezone);

            $carnavalMonday = clone $easter;
            $carnavalMondayDate = $carnavalMonday->sub(new DateInterval('P48D'));
            if (false !== $carnavalMondayDate) {
                $this->addHoliday(new Holiday(
                  'carnavalMonday',
                  [
                    'en' => 'Carnival Monday',
                    'es' => 'Lunes de Carnaval',
                  ],
                  $carnavalMondayDate,
                  $this->locale,
                  Holiday::TYPE_OBSERVANCE
                ));
            }

            $carnavalTuesday = clone $easter;
            $carnavalTuesdayDate = $carnavalTuesday->sub(new DateInterval('P47D'));
            if (false !== $carnavalTuesdayDate) {
                $this->addHoliday(new Holiday(
                  'carnavalTuesday',
                  [
                    'en' => 'Carnival Tuesday',
                    'es' => 'Martes de Carnaval',
                  ],
                  $carnavalTuesdayDate,
                  $this->locale,
                  Holiday::TYPE_OBSERVANCE
                ));
            }
        }
    }

    /*
     * Day of Remembrance for Truth and Justice.
     *
     * The Day of Remembrance for Truth and Justice (Spanish: Día de la
     * Memoria por la Verdad y la Justicia) is a public holiday in
     * Argentina, commemorating the victims of the Dirty War. It is held on
     * 24 March, the anniversary of the coup d'état of 1976 that brought the
     *  National Reorganization Process to power.
     *
     * @link https://en.wikipedia.org/wiki/Day_of_Remembrance_for_Truth_and_Justice
     */
    private function addRemembranceDay(): void
    {
        if ($this->year >= 2006) {
            $this->addHoliday(new Holiday(
              'remembranceDay',
              [
                'en' => 'Day of Remembrance for Truth and Justice',
                'es' => 'Día Nacional de la Memoria por la Verdad y la Justicia',
              ],
              new DateTime("$this->year-03-24", DateTimeZoneFactory::getDateTimeZone($this->timezone)),
              $this->locale
            ));
        }
    }

    /*
     * Malvinas Day.
     *
     * Malvinas Day (Spanish: Día de las Malvinas), officially Day of the
     * Veterans and Fallen of the Malvinas War (Día del Veterano y de los
     * Caídos en la Guerra de las Malvinas), is a public holiday in
     * Argentina, observed each year on 2 April.[1] The name refers to the
     * Malvinas Islands, known in Spanish as the Islas Malvinas.
     *
     * @link https://en.wikipedia.org/wiki/Malvinas_Day
     */
    private function addMalvinasDay(): void
    {
        if ($this->year >= 1982) {
            $this->addHoliday(new Holiday(
              'malvinasDay',
              [
                'en' => 'Malvinas Day',
                'es' => 'Día del Veterano y de los Caídos en la Guerra de Malvinas',
              ],
              new DateTime("$this->year-04-02", DateTimeZoneFactory::getDateTimeZone($this->timezone)),
              $this->locale
            ));
        }
    }

    /*
     * First National Government.
     *
     * The Anniversary of the First National Government
     * (Spanish: Primer gobierno patrio) is a public holiday of Argentina,
     * commemorating the May Revolution and the creation of the Primera
     * Junta on May 25, 1810, which is considered the first patriotic
     * government of Argentina. Along with the 9 July, which commemorates
     * the Declaration of Independence, it is considered a National Day of
     * Argentina.
     *
     * @link https://en.wikipedia.org/wiki/First_National_Government
     */
    private function addMayRevolution(): void
    {
        if ($this->year >= 1810) {
            $this->addHoliday(new Holiday(
              'mayRevolution',
              [
                'en' => 'May Revolution',
                'es' => 'Día de la Revolución de Mayo',
              ],
              new DateTime("$this->year-05-25", DateTimeZoneFactory::getDateTimeZone($this->timezone)),
              $this->locale
            ));
        }
    }

    /*
     * Anniversary of the Passing of General Martín Miguel de Güemes.
     *
     * Anniversary of the death of Martín Miguel de Güemes, general of the
     * Argentine War of Independence.
     */
    private function addGeneralMartinMigueldeGuemesDay(): void
    {
        if ($this->year >= 1821) {
            $this->addHoliday(new Holiday(
              'generalMartinMigueldeGuemesDay',
              [
                'en' => 'Anniversary of the Passing of General Martín Miguel de Güemes',
                'es' => 'Paso a la Inmortalidad del General Martín Miguel de Güemes',
              ],
              new DateTime("$this->year-06-17", DateTimeZoneFactory::getDateTimeZone($this->timezone)),
              $this->locale
            ));
        }
    }

    /*
     * General Manuel Belgrano Memorial Day.
     *
     * Anniversary of the death of Manuel Belgrano, creator of the Flag of
     * Argentina.
     *
     * @link https://en.wikipedia.org/wiki/Flag_Day_(Argentina)
     */
    private function addFlagDay(): void
    {
        if ($this->year >= 1938) {
            $this->addHoliday(new Holiday(
              'flagDay',
              [
                'en' => 'General Manuel Belgrano Memorial Day',
                'es' => 'Paso a la Inmortalidad del General Manuel Belgrano',
              ],
              new DateTime("$this->year-06-20", DateTimeZoneFactory::getDateTimeZone($this->timezone)),
              $this->locale
            ));
        }
    }

    /*
     * Independence Day.
     *
     * Anniversary of the Declaration of Independence in 1816.
     *
     * @link https://en.wikipedia.org/wiki/Argentine_Declaration_of_Independence
     */
    private function addIndependenceDay(): void
    {
        if ($this->year >= self::PROCLAMATION_OF_INDEPENDENCE_YEAR) {
            $this->addHoliday(new Holiday(
              'independenceDay',
              [
                'en' => 'Independence Day',
                'es' => 'Día de la Independencia',
              ],
              new DateTime("$this->year-07-09", DateTimeZoneFactory::getDateTimeZone($this->timezone)),
              $this->locale
            ));
        }
    }

    /*
     * General José de San Martín Memorial Day.
     *
     * Anniversary of the death of José de San Martín, liberator of
     * Argentina, Chile and Peru.
     */
    private function addGeneralJoseSanMartinDay(): void
    {
        if ($this->year >= 1850) {
            $this->addHoliday(new Holiday(
              'generalJoseSanMartinDay',
              [
                'en' => 'General José de San Martín Memorial Day',
                'es' => 'Paso a la Inmortalidad del General José de San Martín',
              ],
              new DateTime("$this->year-08-17", DateTimeZoneFactory::getDateTimeZone($this->timezone)),
              $this->locale
            ));
        }
    }

    /*
     * Day of Respect for Cultural Diversity.
     *
     * Former "Día de la raza" (English: Race day), anniversary of the
     * arrival of Columbus to the Americas.
     *
     * @link https://en.wikipedia.org/wiki/Columbus_Day
     */
    private function addRaceDay(): void
    {
        if ($this->year >= 1492) {
            $this->addHoliday(new Holiday(
              'raceDay',
              [
                'en' => 'Day of Respect for Cultural Diversity',
                'es' => 'Día del Respeto a la Diversidad Cultural',
              ],
              new DateTime("$this->year-10-12", DateTimeZoneFactory::getDateTimeZone($this->timezone)),
              $this->locale
            ));
        }
    }

    /*
     * National Sovereignty Day.
     *
     * Anniversary of the 1845 Battle of Vuelta de Obligado against the
     * Anglo-French blockade of the Río de la Plata.
     *
     * @link https://en.wikipedia.org/wiki/National_Sovereignty_Day
     */
    private function addNationalSovereigntyDay(): void
    {
        if ($this->year >= 2010) {
            $this->addHoliday(new Holiday(
              'nationalSovereigntyDay',
              [
                'en' => 'National Sovereignty Day',
                'es' => 'Día de la Soberanía Nacional',
              ],
              new DateTime("$this->year-11-20", DateTimeZoneFactory::getDateTimeZone($this->timezone)),
              $this->locale
            ));
        }
    }

    /*
     * Immaculate Conception Day.
     *
     * Christian holiday, conception of the Virgin Mary free from original
     * sin.
     *
     * @link https://en.wikipedia.org/wiki/Immaculate_Conception
     */
    private function addImmaculateConceptionDay(): void
    {
        if ($this->year >= 1900) {
            $this->addHoliday(new Holiday(
              'immaculateConceptionDay',
              [
                'en' => 'Immaculate Conception Day',
                'es' => 'Día de la Inmaculada Concepción de María',
              ],
              new DateTime("$this->year-12-08", DateTimeZoneFactory::getDateTimeZone($this->timezone)),
              $this->locale
            ));
        }
    }
}
