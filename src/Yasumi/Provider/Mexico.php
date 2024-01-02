<?php

declare(strict_types=1);

/**
 * Provider for all holidays in Mexico.
 *
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

/**
 * Provider for all holidays in Mexico.
 */
class Mexico extends AbstractProvider
{
    use CommonHolidays;
    use ChristianHolidays;

    public const PROCLAMATION_OF_INDEPENDENCE_YEAR = 1810;

    /**
     * Code to identify this Holiday Provider. Typically, this is the ISO3166 code corresponding to the respective
     * country or sub-region.
     */
    public const ID = 'MX';

    /**
     * Initialize holidays for Mexico.
     *
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    public function initialize(): void
    {
        $this->timezone = 'America/Mexico_City';

        // Add common holidays
        $this->addHoliday($this->newYearsDay($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->internationalWorkersDay($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->christmasDay($this->year, $this->timezone, $this->locale));

        // Add Christian holidays
        $this->addHoliday($this->easterMonday($this->year, $this->timezone, $this->locale, Holiday::TYPE_OBSERVANCE));
        $this->addHoliday($this->epiphany($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->goodFriday($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->easter($this->year, $this->timezone, $this->locale, Holiday::TYPE_OBSERVANCE));
        $this->addHoliday($this->assumptionOfMary($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->allSaintsDay($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->immaculateConception($this->year, $this->timezone, $this->locale));

        // Mexican holidays
        $this->calculateConstitutionDay();
        $this->calculateBenitoJuarezBirthday();
        $this->calculateRevolutionDay();
        $this->calculateDiscoveryOfAmerica();
        $this->addIndependenceDay();
        $this->calculateDayOfTheDead();
        $this->calculateChristmasEve();
        $this->calculateNewYearsEve();
        $this->calculateVirginOfGuadalupe();
    }

    /**
     * The source of the holidays.
     *
     * @return string[] The source URL
     */
    public function getSources(): array
    {
        return [
            'https://en.wikipedia.org/wiki/Public_holidays_in_Mexico',
        ];
    }

    /*
    * Independence Day.
    *
    * Anniversary of the Declaration of Independence in 1810.
    *
    * @link https://en.wikipedia.org/wiki/Mexican_War_of_Independence
    */
    private function addIndependenceDay(): void
    {
        if ($this->year >= 1810) {
            $this->addHoliday(new Holiday(
                'independenceDay',
                [
                    'en' => 'Independence Day',
                    'es' => 'Día de la Independencia',
                ],
                new \DateTime("{$this->year}-09-16", DateTimeZoneFactory::getDateTimeZone($this->timezone)),
                $this->locale
            ));
        }
    }

    /*
    * Constitution Day.
    *
    * Anniversary of the Constitution of 1917, originally February 5, observed on the first Monday of February.
    */
    private function calculateConstitutionDay(): void
    {
        if ($this->year >= 1917) {
            $this->addHoliday(new Holiday(
                'constitutionDay',
                [
                    'en' => 'Constitution Day',
                    'es' => 'Día de la Constitución',
                ],
                new \DateTime("first monday of february {$this->year}", DateTimeZoneFactory::getDateTimeZone($this->timezone)), $this->locale, Holiday::TYPE_OBSERVANCE)
            );
        }
    }

    /*
    * Benito Juárez's birthday.
    *
    * Anniversary of the birth of Benito Juárez on March 21, 1806, observed on the third Monday of March.
    */
    private function calculateBenitoJuarezBirthday(): void
    {
        if ($this->year >= 1806 && $this->year < 2010) {
            $this->addHoliday(new Holiday(
                'benitoJuarezBirthday',
                [
                    'en' => 'Benito Juárez’s birthday',
                    'es' => 'Natalicio de Benito Juárez',
                ],
                new \DateTime("{$this->year}-03-21", DateTimeZoneFactory::getDateTimeZone($this->timezone)), $this->locale, Holiday::TYPE_OBSERVANCE)
            );
        }

        if ($this->year >= 2010) {
            $this->addHoliday(new Holiday(
                'benitoJuarezBirthday',
                [
                    'en' => 'Benito Juárez’s birthday',
                    'es' => 'Natalicio de Benito Juárez',
                ],
                new \DateTime("third monday of march {$this->year}", DateTimeZoneFactory::getDateTimeZone($this->timezone)), $this->locale, Holiday::TYPE_OBSERVANCE)
            );
        }
    }

    /*
    * Revolution Day.
    *
    * Anniversary of the start of the Mexican Revolution on November 20, 1910, observed on the third Monday of November.
    */
    private function calculateRevolutionDay(): void
    {
        if ($this->year >= 1910) {
            $this->addHoliday(new Holiday(
                'revolutionDay',
                [
                    'en' => 'Revolution Day',
                    'es' => 'Día de la Revolución',
                ],
                new \DateTime("third monday of november {$this->year}", DateTimeZoneFactory::getDateTimeZone($this->timezone)), $this->locale, Holiday::TYPE_OBSERVANCE)
            );
        }
    }

    /*
    * Discovery of America.
    *
    * Anniversary of the Discovery of America on October 12, 1492, observed on the second Monday of October.
    */
    private function calculateDiscoveryOfAmerica(): void
    {
        if ($this->year >= 1492) {
            $this->addHoliday(new Holiday(
                'discoveryOfAmerica',
                [
                    'en' => 'Discovery of America',
                    'es' => 'Día de la Raza',
                ],
                new \DateTime("second monday of october {$this->year}", DateTimeZoneFactory::getDateTimeZone($this->timezone)), $this->locale, Holiday::TYPE_OBSERVANCE)
            );
        }
    }

    /*
    * Christmas Eve.
    *
    * Christmas Eve is the day before Christmas Day, which is annually on December 24, according to the Gregorian
    * calendar.
    */
    private function calculateChristmasEve(): void
    {
        $this->addHoliday(new Holiday(
            'christmasEve',
            [
                'en' => 'Christmas Eve',
                'es' => 'Nochebuena',
            ],
            new \DateTime("{$this->year}-12-24", DateTimeZoneFactory::getDateTimeZone($this->timezone)), $this->locale)
        );
    }

    /*
    * New Year's Eve.
    *
    * New Year's Eve is the last day of the year, December 31, in the Gregorian calendar.
    */
    private function calculateNewYearsEve(): void
    {
        $this->addHoliday(new Holiday(
            'newYearsEve',
            [
                'en' => 'New Year’s Eve',
                'es' => 'Nochevieja',
            ],
            new \DateTime("{$this->year}-12-31", DateTimeZoneFactory::getDateTimeZone($this->timezone)), $this->locale)
        );
    }

    /**
     * Day of the Deaths.
     *
     * Day of the Deaths is a Mexican holiday celebrated throughout Mexico, in particular the Central and South regions,
     * and by people of Mexican heritage elsewhere.
     */
    private function calculateDayOfTheDead(): void
    {
        if ($this->year >= 1800) {
            $this->addHoliday(new Holiday(
                'dayOfTheDeaths',
                [
                    'en' => 'Day of the Deaths',
                    'es' => 'Día de los Muertos',
                ],
                new \DateTime("{$this->year}-11-02", DateTimeZoneFactory::getDateTimeZone($this->timezone)), $this->locale, Holiday::TYPE_OTHER)
            );
        }
    }

    /*
     * Virgin of Guadalupe.
     *
     * The Virgin of Guadalupe (Día de la Virgen de Guadalupe) is a celebration of the Virgin Mary,
     * who is the patron saint of Mexico. It is observed on December 12th.
     */
    private function calculateVirginOfGuadalupe(): void
    {
        if ($this->year >= 1531) {
            $this->addHoliday(new Holiday(
                'virginOfGuadalupe',
                ['es' => 'Día de la Virgen de Guadalupe'],
                new \DateTime("{$this->year}-12-12", DateTimeZoneFactory::getDateTimeZone($this->timezone)),
                $this->locale
            ));
        }
    }
}
