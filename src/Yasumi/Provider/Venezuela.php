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
 * Venezuela observes 14 public holidays established by the Ley Orgánica del
 * Trabajo, los Trabajadores y las Trabajadoras (LOTTT, Art. 184) and the
 * Ley de Fiestas Nacionales (1971).
 *
 * @see https://en.wikipedia.org/wiki/Public_holidays_in_Venezuela
 */
class Venezuela extends AbstractProvider
{
    use CommonHolidays;
    use ChristianHolidays;

    /**
     * Year Venezuela declared the first act of independence (19 April 1810).
     */
    public const DECLARATION_OF_INDEPENDENCE_YEAR = 1810;

    /**
     * Year Venezuela formally declared full independence (5 July 1811).
     */
    public const INDEPENDENCE_YEAR = 1811;

    /**
     * Year of the Battle of Carabobo, which secured independence (24 June 1821).
     */
    public const BATTLE_OF_CARABOBO_YEAR = 1821;

    /**
     * Birth year of Simón Bolívar (24 July 1783).
     */
    public const BOLIVAR_BIRTH_YEAR = 1783;

    /**
     * Year Columbus arrived in the Americas (12 October 1492).
     */
    public const COLUMBUS_YEAR = 1492;

    /**
     * Year the holiday was renamed from "Día de la Raza" to
     * "Día de la Resistencia Indígena" (Decreto 2028, 2002).
     */
    public const INDIGENOUS_RESISTANCE_YEAR = 2002;

    /**
     * Code to identify this Holiday Provider. Typically, this is the ISO3166
     * code corresponding to the respective country or sub-region.
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

        // Fixed holidays defined in LOTTT Art. 184(b)
        $this->addHoliday($this->newYearsDay($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->maundyThursday($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->goodFriday($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->internationalWorkersDay($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->christmasEve($this->year, $this->timezone, $this->locale, Holiday::TYPE_OFFICIAL));
        $this->addHoliday($this->christmasDay($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->newYearsEve($this->year, $this->timezone, $this->locale));

        // Carnival (LOTTT Art. 184(b): Monday and Tuesday before Easter)
        $this->addCarnivalHolidays();

        // Fixed holidays defined in Ley de Fiestas Nacionales
        $this->addDeclarationOfIndependenceDay();
        $this->addBattleOfCaraboboDay();
        $this->addIndependenceDay();
        $this->addBolivarBirthdayDay();
        $this->addIndigenousResistanceDay();
    }

    /**
     * The source of the holidays.
     *
     * @return string[] The source URLs
     */
    public function getSources(): array
    {
        return [
            'https://en.wikipedia.org/wiki/Public_holidays_in_Venezuela',
            'https://accesoalajusticia.org/glossary/dias-festivos/',
            'https://venezuela.justia.com/federales/leyes/ley-de-fiestas-nacionales/gdoc/',
            'https://www.asambleanacional.gob.ve/leyes/sancionadas/ley-de-reforma-parcial-de-la-ley-de-fiestas-nacionales',
        ];
    }

    /**
     * Carnival Monday and Tuesday.
     *
     * Established by LOTTT Art. 184(b). Carnival falls on the Monday and
     * Tuesday immediately before Ash Wednesday (Easter − 48 and Easter − 47 days).
     *
     * @throws \Exception
     */
    protected function addCarnivalHolidays(): void
    {
        $easter = $this->calculateEaster($this->year, $this->timezone);

        $days = [
            'carnivalMonday' => [
                'interval' => 'P48D',
                'es' => 'Lunes de Carnaval',
                'en' => 'Carnival Monday',
            ],
            'carnivalTuesday' => [
                'interval' => 'P47D',
                'es' => 'Martes de Carnaval',
                'en' => 'Carnival Tuesday',
            ],
        ];

        foreach ($days as $key => $day) {
            $date = (clone $easter)->sub(new \DateInterval($day['interval']));

            if (! $date instanceof \DateTime) {
                throw new \RuntimeException(sprintf('Unable to perform date subtraction for %s:%s', self::class, $key));
            }

            $this->addHoliday(new Holiday(
                $key,
                ['es' => $day['es'], 'en' => $day['en']],
                $date,
                $this->locale
            ));
        }
    }

    /**
     * Declaration of Independence Day (19 April).
     *
     * Commemorates the Caracas City Council's act of 19 April 1810 that
     * removed the Spanish Captain-General, marking the start of Venezuela's
     * independence movement.
     *
     * @see https://en.wikipedia.org/wiki/Venezuelan_Declaration_of_Independence
     *
     * @throws \Exception
     */
    protected function addDeclarationOfIndependenceDay(): void
    {
        if ($this->year >= self::DECLARATION_OF_INDEPENDENCE_YEAR) {
            $this->addHoliday(new Holiday(
                'declarationOfIndependenceDay',
                [
                    'es' => 'Declaración de Independencia',
                    'en' => 'Declaration of Independence Day',
                ],
                new \DateTime("{$this->year}-04-19", DateTimeZoneFactory::getDateTimeZone($this->timezone)),
                $this->locale
            ));
        }
    }

    /**
     * Battle of Carabobo Day (24 June).
     *
     * Commemorates the decisive battle of 24 June 1821 that secured
     * Venezuela's independence from Spain.
     *
     * @see https://en.wikipedia.org/wiki/Battle_of_Carabobo
     *
     * @throws \Exception
     */
    protected function addBattleOfCaraboboDay(): void
    {
        if ($this->year >= self::BATTLE_OF_CARABOBO_YEAR) {
            $this->addHoliday(new Holiday(
                'battleOfCaraboboDay',
                [
                    'es' => 'Batalla de Carabobo',
                    'en' => 'Battle of Carabobo Day',
                ],
                new \DateTime("{$this->year}-06-24", DateTimeZoneFactory::getDateTimeZone($this->timezone)),
                $this->locale
            ));
        }
    }

    /**
     * Independence Day (5 July).
     *
     * Commemorates the formal Declaration of Independence signed by the
     * Venezuelan Congress on 5 July 1811.
     *
     * @see https://en.wikipedia.org/wiki/Venezuelan_Declaration_of_Independence
     *
     * @throws \Exception
     */
    protected function addIndependenceDay(): void
    {
        if ($this->year >= self::INDEPENDENCE_YEAR) {
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
     * Simón Bolívar's Birthday (24 July).
     *
     * Commemorates the birth of Simón Bolívar, Liberator of Venezuela and
     * five other South American nations, born on 24 July 1783.
     *
     * @see https://en.wikipedia.org/wiki/Sim%C3%B3n_Bol%C3%ADvar
     *
     * @throws \Exception
     */
    protected function addBolivarBirthdayDay(): void
    {
        if ($this->year >= self::BOLIVAR_BIRTH_YEAR) {
            $this->addHoliday(new Holiday(
                'bolivarBirthdayDay',
                [
                    'es' => 'Natalicio de Simón Bolívar',
                    'en' => 'Simón Bolívar’s Birthday',
                ],
                new \DateTime("{$this->year}-07-24", DateTimeZoneFactory::getDateTimeZone($this->timezone)),
                $this->locale
            ));
        }
    }

    /**
     * Day of Indigenous Resistance / Columbus Day (12 October).
     *
     * Known as "Día de la Raza" (Columbus Day) until 2001. Renamed to
     * "Día de la Resistencia Indígena" (Day of Indigenous Resistance) by
     * Presidential Decree 2028 in 2002 under President Hugo Chávez.
     *
     * @see https://en.wikipedia.org/wiki/Day_of_Indigenous_Resistance
     *
     * @throws \Exception
     */
    protected function addIndigenousResistanceDay(): void
    {
        if ($this->year >= self::COLUMBUS_YEAR) {
            $name = $this->year >= self::INDIGENOUS_RESISTANCE_YEAR
                ? ['es' => 'Día de la Resistencia Indígena', 'en' => 'Day of Indigenous Resistance']
                : ['es' => 'Día de la Raza', 'en' => 'Columbus Day'];

            $this->addHoliday(new Holiday(
                'indigenousResistanceDay',
                $name,
                new \DateTime("{$this->year}-10-12", DateTimeZoneFactory::getDateTimeZone($this->timezone)),
                $this->locale
            ));
        }
    }
}
