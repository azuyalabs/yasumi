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
 * Provider for all holidays in Greece.
 */
class Greece extends AbstractProvider
{
    use CommonHolidays;
    use ChristianHolidays;

    /**
     * Code to identify this Holiday Provider. Typically, this is the ISO3166 code corresponding to the respective
     * country or sub-region.
     */
    public const ID = 'GR';

    /**
     * Initialize holidays for Greece.
     *
     * @throws InvalidDateException
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    public function initialize(): void
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

    public function getSources(): array
    {
        return [
            'https://en.wikipedia.org/wiki/Public_holidays_in_Greece',
            'https://el.wikipedia.org/wiki/%CE%95%CF%80%CE%AF%CF%83%CE%B7%CE%BC%CE%B5%CF%82_%CE%B1%CF%81%CE%B3%CE%AF%CE%B5%CF%82_%CF%83%CF%84%CE%B7%CE%BD_%CE%95%CE%BB%CE%BB%CE%AC%CE%B4%CE%B1',
        ];
    }

    /**
     * The Three Holy Hierarchs.
     *
     * Commemoration of the patron saints of education (St. Basil the Great, St. Gregory the Theologian, St. John
     * Chrysostom).
     *
     * @see https://en.wikipedia.org/wiki/Three_Holy_Hierarchs
     *
     * @throws InvalidDateException
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    private function calculateThreeHolyHierarchs(): void
    {
        $this->addHoliday(new Holiday(
            'threeHolyHierarchs',
            ['el' => 'Τριών Ιεραρχών'],
            new DateTime("$this->year-1-30", DateTimeZoneFactory::getDateTimeZone($this->timezone)),
            $this->locale,
            Holiday::TYPE_OTHER
        ));
    }

    /**
     * Clean Monday.
     *
     * Also known as Pure Monday, Ash Monday, Monday of Lent or Green Monday,
     * it is the first day of Great Lent in the Eastern Orthodox Christian.
     * It is a movable feast that occurs at the beginning of the 7th week before Orthodox Easter Sunday.
     *
     * @see https://en.wikipedia.org/wiki/Clean_Monday
     *
     * @throws InvalidDateException
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    private function calculateCleanMonday(): void
    {
        $this->addHoliday(new Holiday(
            'cleanMonday',
            ['el' => 'Καθαρά Δευτέρα'],
            $this->calculateEaster($this->year, $this->timezone)->sub(new DateInterval('P48D')),
            $this->locale
        ));
    }

    /**
     * Orthodox Easter.
     *
     * @throws \Exception
     *
     * @return \DateTime|\DateTimeImmutable
     */
    private function calculateEaster(int $year, string $timezone): \DateTimeInterface
    {
        return $this->calculateOrthodoxEaster($year, $timezone);
    }

    /**
     * Independence Day.
     *
     * Anniversary of the declaration of the start of Greek War of Independence from the Ottoman Empire, in 1821.
     *
     * @see https://en.wikipedia.org/wiki/Greek_War_of_Independence
     *
     * @throws InvalidDateException
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    private function calculateIndependenceDay(): void
    {
        if ($this->year >= 1821) {
            $this->addHoliday(new Holiday(
                'independenceDay',
                ['el' => 'Εικοστή Πέμπτη Μαρτίου'],
                new DateTime("$this->year-3-25", DateTimeZoneFactory::getDateTimeZone($this->timezone)),
                $this->locale
            ));
        }
    }

    /**
     * Ohi Day.
     *
     * Celebration of the Greek refusal to the Italian ultimatum of 1940.
     *
     * @see https://en.wikipedia.org/wiki/Ohi_Day
     *
     * @throws InvalidDateException
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    private function calculateOhiDay(): void
    {
        if ($this->year >= 1940) {
            $this->addHoliday(new Holiday(
                'ohiDay',
                ['el' => 'Επέτειος του Όχι'],
                new DateTime("$this->year-10-28", DateTimeZoneFactory::getDateTimeZone($this->timezone)),
                $this->locale
            ));
        }
    }

    /**
     * Polytechnio.
     *
     * Anniversary of the 1973 students protests against the junta of the colonels (1967–1974).
     *
     * @see https://en.wikipedia.org/wiki/Athens_Polytechnic_uprising
     *
     * @throws InvalidDateException
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    private function calculatePolytechnio(): void
    {
        if ($this->year >= 1973) {
            $this->addHoliday(new Holiday(
                'polytechnio',
                ['el' => 'Πολυτεχνείο'],
                new DateTime("$this->year-11-17", DateTimeZoneFactory::getDateTimeZone($this->timezone)),
                $this->locale,
                Holiday::TYPE_OTHER
            ));
        }
    }
}
