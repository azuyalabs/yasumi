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

use DateTime;
use Yasumi\Exception\InvalidDateException;
use Yasumi\Exception\UnknownLocaleException;
use Yasumi\Holiday;

/**
 * Provider for all holidays in Hungary.
 *
 * @author Aron Novak <aron@gizra.com>
 */
class Hungary extends AbstractProvider
{
    use CommonHolidays;
    use ChristianHolidays;

    /**
     * Code to identify this Holiday Provider. Typically, this is the ISO3166 code corresponding to the respective
     * country or sub-region.
     */
    public const ID = 'HU';

    /**
     * Initialize holidays for Hungary.
     *
     * @throws InvalidDateException
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    public function initialize(): void
    {
        $this->timezone = 'Europe/Budapest';

        // Add common holidays
        $this->addHoliday($this->newYearsDay($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->internationalWorkersDay($this->year, $this->timezone, $this->locale));

        // Add Christian holidays
        if ($this->year >= 2017) {
            $this->addHoliday($this->goodFriday($this->year, $this->timezone, $this->locale));
        }
        $this->addHoliday($this->easter($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->easterMonday($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->pentecost($this->year, $this->timezone, $this->locale, Holiday::TYPE_OBSERVANCE));
        $this->addHoliday($this->pentecostMonday($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->allSaintsDay($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->christmasDay($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->secondChristmasDay($this->year, $this->timezone, $this->locale));

        /*
         * Day of Memorial day of the 1848 Revolution
         */
        if ($this->year >= 1927) {
            $this->addHoliday(new Holiday('memorialDay1848', [
                'en' => 'Memorial day of the 1848 Revolution',
                'hu' => 'Az 1848-as forradalom ünnepe',
            ], new DateTime("$this->year-3-15", DateTimeZoneFactory::getDateTimeZone($this->timezone)), $this->locale));
        }

        /*
         * State Foundation Day
         */
        if ($this->year >= 1891) {
            $this->addHoliday(new Holiday('stateFoundation', [
                'en' => 'State Foundation Day',
                'hu' => 'Az államalapítás ünnepe',
            ], new DateTime("$this->year-8-20", DateTimeZoneFactory::getDateTimeZone($this->timezone)), $this->locale));
        }

        /*
         * Memorial day of the 1956 Revolution
         */
        if ($this->year >= 1991) {
            $this->addHoliday(new Holiday('memorialDay1956', [
                'en' => 'Memorial day of the 1956 Revolution',
                'hu' => 'Az 1956-os forradalom ünnepe',
            ], new DateTime("$this->year-10-23", DateTimeZoneFactory::getDateTimeZone($this->timezone)), $this->locale));
        }
    }

    public function getSources(): array
    {
        return [
            'https://en.wikipedia.org/wiki/Public_holidays_in_Hungary',
            'https://hu.wikipedia.org/wiki/Magyarorsz%C3%A1gi_%C3%BCnnepek_%C3%A9s_eml%C3%A9knapok_list%C3%A1ja',
        ];
    }
}
