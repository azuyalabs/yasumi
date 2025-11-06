<?php

declare(strict_types = 1);

/**
 * This file is part of the 'Yasumi' package.
 *
 * The easy PHP Library for calculating holidays.
 *
 * Copyright (c) 2015 - 2025 AzuyaLabs
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
 * Provider for all holidays in Slovenia.
 */
class Slovenia extends AbstractProvider
{
    use CommonHolidays;
    use ChristianHolidays;

    /**
     * Code to identify this Holiday Provider. Typically, this is the ISO3166 code corresponding to the respective
     * country or sub-region.
     */
    public const ID = 'SI';

    /**
     * Initialize holidays for Slovenia.
     *
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    public function initialize(): void
    {
        $this->timezone = 'Europe/Ljubljana';

        // Add common holidays
        $this->addHoliday($this->newYearsDay($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->internationalWorkersDay($this->year, $this->timezone, $this->locale));

        // Add Christian holidays
        $this->addHoliday($this->easter($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->easterMonday($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->pentecost($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->assumptionOfMary($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->christmasDay($this->year, $this->timezone, $this->locale));

        // Add Slovenia-specific holidays
        $this->calculateSecondNewYearsDay();
        $this->calculatePreserenDay();
        $this->calculateUprisingAgainstOccupation();
        $this->calculateLabourDay();
        $this->calculateStatehoodDay();
        $this->calculateReformationDay();
        $this->calculateRemembranceDay();
        $this->calculateIndependenceDay();
    }

    public function getSources(): array
    {
        return [
            'https://en.wikipedia.org/wiki/Public_holidays_in_Slovenia',
            'https://www.gov.si/en/topics/public-holidays/',
        ];
    }

    /**
     * Second New Year's Day (January 2).
     *
     * @throws \Exception
     */
    protected function calculateSecondNewYearsDay(): void
    {
        $this->addHoliday(new Holiday('secondNewYearsDay', [
            'en' => 'Second New Year’s Day',
            'sl' => 'Novo leto (2. dan)',
        ], new \DateTime("{$this->year}-1-2", DateTimeZoneFactory::getDateTimeZone($this->timezone)), $this->locale));
    }

    /**
     * Prešeren Day, the Slovenian Cultural Holiday (February 8).
     * Established in 1945, became a work-free holiday in 1991.
     *
     * @throws \Exception
     */
    protected function calculatePreserenDay(): void
    {
        if ($this->year >= 1991) {
            $this->addHoliday(new Holiday('preserenDay', [
                'en' => 'Prešeren Day, Slovenian Cultural Holiday',
                'sl' => 'Prešernov dan, slovenski kulturni praznik',
            ], new \DateTime("{$this->year}-2-8", DateTimeZoneFactory::getDateTimeZone($this->timezone)), $this->locale));
        }
    }

    /**
     * Day of Uprising Against Occupation (April 27).
     * Commemorates the Slovenian resistance against the Axis occupation in 1941.
     *
     * @throws \Exception
     */
    protected function calculateUprisingAgainstOccupation(): void
    {
        if ($this->year >= 1945) {
            $this->addHoliday(new Holiday('uprisingAgainstOccupation', [
                'en' => 'Day of Uprising Against Occupation',
                'sl' => 'Dan upora proti okupatorju',
            ], new \DateTime("{$this->year}-4-27", DateTimeZoneFactory::getDateTimeZone($this->timezone)), $this->locale));
        }
    }

    /**
     * Labour Day (May 2).
     * Slovenia celebrates two consecutive Labour Days (May 1 and May 2).
     *
     * @throws \Exception
     */
    protected function calculateLabourDay(): void
    {
        $this->addHoliday(new Holiday('labourDay', [
            'en' => 'Labour Day',
            'sl' => 'Praznik dela (2. dan)',
        ], new \DateTime("{$this->year}-5-2", DateTimeZoneFactory::getDateTimeZone($this->timezone)), $this->locale));
    }

    /**
     * Statehood Day (June 25).
     * Commemorates Slovenia's declaration of independence from Yugoslavia in 1991.
     *
     * @throws \Exception
     */
    protected function calculateStatehoodDay(): void
    {
        if ($this->year >= 1991) {
            $this->addHoliday(new Holiday('statehoodDay', [
                'en' => 'Statehood Day',
                'sl' => 'Dan državnosti',
            ], new \DateTime("{$this->year}-6-25", DateTimeZoneFactory::getDateTimeZone($this->timezone)), $this->locale));
        }
    }

    /**
     * Reformation Day (October 31).
     * Added as a public holiday in 1992 to commemorate the Protestant Reformation.
     *
     * @throws \Exception
     */
    protected function calculateReformationDay(): void
    {
        if ($this->year >= 1992) {
            $this->addHoliday(new Holiday('reformationDay', [
                'en' => 'Reformation Day',
                'sl' => 'Dan reformacije',
            ], new \DateTime("{$this->year}-10-31", DateTimeZoneFactory::getDateTimeZone($this->timezone)), $this->locale));
        }
    }

    /**
     * Day of Remembrance for the Dead (November 1).
     * Slovenia's version of All Saints' Day.
     *
     * @throws \Exception
     */
    protected function calculateRemembranceDay(): void
    {
        $this->addHoliday(new Holiday('remembranceDay', [
            'en' => 'Day of Remembrance for the Dead',
            'sl' => 'Dan spomina na mrtve',
        ], new \DateTime("{$this->year}-11-1", DateTimeZoneFactory::getDateTimeZone($this->timezone)), $this->locale));
    }

    /**
     * Independence and Unity Day (December 26).
     * Commemorates the 1990 plebiscite results and the 1991 formal independence.
     *
     * @throws \Exception
     */
    protected function calculateIndependenceDay(): void
    {
        if ($this->year >= 1991) {
            $this->addHoliday(new Holiday('independenceDay', [
                'en' => 'Independence and Unity Day',
                'sl' => 'Dan samostojnosti in enotnosti',
            ], new \DateTime("{$this->year}-12-26", DateTimeZoneFactory::getDateTimeZone($this->timezone)), $this->locale));
        }
    }
}
