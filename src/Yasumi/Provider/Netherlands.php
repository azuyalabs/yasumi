<?php

declare(strict_types=1);

/*
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
 * Provider for all holidays in the Netherlands.
 */
class Netherlands extends AbstractProvider
{
    use CommonHolidays;
    use ChristianHolidays;

    /**
     * Code to identify this Holiday Provider. Typically, this is the ISO3166 code corresponding to the respective
     * country or sub-region.
     */
    public const ID = 'NL';

    /**
     * Initialize holidays for the Netherlands.
     *
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    public function initialize(): void
    {
        $this->timezone = 'Europe/Amsterdam';

        // Add common holidays
        $this->addHoliday($this->newYearsDay($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->internationalWorkersDay(
            $this->year,
            $this->timezone,
            $this->locale,
            Holiday::TYPE_OTHER
        ));
        $this->addHoliday($this->valentinesDay($this->year, $this->timezone, $this->locale, Holiday::TYPE_OTHER));

        // World Animal Day is celebrated since 1931
        if ($this->year >= 1931) {
            $this->addHoliday($this->worldAnimalDay($this->year, $this->timezone, $this->locale, Holiday::TYPE_OTHER));
        }

        $this->addHoliday($this->stMartinsDay($this->year, $this->timezone, $this->locale, Holiday::TYPE_OBSERVANCE));
        $this->addHoliday($this->fathersDay($this->year, $this->timezone, $this->locale, Holiday::TYPE_OTHER));
        $this->addHoliday($this->mothersDay($this->year, $this->timezone, $this->locale, Holiday::TYPE_OTHER));

        // Add Christian holidays
        $this->addHoliday($this->easter($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->easterMonday($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->pentecost($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->pentecostMonday($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->ascensionDay($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->goodFriday($this->year, $this->timezone, $this->locale, Holiday::TYPE_OBSERVANCE));
        $this->addHoliday($this->ashWednesday($this->year, $this->timezone, $this->locale, Holiday::TYPE_OBSERVANCE));
        $this->addHoliday($this->epiphany($this->year, $this->timezone, $this->locale, Holiday::TYPE_OTHER));
        $this->addHoliday($this->christmasDay($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->secondChristmasDay($this->year, $this->timezone, $this->locale));

        // Calculate other holidays
        $this->calculateCarnival();
        $this->calculateStNicholasDay();
        $this->calculateHalloween();
        $this->calculatePrincesDay();
        $this->calculateQueensday();
        $this->calculateKingsday();
        $this->calculateCommemorationLiberationDay();
    }

    public function getSources(): array
    {
        return [
            'https://en.wikipedia.org/wiki/Public_holidays_in_the_Netherlands',
            'https://nl.wikipedia.org/wiki/Feestdagen_in_Nederland',
        ];
    }

    /**
     * Carnival.
     *
     * Carnival (Dutch: Carnaval) is originally an European Pagan spring festival, with an emphasis on role-reversal
     * and suspension of social norms. The feast became assimilated by the Catholic Church and was celebrated in the
     * three days preceding Ash Wednesday and Lent.
     *
     * @throws \Exception
     */
    private function calculateCarnival(): void
    {
        $easter = $this->calculateEaster($this->year, $this->timezone);

        $intervals = [
            'carnivalDay' => 'P49D',
            'secondCarnivalDay' => 'P48D',
            'thirdCarnivalDay' => 'P47D',
        ];

        foreach ($intervals as $name => $interval) {
            $date = (clone $easter)->sub(new \DateInterval($interval));

            if (! $date instanceof \DateTime) {
                throw new \RuntimeException(sprintf('unable to perform a date subtraction for %s:%s', self::class, $name));
            }

            $this->addHoliday(new Holiday(
                $name,
                ['en' => 'Carnival', 'nl' => 'Carnaval'],
                $date,
                $this->locale,
                Holiday::TYPE_OBSERVANCE
            ));
        }
    }

    /**
     * St. Nicholas' Day.
     *
     * The feast of Sinterklaas celebrates the name day of Saint Nicholas on 6 December.
     * The feast is celebrated annually with the giving of gifts on St. Nicholas' Eve (5 December) in the Netherlands
     * and on the morning of 6 December, Saint Nicholas Day, in Belgium, Luxembourg and northern France
     * (French Flanders, Lorraine and Artois).
     *
     * @see https://en.wikipedia.org/wiki/Sinterklaas
     *
     * @throws \Exception
     */
    private function calculateStNicholasDay(): void
    {
        /*
         * St. Nicholas' Day
         */
        $this->addHoliday(new Holiday(
            'stNicholasDay',
            ['en' => 'St. Nicholas’ Day', 'nl' => 'Sinterklaas'],
            new \DateTime("{$this->year}-12-5", DateTimeZoneFactory::getDateTimeZone($this->timezone)),
            $this->locale,
            Holiday::TYPE_OBSERVANCE
        ));
    }

    /**
     * Halloween.
     *
     * Halloween or Hallowe'en (a contraction of Hallows' Even or Hallows' Evening), is a celebration observed in
     * several countries on 31 October, the eve of the Western Christian feast of All Hallows' Day.
     * It begins the three-day observance of Allhallowtide, the time in the liturgical year dedicated to remembering the
     * dead, including saints (hallows), martyrs, and all the faithful departed.
     *
     * @see https://en.wikipedia.org/wiki/Halloween
     *
     * @throws \Exception
     */
    private function calculateHalloween(): void
    {
        $this->addHoliday(new Holiday(
            'halloween',
            ['en' => 'Halloween', 'nl' => 'Halloween'],
            new \DateTime("{$this->year}-10-31", DateTimeZoneFactory::getDateTimeZone($this->timezone)),
            $this->locale,
            Holiday::TYPE_OBSERVANCE
        ));
    }

    /**
     * Prince's Day.
     *
     * Prinsjesdag (English: Prince's Day) is the day on which the reigning monarch of the Netherlands addresses a joint
     * session of the Dutch Senate and House of Representatives.
     *
     * @throws \Exception
     */
    private function calculatePrincesDay(): void
    {
        $this->addHoliday(new Holiday(
            'princesDay',
            ['en' => 'Prince’s Day', 'nl' => 'Prinsjesdag'],
            new \DateTime("third tuesday of september {$this->year}", DateTimeZoneFactory::getDateTimeZone($this->timezone)),
            $this->locale,
            Holiday::TYPE_OTHER
        ));
    }

    /**
     * Queen's Day.
     *
     * Queen's Day was celebrated between 1891 and 1948 (inclusive) on August 31. Between 1949 and 2013 (inclusive) it
     * was celebrated April 30. If these dates are on a Sunday, Queen's Day was celebrated one day later until 1980
     * (on the following Monday), starting 1980 one day earlier (on the preceding Saturday).
     *
     * @throws \Exception
     */
    private function calculateQueensday(): void
    {
        if ($this->year >= 1891 && $this->year <= 2013) {
            $date = new \DateTime("{$this->year}-4-30", DateTimeZoneFactory::getDateTimeZone($this->timezone));
            if ($this->year <= 1948) {
                $date = new \DateTime("{$this->year}-8-31", DateTimeZoneFactory::getDateTimeZone($this->timezone));
            }

            // Determine substitution day
            if (0 === (int) $date->format('w')) {
                $this->year < 1980 ? $date->add(new \DateInterval('P1D')) : $date->sub(new \DateInterval('P1D'));
            }

            $this->addHoliday(new Holiday(
                'queensDay',
                ['en' => 'Queen’s Day', 'nl' => 'Koninginnedag'],
                $date,
                $this->locale
            ));
        }
    }

    /**
     * Kings Day.
     *
     * King's Day is celebrated from 2014 onwards on April 27th. If this happens to be on a Sunday, it will be
     * celebrated the day before instead.
     *
     * @throws \Exception
     */
    private function calculateKingsday(): void
    {
        if ($this->year >= 2014) {
            $date = new \DateTime("{$this->year}-4-27", DateTimeZoneFactory::getDateTimeZone($this->timezone));

            if (0 === (int) $date->format('w')) {
                $date->sub(new \DateInterval('P1D'));
            }

            $this->addHoliday(new Holiday(
                'kingsDay',
                ['en' => 'Kings Day', 'nl' => 'Koningsdag'],
                $date,
                $this->locale
            ));
        }
    }

    /**
     * Commemoration Day and Liberation Day.
     *
     * Instituted after WWII in 1947.
     *
     * @throws \Exception
     */
    private function calculateCommemorationLiberationDay(): void
    {
        if ($this->year >= 1947) {
            $this->addHoliday(new Holiday(
                'commemorationDay',
                ['en' => 'Commemoration Day', 'nl' => 'dodenherdenking'],
                new \DateTime("{$this->year}-5-4", DateTimeZoneFactory::getDateTimeZone($this->timezone)),
                $this->locale,
                Holiday::TYPE_OBSERVANCE
            ));
            // Liberation day is only an official holiday every 5 years
            $holidayType = 0 === $this->year % 5 ? Holiday::TYPE_OFFICIAL : Holiday::TYPE_OBSERVANCE;
            $this->addHoliday(new Holiday(
                'liberationDay',
                ['en' => 'Liberation Day', 'nl' => 'Bevrijdingsdag'],
                new \DateTime("{$this->year}-5-5", DateTimeZoneFactory::getDateTimeZone($this->timezone)),
                $this->locale,
                $holidayType
            ));
        }
    }
}
