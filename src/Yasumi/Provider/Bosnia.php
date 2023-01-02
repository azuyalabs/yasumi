<?php

declare(strict_types=1);
/*
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 - 2023 AzuyaLabs
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
 * Provider for all holidays in Bosnia.
 *
 * @author Adnan Kičin <adnankicin92@gmail.com>
 */
class Bosnia extends AbstractProvider
{
    use CommonHolidays;
    use ChristianHolidays;

    /**
     * Code to identify this Holiday Provider. Typically, this is the ISO3166 code corresponding to the respective
     * country or sub-region.
     */
    public const ID = 'BA';

    /**
     * Initialize holidays for Bosnia.
     *
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    public function initialize(): void
    {
        $this->timezone = 'Europe/Sarajevo';

        // Add common holidays
        $this->addHoliday($this->newYearsDay($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->internationalWorkersDay($this->year, $this->timezone, $this->locale));

        // Add Catholic holidays
        $this->addHoliday($this->easter($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->allSaintsDay($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->christmasDay($this->year, $this->timezone, $this->locale));

        // Add Orthodox holidays

        $this->addHoliday(new Holiday('orthodoxChristmasDay', [
            'en' => 'Orthodox Christmas Day',
            'bs_Latn' => 'Pravoslavni Božić',
        ], new \DateTime("$this->year-01-07", DateTimeZoneFactory::getDateTimeZone($this->timezone))));

        /*
         * Independence Day
         */
        if ($this->year >= 1992) {
            $this->addHoliday(new Holiday('independenceDay', [
                'en' => 'Independence Day',
                'bs_Latn' => 'Dan Nezavisnosti',
            ], new \DateTime("$this->year-3-1", DateTimeZoneFactory::getDateTimeZone($this->timezone)), $this->locale));
        }

        /*
         * Bosnian Statehood Day
         */
        if ($this->year >= 1943) {
            $this->addHoliday(new Holiday('statehoodDay', [
                'en' => 'Statehood Day',
                'bs_Latn' => 'Dan državnosti',
            ], new \DateTime("$this->year-11-25", DateTimeZoneFactory::getDateTimeZone($this->timezone)), $this->locale));
        }

        /*
         * Day after New Years Day
         */
        $this->addHoliday(new Holiday('dayAfterNewYearsDay', [
            'en' => 'Day after New Year’s Day',
            'bs_Latn' => 'Nova godina - drugi dan',
        ], new \DateTime("$this->year-01-02", DateTimeZoneFactory::getDateTimeZone($this->timezone)), $this->locale));

        /*
         * Second Labour day
         */
        $this->addHoliday(new Holiday('secondLabourDay', [
            'en' => 'Second Labour Day',
            'bs_Latn' => 'Praznik rada - drugi dan',
        ], new \DateTime("$this->year-05-02", DateTimeZoneFactory::getDateTimeZone($this->timezone)), $this->locale));
    }

    public function getSources(): array
    {
        return [
            'https://en.wikipedia.org/wiki/Public_holidays_in_Bosnia_and_Herzegovina',
            'https://bs.wikipedia.org/wiki/Praznici_i_blagdani_u_Bosni_i_Hercegovini',
        ];
    }
}
