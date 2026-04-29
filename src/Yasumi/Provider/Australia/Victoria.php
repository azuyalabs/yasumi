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
 * Provider for all holidays in Victoria (Australia).
 */
class Victoria extends Australia
{
    /**
     * Code to identify this Holiday Provider. Typically, this is the ISO3166 code corresponding to the respective
     * country or sub-region.
     */
    public const ID = 'AU-VIC';

    public string $timezone = 'Australia/Melbourne';

    /**
     * Initialize holidays for Victoria (Australia).
     *
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    public function initialize(): void
    {
        parent::initialize();

        $this->addHoliday($this->easterSunday($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->easterSaturday($this->year, $this->timezone, $this->locale));
        $this->calculateLabourDay();
        $this->calculateMonarchsBirthday();
        $this->calculateMelbourneCupDay();
        $this->calculateAFLGrandFinalDay();
    }

    /**
     * Easter Sunday.
     *
     * Easter is a festival and holiday celebrating the resurrection of Jesus Christ from the dead. Easter is celebrated
     * on a date based on a certain number of days after March 21st. The date of Easter Day was defined by the Council
     * of Nicaea in AD325 as the Sunday after the first full moon which falls on or after the Spring Equinox.
     *
     * @see https://en.wikipedia.org/wiki/Easter
     *
     * @param int         $year     the year for which Easter Saturday need to be created
     * @param string      $timezone the timezone in which Easter Saturday is celebrated
     * @param string      $locale   the locale for which Easter Saturday need to be displayed in
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
     * Easter Saturday.
     *
     * Easter is a festival and holiday celebrating the resurrection of Jesus Christ from the dead. Easter is celebrated
     * on a date based on a certain number of days after March 21st. The date of Easter Day was defined by the Council
     * of Nicaea in AD325 as the Sunday after the first full moon which falls on or after the Spring Equinox.
     *
     * @see https://en.wikipedia.org/wiki/Easter
     *
     * @param int         $year     the year for which Easter Saturday need to be created
     * @param string      $timezone the timezone in which Easter Saturday is celebrated
     * @param string      $locale   the locale for which Easter Saturday need to be displayed in
     * @param string|null $type     The type of holiday. Use the following constants: TYPE_OFFICIAL, TYPE_OBSERVANCE,
     *                              TYPE_SEASON, TYPE_BANK or TYPE_OTHER. By default an official holiday is considered.
     *
     * @throws \Exception
     */
    protected function easterSaturday(
        int $year,
        string $timezone,
        string $locale,
        ?string $type = null,
    ): Holiday {
        $date = $this->calculateEaster($year, $timezone)->sub(new \DateInterval('P1D'));

        if (! $date instanceof \DateTime) {
            throw new \RuntimeException(sprintf('unable to perform a date subtraction for %s:%s', self::class, 'easterSaturday'));
        }

        return new Holiday(
            'easterSaturday',
            ['en' => 'Easter Saturday'],
            $date,
            $locale,
            $type ?? Holiday::TYPE_OFFICIAL
        );
    }

    /**
     * Labour Day.
     *
     * @throws \Exception
     */
    protected function calculateLabourDay(): void
    {
        $date = new \DateTime("second monday of march {$this->year}", DateTimeZoneFactory::getDateTimeZone($this->timezone));

        $this->addHoliday(new Holiday('labourDay', [], $date, $this->locale));
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
        $this->addMonarchsBirthdayHoliday(
            new \DateTime("second monday of june {$this->year}", DateTimeZoneFactory::getDateTimeZone($this->timezone))
        );
    }

    /**
     * Melbourne Cup Day.
     *
     * @throws \Exception
     */
    protected function calculateMelbourneCupDay(): void
    {
        $date = new \DateTime("first Tuesday of November {$this->year}", DateTimeZoneFactory::getDateTimeZone($this->timezone));

        $this->addHoliday(new Holiday('melbourneCup', ['en' => 'Melbourne Cup'], $date, $this->locale));
    }

    /**
     * AFL Grand Final Day.
     *
     * The Friday before the AFL Grand Final is a public holiday in Victoria. The date varies each year
     * depending on the AFL schedule.
     *
     * @throws \Exception
     */
    protected function calculateAFLGrandFinalDay(): void
    {
        $dates = [
            2015 => '2015-10-02',
            2016 => '2016-09-30',
            2017 => '2017-09-29',
            2018 => '2018-09-28',
            2019 => '2019-09-27',
            2020 => '2020-09-25',
            2021 => '2021-09-24',
            2022 => '2022-09-23',
            2023 => '2023-09-29',
            2024 => '2024-09-27',
            2025 => '2025-09-26',
        ];

        if (! isset($dates[$this->year])) {
            return;
        }

        $this->addHoliday(new Holiday(
            'aflGrandFinalFriday',
            ['en' => 'AFL Grand Final Friday'],
            new \DateTime($dates[$this->year], DateTimeZoneFactory::getDateTimeZone($this->timezone)),
            $this->locale
        ));
    }
}
