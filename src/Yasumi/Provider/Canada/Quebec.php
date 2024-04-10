<?php

declare(strict_types = 1);

/**
 * This file is part of the 'Yasumi' package.
 *
 * The easy PHP Library for calculating holidays.
 *
 * Copyright (c) 2015 - 2024 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <me at sachatelgenhof dot com>
 */

namespace Yasumi\Provider\Canada;

use Yasumi\Exception\UnknownLocaleException;
use Yasumi\Holiday;
use Yasumi\Provider\Canada;
use Yasumi\Provider\DateTimeZoneFactory;

/**
 * Provider for all holidays in Quebec (Canada).
 *
 * Quebec is a province of Canada.
 *
 * @see https://en.wikipedia.org/wiki/Quebec
 */
class Quebec extends Canada
{
    /**
     * Code to identify this Holiday Provider. Typically, this is the ISO3166 code corresponding to the respective
     * country or sub-region.
     */
    public const ID = 'CA-QC';

    /**
     * Initialize holidays for Quebec (Canada).
     *
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    public function initialize(): void
    {
        parent::initialize();

        $this->timezone = 'America/Toronto';

        $this->addHoliday($this->saintJeanBaptisteDay($this->year, $this->timezone, $this->locale));
        $this->calculateNationalPatriotsDay();
    }

    /**
     * Saint-Jean-Baptiste Day.
     *
     * The Nativity of John the Baptist (or Birth of John the Baptist, or Nativity of the Forerunner) is a Christian
     * feast day celebrating the birth of John the Baptist, a prophet who foretold the coming of the Messiah in the
     * person of Jesus, whom he later baptised. The Nativity of John the Baptist on June 24 comes three months after the
     * celebration on March 25 of the Annunciation, when the angel Gabriel told Mary that her cousin Elizabeth was in
     * her sixth month of pregnancy.
     *
     * @see https://en.wikipedia.org/wiki/Saint-Jean-Baptiste_Day
     *
     * @param int    $year     the year for which St. John's Day need to be created
     * @param string $timezone the timezone in which St. John's Day is celebrated
     * @param string $locale   the locale for which St. John's Day need to be displayed in.
     * @param string $type     The type of holiday. Use the following constants: TYPE_OFFICIAL, TYPE_OBSERVANCE,
     *                         TYPE_SEASON, TYPE_BANK or TYPE_OTHER. By default an official holiday is considered.
     *
     * @throws UnknownLocaleException
     * @throws \InvalidArgumentException
     * @throws \Exception
     */
    protected function saintJeanBaptisteDay(
        int $year,
        string $timezone,
        string $locale,
        string $type = Holiday::TYPE_OFFICIAL
    ): Holiday {
        return new Holiday(
            'saintJeanBaptisteDay',
            [],
            new \DateTime("{$year}-06-24", DateTimeZoneFactory::getDateTimeZone($timezone)),
            $locale,
            $type
        );
    }

    /**
     * National Patriot's Day.
     *
     * @see https://en.wikipedia.org/wiki/National_Patriots%27_Day
     *
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    protected function calculateNationalPatriotsDay(): void
    {
        if ($this->year < 2003) {
            return;
        }

        $this->addHoliday(new Holiday(
            'nationalPatriotsDay',
            [],
            new \DateTime("last monday front of {$this->year}-05-25", DateTimeZoneFactory::getDateTimeZone($this->timezone)),
            $this->locale
        ));
    }
}
