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
 * Provider for all holidays in Hungary.
 *
 * @author Aron Novak <aron@gizra.com>
 */
class Hungary extends AbstractProvider
{
    use CommonHolidays, ChristianHolidays;

    /**
     * Code to identify this Holiday Provider. Typically this is the ISO3166 code corresponding to the respective
     * country or sub-region.
     */
    const ID = 'HU';

    /**
     * Initialize holidays for Hungary.
     *
     * @throws \Yasumi\Exception\InvalidDateException
     * @throws \InvalidArgumentException
     * @throws \Yasumi\Exception\UnknownLocaleException
     * @throws \Exception
     */
    public function initialize()
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

        /**
         * Day of Memorial day of the 1848 Revolution
         */
        if ($this->year >= 1927) {
            $this->addHoliday(new Holiday('memorialDay1848', [
                'en_US' => 'Memorial day of the 1848 Revolution',
                'hu_HU' => 'Az 1848-as forradalom ünnepe',
            ], new DateTime("$this->year-3-15", new DateTimeZone($this->timezone)), $this->locale));
        }

        /**
         * State Foundation Day
         */
        if ($this->year >= 1891) {
            $this->addHoliday(new Holiday('stateFoundation', [
                'en_US' => 'State Foundation Day',
                'hu_HU' => 'Az államalapítás ünnepe',
            ], new DateTime("$this->year-8-20", new DateTimeZone($this->timezone)), $this->locale));
        }

        /**
         * Memorial day of the 1956 Revolution
         */
        if ($this->year >= 1991) {
            $this->addHoliday(new Holiday('memorialDay1956', [
                'en_US' => 'Memorial day of the 1956 Revolution',
                'hu_HU' => 'Az 1956-os forradalom ünnepe',
            ], new DateTime("$this->year-10-23", new DateTimeZone($this->timezone)), $this->locale));
        }
    }
}
