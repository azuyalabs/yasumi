<?php

declare(strict_types = 1);

/**
 * This file is part of the 'Yasumi' package.
 *
 * The easy PHP Library for calculating holidays.
 *
 * Copyright (c) 2015 - 2026 AzuyaLabs
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
 * Provider for all holidays in Venezuela.
 *
 * @see https://en.wikipedia.org/wiki/Public_holidays_in_Venezuela
 */
class Venezuela extends AbstractProvider
{
    use CommonHolidays;
    use ChristianHolidays;

    /**
     * The year when Venezuela declared independence from Spain.
     */
    public const DECLARATION_OF_INDEPENDENCE_YEAR = 1811;

    /**
     * Code to identify this Holiday Provider. Typically, this is the ISO3166 code corresponding to the respective
     * country or sub-region.
     */
    public const ID = 'VE';

    /**
     * Initialize holidays for Venezuela.
     *
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    public function initialize(): void
    {
        $this->timezone = 'America/Caracas';

        // Add common holidays
        $this->addHoliday($this->newYearsDay($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->internationalWorkersDay($this->year, $this->timezone, $this->locale));

        // Add Christian holidays
        $this->addHoliday($this->christmasDay($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->maundyThursday($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->goodFriday($this->year, $this->timezone, $this->locale));

        // Calculate country-specific holidays
        $this->calculateCarnaval();
        $this->calculateDeclarationOfIndependence();
        $this->calculateBattleOfCarabobo();
        $this->calculateIndependenceDay();
        $this->calculateSimonBolivarBirthday();
        $this->calculateDayOfIndigenousResistance();
        $this->calculateChristmasEve();
        $this->calculateNewYearsEve();
    }

    /**
     * Returns a list of sources for holiday calculations.
     *
     * @return string[] The source URLs
     */
    public function getSources(): array
    {
        return [
            'https://en.wikipedia.org/wiki/Public_holidays_in_Venezuela',
            'https://www.timeanddate.com/holidays/venezuela/',
            'https://www.officeholidays.com/countries/venezuela',
        ];
    }

    /**
     * Carnaval (Carnival).
     *
     * Carnival is celebrated on Monday and Tuesday before Ash Wednesday.
     * It is one of the most important celebrations in Venezuela.
     *
     * @throws \Exception
     */
    protected function calculateCarnaval(): void
    {
        if ($this->year >= 1700) {
            $easter = $this->calculateEaster($this->year, $this->timezone);

            $days = [
                'carnavalMonday' => [
                    'interval' => 'P48D',
                    'name_es' => 'Lunes de Carnaval',
                    'name_en' => 'Carnival Monday',
                ],
                'carnavalTuesday' => [
                    'interval' => 'P47D',
                    'name_es' => 'Martes de Carnaval',
                    'name_en' => 'Carnival Tuesday',
                ],
            ];

            foreach ($days as $name => $day) {
                $date = (clone $easter)->sub(new \DateInterval($day['interval']));

                if (! $date instanceof \DateTime) {
                    throw new \RuntimeException(sprintf('unable to perform a date subtraction for %s:%s', self::class, $name));
                }

                $this->addHoliday(new Holiday(
                    $name,
                    [
                        'es' => $day['name_es'],
                        'en' => $day['name_en'],
                    ],
                    $date,
                    $this->locale
                ));
            }
        }
    }

    /**
     * Declaration of Independence.
     *
     * On April 19, 1810, Venezuela began its independence movement by establishing a junta
     * that deposed the Spanish colonial authorities. This date marks the beginning of
     * Venezuelan independence.
     *
     * @see https://en.wikipedia.org/wiki/Venezuelan_Declaration_of_Independence
     */
    protected function calculateDeclarationOfIndependence(): void
    {
        if ($this->year >= 1810) {
            $this->addHoliday(new Holiday(
                'declarationOfIndependence',
                [
                    'es' => 'Declaración de la Independencia',
                    'en' => 'Declaration of Independence',
                ],
                new \DateTime("{$this->year}-04-19", DateTimeZoneFactory::getDateTimeZone($this->timezone)),
                $this->locale
            ));
        }
    }

    /**
     * Battle of Carabobo.
     *
     * The Battle of Carabobo was fought on June 24, 1821. It was the decisive battle
     * in the Venezuelan War of Independence that established the independence of Venezuela.
     *
     * @see https://en.wikipedia.org/wiki/Battle_of_Carabobo
     */
    protected function calculateBattleOfCarabobo(): void
    {
        if ($this->year >= 1821) {
            $this->addHoliday(new Holiday(
                'battleOfCarabobo',
                [
                    'es' => 'Batalla de Carabobo',
                    'en' => 'Battle of Carabobo',
                ],
                new \DateTime("{$this->year}-06-24", DateTimeZoneFactory::getDateTimeZone($this->timezone)),
                $this->locale
            ));
        }
    }

    /**
     * Independence Day.
     *
     * Venezuelan Independence Day is celebrated on July 5th, marking the day when
     * the Congress of Venezuela declared independence from Spain in 1811.
     *
     * @see https://en.wikipedia.org/wiki/Venezuelan_Independence
     */
    protected function calculateIndependenceDay(): void
    {
        if ($this->year >= self::DECLARATION_OF_INDEPENDENCE_YEAR) {
            $this->addHoliday(new Holiday(
                'independenceDay',
                [
                    'es' => 'Día de la Independencia',
                    'en' => 'Independence Day',
                ],
                new \DateTime("{$this->year}-07-05", DateTimeZoneFactory::getDateTimeZone($this->timezone)),
                $this->locale
            ));
        }
    }

    /**
     * Simon Bolivar's Birthday.
     *
     * Simon Bolivar was born on July 24, 1783 in Caracas. He is considered the
     * liberator of Venezuela, Colombia, Ecuador, Peru, and Bolivia.
     *
     * @see https://en.wikipedia.org/wiki/Simon_Bolivar
     */
    protected function calculateSimonBolivarBirthday(): void
    {
        if ($this->year >= 1783) {
            $this->addHoliday(new Holiday(
                'simonBolivarBirthday',
                [
                    'es' => 'Natalicio del Libertador',
                    'en' => "Simon Bolivar\u{2019}s Birthday",
                ],
                new \DateTime("{$this->year}-07-24", DateTimeZoneFactory::getDateTimeZone($this->timezone)),
                $this->locale
            ));
        }
    }

    /**
     * Day of Indigenous Resistance.
     *
     * Formerly known as "Columbus Day" or "Day of the Race" (Día de la Raza), this holiday
     * was renamed in 2002 to Day of Indigenous Resistance (Día de la Resistencia Indígena)
     * to honor the indigenous peoples who resisted European colonization.
     *
     * @see https://en.wikipedia.org/wiki/Day_of_Indigenous_Resistance
     */
    protected function calculateDayOfIndigenousResistance(): void
    {
        if ($this->year >= 1921) {
            $this->addHoliday(new Holiday(
                'dayOfIndigenousResistance',
                [
                    'es' => 'Día de la Resistencia Indígena',
                    'en' => 'Day of Indigenous Resistance',
                ],
                new \DateTime("{$this->year}-10-12", DateTimeZoneFactory::getDateTimeZone($this->timezone)),
                $this->locale
            ));
        }
    }

    /**
     * Christmas Eve.
     *
     * Christmas Eve (Nochebuena) is celebrated on December 24th and is an
     * important family celebration in Venezuela.
     */
    protected function calculateChristmasEve(): void
    {
        $this->addHoliday(new Holiday(
            'christmasEve',
            [
                'es' => 'Nochebuena',
                'en' => 'Christmas Eve',
            ],
            new \DateTime("{$this->year}-12-24", DateTimeZoneFactory::getDateTimeZone($this->timezone)),
            $this->locale
        ));
    }

    /**
     * New Year's Eve.
     *
     * New Year's Eve (Nochevieja) is celebrated on December 31st.
     */
    protected function calculateNewYearsEve(): void
    {
        $this->addHoliday(new Holiday(
            'newYearsEve',
            [
                'es' => 'Nochevieja',
                'en' => "New Year\u{2019}s Eve",
            ],
            new \DateTime("{$this->year}-12-31", DateTimeZoneFactory::getDateTimeZone($this->timezone)),
            $this->locale
        ));
    }
}
