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
 * @author Bertrand Kintanar <bertrand dot kintanar at gmail dot com>
 */

namespace Yasumi\Provider;

use DateInterval;
use DateTime;
use Yasumi\Exception\InvalidDateException;
use Yasumi\Exception\UnknownLocaleException;
use Yasumi\Holiday;

/**
 * Provider for all holidays in Cyprus.
 */
class Cyprus extends AbstractProvider
{
    use CommonHolidays;
    use ChristianHolidays;

    /**
     * Code to identify this Holiday Provider. Typically, this is the ISO3166 code corresponding to the respective
     * country or sub-region.
     */
    public const ID = 'CY';

    /**
     * Initialize holidays for Cyprus.
     *
     * @throws InvalidDateException
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    public function initialize(): void
    {
        $this->timezone = 'Asia/Nicosia';

        // Add common holidays
        $this->addHoliday($this->newYearsDay($this->year, $this->timezone, $this->locale));

        // Add Christian holidays
        $this->addHoliday($this->epiphany($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->christmasEve($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->christmasDay($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->secondChristmasDay($this->year, $this->timezone, $this->locale));

        $this->addHoliday($this->goodFriday($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->easterMonday($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->easterTuesday($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->pentecostMonday($this->year, $this->timezone, $this->locale));

        // Calculate other holidays
        $this->calculateGreenMonday();
        $this->calculateGreekIndependenceDay();
        $this->calculateGreekCypriotNationalDay();
        $this->calculateLabourDay();
        $this->calculateDormitionOfTheTheotokos();
        $this->calculateCypriotIndependenceDay();
        $this->calculateGreekNationalDay();
    }

    public function getSources(): array
    {
        return [
            'https://en.wikipedia.org/wiki/Public_holidays_in_Cyprus',
            'https://www.officeholidays.com/countries/cyprus',
        ];
    }

    /**
     * @throws \Exception
     *
     * @return \DateTime|\DateTimeImmutable
     */
    protected function calculateEaster(int $year, string $timezone): \DateTimeInterface
    {
        return $this->calculateOrthodoxEaster($year, $timezone);
    }

    /**
     * Easter Tuesday.
     *
     * Easter is a festival and holiday celebrating the resurrection of Jesus Christ from the dead. Easter is celebrated
     * on a date based on a certain number of days after March 21st. The date of Easter Day was defined by the Council
     * of Nicaea in AD325 as the Sunday after the first full moon which falls on or after the Spring Equinox.
     *
     * @see https://en.wikipedia.org/wiki/Easter
     *
     * @param int    $year     the year for which Easter Tuesday need to be created
     * @param string $timezone the timezone in which Easter Tuesday is celebrated
     * @param string $locale   the locale for which Easter Tuesday need to be displayed in
     * @param string $type     The type of holiday. Use the following constants: TYPE_OFFICIAL, TYPE_OBSERVANCE,
     *                         TYPE_SEASON, TYPE_BANK or TYPE_OTHER. By default an official holiday is considered.
     *
     * @throws InvalidDateException
     * @throws UnknownLocaleException
     * @throws \InvalidArgumentException
     * @throws \Exception
     */
    protected function easterTuesday(
        int $year,
        string $timezone,
        string $locale,
        string $type = Holiday::TYPE_BANK
    ): Holiday {
        return new Holiday(
            'easterTuesday',
            ['en' => 'Easter Tuesday'],
            $this->calculateEaster($year, $timezone)->add(new DateInterval('P2D')),
            $locale,
            $type
        );
    }

    /**
     * Labour Day.
     *
     * @see https://en.wikipedia.org/wiki/Labour_Day
     *
     * @throws InvalidDateException
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    private function calculateLabourDay(): void
    {
        if ($this->year < 1890) {
            return;
        }
        $date = new DateTime($this->year.'-05-01', DateTimeZoneFactory::getDateTimeZone($this->timezone));
        $this->addHoliday(new Holiday(
            'labourDay',
            [],
            $date,
            $this->locale
        ));
    }

    /**
     * Greek Independence Day.
     *
     * @see https://en.wikipedia.org/w/index.php?title=Greek_Independence_Day.
     *
     * The first celebration took place in Athens which was attended by King Otto and Queen Amalia, political
     * and military authorities and a mass of people. The Metropolitan Church of Athens was built on
     * 15 December 1842 and was dedicated to the Annunciation in order to honour 25 March 1821.

     *
     * @throws InvalidDateException
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    private function calculateGreekIndependenceDay(): void
    {
        if ($this->year < 1821) {
            return;
        }
        $date = new DateTime($this->year.'-03-25', DateTimeZoneFactory::getDateTimeZone($this->timezone));
        $this->addHoliday(new Holiday(
            'greekIndependenceDay',
            [],
            $date,
            $this->locale
        ));
    }

    /**
     * Greek Cypriot National Day.
     *
     * @see https://en.wikipedia.org/wiki/EOKA#Armed_campaign
     *
     * This holiday is always celebrated on April 1st. Also known as 'EOKA Day', this holiday commemorates the start
     * of the insurgence against the British in 1955.

     *
     * @throws InvalidDateException
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    private function calculateGreekCypriotNationalDay(): void
    {
        if ($this->year < 1956) {
            return;
        }
        $date = new DateTime($this->year.'-04-01', DateTimeZoneFactory::getDateTimeZone($this->timezone));
        $this->addHoliday(new Holiday(
            'greekCypriotNationalDay',
            [],
            $date,
            $this->locale
        ));
    }

    /**
     * Green Monday.
     *
     * @see https://en.wikipedia.org/wiki/Clean_Monday.
     *
     * Clean Monday (Greek: Καθαρά Δευτέρα), also known as Pure Monday, Ash Monday, Monday of Lent or Green Monday, is
     * the first day of Great Lent throughout Eastern Christianity and is a moveable feast, falling on the 6th Monday
     * before Palm Sunday which begins the Holy Week preceding Pascha Sunday (Easter).

     *
     * @throws InvalidDateException
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    private function calculateGreenMonday(): void
    {
        $date = $this->ashWednesday($this->year, $this->timezone, $this->locale)->sub(new DateInterval('P2D'));

        $this->addHoliday(new Holiday(
            'greenMonday',
            ['en' => 'Green Monday'],
            $date,
            $this->locale,
            Holiday::TYPE_OFFICIAL
        ));
    }

    /**
     * Dormition of the Theotokos.
     *
     * @see https://en.wikipedia.org/w/index.php?title=Dormition_of_the_Theotokos.
     *
     * It is celebrated on 15 August (28 August N.S. in the Julian Calendar) as the Feast of the Dormition of the
     * Mother of God.

     *
     * @throws InvalidDateException
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    private function calculateDormitionOfTheTheotokos(): void
    {
        $date = new DateTime($this->year.'-08-15', DateTimeZoneFactory::getDateTimeZone($this->timezone));
        $this->addHoliday(new Holiday(
            'dormitionOfTheTheotokos',
            [],
            $date,
            $this->locale
        ));
    }

    /**
     * Cypriot Independence Day.
     *
     * @see https://en.wikipedia.org/wiki/Independence_Day_(Cyprus).
     *
     * The Independence Day of Cyprus is a national holiday observed by The Republic of Cyprus on 1 October every year.
     * The day celebrates the independence of Cyprus from British rule on 16 August 1960, which was guaranteed by Greece,
     * Turkey and the United Kingdom in The London and Zürich Agreements.

     *
     * @throws InvalidDateException
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    private function calculateCypriotIndependenceDay(): void
    {
        if ($this->year < 1960) {
            return;
        }

        $date = new DateTime($this->year.'-10-01', DateTimeZoneFactory::getDateTimeZone($this->timezone));
        $this->addHoliday(new Holiday(
            'cypriotIndependenceDay',
            [],
            $date,
            $this->locale
        ));
    }

    /**
     * Greek National Day.
     *
     * @see https://en.wikipedia.org/wiki/Ohi_Day.
     *
     * Ohi Day or Oxi Day (Greek: Επέτειος του Όχι, romanized: Epéteios tou Óchi, lit. 'Anniversary of the No';
     * Greek pronunciation: [eˈpetios tu ˈoçi]) is celebrated throughout Greece, Cyprus and the Greek communities around
     * the world on 28 October each year. Ohi Day commemorates the rejection by Greek prime minister Ioannis Metaxas of
     * the ultimatum made by Italian dictator Benito Mussolini on 28 October 1940, the Hellenic counterattack against
     * the invading Italian forces at the mountains of Pindus during the Greco-Italian War, and the Greek Resistance
     * during the Axis occupation.

     *
     * @throws InvalidDateException
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    private function calculateGreekNationalDay(): void
    {
        if ($this->year < 1940) {
            return;
        }

        $date = new DateTime($this->year.'-10-28', DateTimeZoneFactory::getDateTimeZone($this->timezone));
        $this->addHoliday(new Holiday(
            'greekNationalDay',
            [],
            $date,
            $this->locale
        ));
    }
}
