<?php declare(strict_types=1);
/**
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 - 2020 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <me@sachatelgenhof.com>
 */

namespace Yasumi\Provider;

use DateInterval;
use DateTime;
use Yasumi\Exception\InvalidDateException;
use Yasumi\Exception\UnknownLocaleException;
use Yasumi\Holiday;

/**
 * Provider for all holidays in Brazil.
 */
class Brazil extends AbstractProvider
{
    use CommonHolidays, ChristianHolidays;

    /**
     * Code to identify this Holiday Provider. Typically this is the ISO3166 code corresponding to the respective
     * country or sub-region.
     */
    public const ID = 'BR';

    /**
     * Initialize holidays for Brazil.
     *
     * @throws InvalidDateException
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    public function initialize(): void
    {
        $this->timezone = 'America/Fortaleza';

        // Add common holidays
        $this->addHoliday($this->newYearsDay($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->internationalWorkersDay($this->year, $this->timezone, $this->locale));

        // Add Christian holidays
        $this->addHoliday($this->christmasDay($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->easter($this->year, $this->timezone, $this->locale, Holiday::TYPE_OBSERVANCE));
        $this->addHoliday($this->corpusChristi($this->year, $this->timezone, $this->locale, Holiday::TYPE_OBSERVANCE));
        $this->addHoliday($this->goodFriday($this->year, $this->timezone, $this->locale, Holiday::TYPE_OBSERVANCE));
        $this->addHoliday($this->ashWednesday($this->year, $this->timezone, $this->locale, Holiday::TYPE_OBSERVANCE));

        /**
         * Carnaval
         *
         * Carnaval is the biggest popular festival of country. The festival it happens during 4 days and the last day above
         * the wednesday of ashes (initiation of lent).
         *
         * @link https://en.wikipedia.org/wiki/Brazilian_Carnival
         */
        if ($this->year >= 1700) {
            $easter = $this->calculateEaster($this->year, $this->timezone);

            $carnavalMonday = clone $easter;
            $this->addHoliday(new Holiday(
                'carnavalMonday',
                ['pt' => 'Segunda-feira de Carnaval'],
                $carnavalMonday->sub(new DateInterval('P48D')),
                $this->locale,
                Holiday::TYPE_OBSERVANCE
            ));

            $carnavalTuesday = clone $easter;
            $this->addHoliday(new Holiday(
                'carnavalTuesday',
                ['pt' => 'Terça-feira de Carnaval'],
                $carnavalTuesday->sub(new DateInterval('P47D')),
                $this->locale,
                Holiday::TYPE_OBSERVANCE
            ));
        }

        /**
         * Tiradentes Day
         *
         * Tiradentes Day is a the Brazilian national holidays. Is the a tribute to national Brazilian hero Joaquim José
         * da Silva Xavier, martyr of Inconfidência Mineira. Is celebrated on 21 Abril, because the execution of
         * Tiradentes got in the day, in 1792.
         *
         * @link https://en.wikipedia.org/wiki/Tiradentes
         */
        if ($this->year >= 1792) {
            $this->addHoliday(new Holiday(
                'tiradentesDay',
                ['pt' => 'Dia de Tiradentes'],
                new DateTime("$this->year-04-21", DateTimeZoneFactory::getDateTimeZone($this->timezone)),
                $this->locale
            ));
        }

        /**
         * Independence Day
         *
         * The Homeland Day is a national holiday of Brazilian homeland celebrated on 7 September. The date is
         * celebrated the independence declaration of Brazil to Portuguese empire on 7 September 1822.
         *
         * @link https://en.wikipedia.org/wiki/Independence_of_Brazil
         */
        if ($this->year >= 1822) {
            $this->addHoliday(new Holiday(
                'independenceDay',
                ['pt' => 'Dia da Independência do Brasil'],
                new DateTime("$this->year-09-07", DateTimeZoneFactory::getDateTimeZone($this->timezone)),
                $this->locale
            ));
        }

        /**
         * Our Lady of Aparecida Day
         *
         * Our Lady of Conceição Aparecida, popularly called Our Lady Aparecida, Brazil's patroness. She is
         * venerated in Catholic Church. Our Lady Aparecida is represented like a little image of Virgen Maria,
         * currently in Basílica of Our Lady Aparecida, localized in São Paulo.
         *
         * The event is celebrated on 12 October, a national holiday in Brazil since 1980.
         *
         * @link https://en.wikipedia.org/wiki/Our_Lady_of_Aparecida
         */
        if ($this->year >= 1980) {
            $this->addHoliday(new Holiday(
                'ourLadyOfAparecidaDay',
                ['pt' => 'Dia de Nossa Senhora Aparecida'],
                new DateTime("$this->year-10-12", DateTimeZoneFactory::getDateTimeZone($this->timezone)),
                $this->locale
            ));
        }

        /**
         * All Souls Day
         *
         * The All Souls day (known like Deads Day in Mexico), is celebrated for Catholic Church on 2 November.
         *
         * @link http://www.johninbrazil.org/all-souls-day-o-dia-dos-finados/
         */
        if ($this->year >= 1300) {
            $this->addHoliday(new Holiday(
                'allSoulsDay',
                [],
                new DateTime("$this->year-11-02", DateTimeZoneFactory::getDateTimeZone($this->timezone)),
                $this->locale
            ));
        }

        /**
         * Proclamation of Republic Day
         *
         * The Brazilian Proclamation of Republic was an act relevant military politic it happened on 15 November 1889
         * that initiated the build federative presidential of govern in Brazil, downed the monarchy constitutional
         * parlamentary of Brazil's Empire.
         *
         * @link https://en.wikipedia.org/wiki/Proclamation_of_the_Republic_(Brazil)
         */
        if ($this->year >= 1889) {
            $this->addHoliday(new Holiday(
                'proclamationOfRepublicDay',
                ['pt' => 'Dia da Proclamação da República'],
                new DateTime("$this->year-11-15", DateTimeZoneFactory::getDateTimeZone($this->timezone)),
                $this->locale
            ));
        }
    }
}
