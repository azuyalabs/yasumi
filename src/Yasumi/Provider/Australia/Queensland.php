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
 * Provider for all holidays in Queensland (Australia).
 */
class Queensland extends Australia
{
    /**
     * Code to identify this Holiday Provider. Typically, this is the ISO3166 code corresponding to the respective
     * country or sub-region.
     */
    public const ID = 'AU-QLD';

    public string $timezone = 'Australia/Brisbane';

    /**
     * Initialize holidays for Queensland (Australia).
     *
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    public function initialize(): void
    {
        parent::initialize();

        $this->addHoliday($this->easterSaturday($this->year, $this->timezone, $this->locale));

        if ($this->year >= 2017) {
            $this->addHoliday($this->easterSunday($this->year, $this->timezone, $this->locale));
        }

        $this->calculateMonarchsBirthday();
        $this->calculateLabourDay();
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
     * Easter Sunday.
     *
     * Easter is a festival and holiday celebrating the resurrection of Jesus Christ from the dead. Easter is celebrated
     * on a date based on a certain number of days after March 21st. The date of Easter Day was defined by the Council
     * of Nicaea in AD325 as the Sunday after the first full moon which falls on or after the Spring Equinox.
     *
     * @see https://en.wikipedia.org/wiki/Easter
     * @see https://www.qld.gov.au/recreation/travel/holidays/public
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
        $birthDay = "first monday of october {$this->year}";

        if ($this->year < 2012 || 2013 === $this->year || 2014 === $this->year || 2015 === $this->year) {
            $birthDay = "second monday of june {$this->year}";
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
        $date = new \DateTime("first monday of may {$this->year}", DateTimeZoneFactory::getDateTimeZone($this->timezone));
        if (2013 === $this->year || 2014 === $this->year || 2015 === $this->year) {
            $date = new \DateTime("first monday of october {$this->year}", DateTimeZoneFactory::getDateTimeZone($this->timezone));
        }

        $this->addHoliday(new Holiday('labourDay', [], $date, $this->locale));
    }
}
