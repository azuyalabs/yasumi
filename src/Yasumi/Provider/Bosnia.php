<?php
/**
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 - 2018 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <stelgenhof@gmail.com>
 */

namespace Yasumi\Provider;

use DateTime;
use DateTimeZone;
use Yasumi\Holiday;

/**
 * Provider for all holidays in Bosnia.
 *
 * @author Adnan Kičin <adnankicin92@gmail.com>
 */
class Bosnia extends AbstractProvider
{
    use CommonHolidays, ChristianHolidays;

    /**
     * Code to identify this Holiday Provider. Typically this is the ISO3166 code corresponding to the respective
     * country or sub-region.
     */
    const ID = 'BA';

    /**
     * Initialize holidays for Bosnia.
     *
     * @throws \Yasumi\Exception\InvalidDateException
     * @throws \InvalidArgumentException
     * @throws \Yasumi\Exception\UnknownLocaleException
     * @throws \Exception
     */
    public function initialize()
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
            'en_US' => 'Orthodox Christmas Day',
            'bs_Latn_BA' => 'Pravoslavni Božić'
        ], new \DateTime("{$this->year}-01-07", new \DateTimeZone($this->timezone))));


        /**
         * Independence Day
         */
        if ($this->year >= 1992) {
            $this->addHoliday(new Holiday('independenceDay', [
                'en_US' => 'Independence Day',
                'bs_Latn_BA' => 'Dan Nezavisnosti'
            ], new DateTime("$this->year-3-1", new DateTimeZone($this->timezone)), $this->locale));
        }

        /**
         * Bosnian Statehood Day
         */
        if ($this->year >= 1943) {
            $this->addHoliday(new Holiday('statehoodDay', [
                'en_US' => 'Statehood Day',
                'bs_Latn_BA' => 'Dan državnosti'
            ], new DateTime("$this->year-11-25", new DateTimeZone($this->timezone)), $this->locale));
        }

        /**
         * Day after New Years Day
         */
        $this->addHoliday(new Holiday('dayAfterNewYearsDay', [
            'en_US' => 'Day after New Year\'s Day',
            'ro_RO' => 'Nova godina - drugi dan'
        ], new DateTime("$this->year-01-02", new DateTimeZone($this->timezone)), $this->locale));

        /**
         * Second Labour day
         */
        $this->addHoliday(new Holiday('secondLabourDay', [
            'en_US' => 'Second Labour Day',
            'ro_RO' => 'Praznik rada - drugi dan'
        ], new DateTime("$this->year-05-02", new DateTimeZone($this->timezone)), $this->locale));
    }
}
