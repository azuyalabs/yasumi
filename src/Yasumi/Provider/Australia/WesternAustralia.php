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

namespace Yasumi\Provider\Australia;

use Yasumi\Exception\UnknownLocaleException;
use Yasumi\Holiday;
use Yasumi\Provider\Australia;
use Yasumi\Provider\DateTimeZoneFactory;

/**
 * Provider for all holidays in Western Australia (Australia).
 */
class WesternAustralia extends Australia
{
    /**
     * Code to identify this Holiday Provider. Typically, this is the ISO3166 code corresponding to the respective
     * country or sub-region.
     */
    public const ID = 'AU-WA';

    public string $timezone = 'Australia/Perth';

    /**
     * Initialize holidays for Western Australia (Australia).
     *
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    public function initialize(): void
    {
        parent::initialize();

        if ($this->year >= 2022) {
            $this->addHoliday($this->easterSunday($this->year, $this->timezone, $this->locale));
        }

        $this->calculateMonarchsBirthday();
        $this->calculateLabourDay();
        $this->calculateWesternAustraliaDay();
        $this->calculateAnzacDayMonday();
    }

    /**
     * Easter Sunday.
     *
     * Easter is a festival and holiday celebrating the resurrection of Jesus Christ from the dead. Easter is celebrated
     * on a date based on a certain number of days after March 21st. The date of Easter Day was defined by the Council
     * of Nicaea in AD325 as the Sunday after the first full moon which falls on or after the Spring Equinox.
     *
     * @see https://en.wikipedia.org/wiki/Easter
     * @see https://www.wa.gov.au/service/employment/workplace-arrangements/public-holidays-western-australia
     *
     * @param int         $year     the year for which Easter Sunday need to be created
     * @param string      $timezone the timezone in which Easter Sunday is celebrated
     * @param string      $locale   the locale for which Easter Sunday need to be displayed in
     * @param string|null $type     The type of holiday. Use the following constants: TYPE_OFFICIAL, TYPE_OBSERVANCE,
     *                              TYPE_SEASON, TYPE_BANK or TYPE_OTHER. By default an official holiday is considered.
     *
     * @throws \Exception
     */
    protected function easterSunday(
        int $year,
        string $timezone,
        string $locale,
        ?string $type = null,
    ): Holiday {
        return new Holiday(
            'easter',
            ['en' => 'Easter Sunday'],
            $this->calculateEaster($year, $timezone),
            $locale,
            $type ?? Holiday::TYPE_OFFICIAL
        );
    }

    /**
     * ANZAC Day Monday substitute.
     *
     * When ANZAC Day (April 25) falls on a Saturday or Sunday, the following Monday is an additional public holiday
     * in this state/territory.
     *
     * @see https://en.wikipedia.org/wiki/Anzac_Day
     * @see https://www.timeanddate.com/holidays/australia/anzac-day
     *
     * @throws \Exception
     */
    protected function calculateAnzacDayMonday(): void
    {
        if ($this->year < 1972) {
            return;
        }

        $date = new \DateTime("{$this->year}-04-25", DateTimeZoneFactory::getDateTimeZone($this->timezone));
        $dow = (int) $date->format('w');

        if (6 === $dow) { // Saturday → Monday
            $date->add(new \DateInterval('P2D'));
        } elseif (0 === $dow) { // Sunday → Monday
            $date->add(new \DateInterval('P1D'));
        } else {
            return;
        }

        $this->addHoliday(new Holiday(
            'anzacDayMonday',
            ['en' => 'ANZAC Day'],
            $date,
            $this->locale,
            Holiday::TYPE_OFFICIAL
        ));
    }

    /**
     * Monarch's Birthday.
     *
     * The Monarch's Birthday is an Australian public holiday but the date varies across
     * states and territories. Australia celebrates this holiday because it is a constitutional
     * monarchy, with the English monarch as head of state.
     *
     * Her actual birthday is on April 21, but it's celebrated as a public holiday on the second Monday of June.
     *  (Except QLD & WA)
     *
     * @see https://www.timeanddate.com/holidays/australia/queens-birthday
     *
     * @throws \InvalidArgumentException
     * @throws \Exception
     */
    protected function calculateMonarchsBirthday(): void
    {
        $birthDay = "last monday of september {$this->year}";
        if (2011 === $this->year) {
            $birthDay = '2011-10-28';
        }

        if (2012 === $this->year) {
            $birthDay = '2012-10-01';
        }

        if (2024 === $this->year) {
            $birthDay = '2024-09-23';
        }

        $this->addMonarchsBirthdayHoliday(
            new \DateTime($birthDay, DateTimeZoneFactory::getDateTimeZone($this->timezone))
        );
    }

    /**
     * Labour Day.
     *
     * @throws \Exception
     */
    protected function calculateLabourDay(): void
    {
        $date = new \DateTime("first monday of march {$this->year}", DateTimeZoneFactory::getDateTimeZone($this->timezone));

        $this->addHoliday(new Holiday('labourDay', [], $date, $this->locale));
    }

    /**
     * Western Australia Day.
     *
     * @see https://en.wikipedia.org/wiki/Western_Australia_Day
     *
     * @throws \InvalidArgumentException
     * @throws \Exception
     */
    protected function calculateWesternAustraliaDay(): void
    {
        $this->addHoliday(new Holiday(
            'westernAustraliaDay',
            ['en' => 'Western Australia Day'],
            new \DateTime("first monday of june {$this->year}", DateTimeZoneFactory::getDateTimeZone($this->timezone)),
            $this->locale,
            Holiday::TYPE_OFFICIAL
        ));
    }
}
