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
 * Provider for all holidays in Croatia.
 *
 * @author Karlo Mikus <contact@karlomikus.com>
 */
class Croatia extends AbstractProvider
{
    use CommonHolidays, ChristianHolidays;

    /**
     * Code to identify this Holiday Provider. Typically this is the ISO3166 code corresponding to the respective
     * country or sub-region.
     */
    const ID = 'HR';

    /**
     * Initialize holidays for Croatia.
     *
     * @throws \Yasumi\Exception\InvalidDateException
     * @throws \InvalidArgumentException
     * @throws \Yasumi\Exception\UnknownLocaleException
     * @throws \Exception
     */
    public function initialize()
    {
        $this->timezone = 'Europe/Zagreb';

        // Add common holidays
        $this->addHoliday($this->newYearsDay($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->internationalWorkersDay($this->year, $this->timezone, $this->locale));

        // Add Christian holidays
        $this->addHoliday($this->epiphany($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->easter($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->easterMonday($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->corpusChristi($this->year, $this->timezone, $this->locale, Holiday::TYPE_OFFICIAL));
        $this->addHoliday($this->assumptionOfMary($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->allSaintsDay($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->christmasDay($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->stStephensDay($this->year, $this->timezone, $this->locale));

        /**
         * Day of Antifascist Struggle
         */
        if ($this->year >= 1941) {
            $this->addHoliday(new Holiday('antifascistStruggleDay', [
                'en_US' => 'Day of Antifascist Struggle',
                'hr_HR' => 'Dan antifašističke borbe'
            ], new DateTime("$this->year-6-22", new DateTimeZone($this->timezone)), $this->locale));
        }

        /**
         * Croatian Statehood Day
         */
        if ($this->year >= 1991) {
            $this->addHoliday(new Holiday('statehoodDay', [
                'en_US' => 'Statehood Day',
                'hr_HR' => 'Dan državnosti'
            ], new DateTime("$this->year-6-25", new DateTimeZone($this->timezone)), $this->locale));
        }

        /**
         * Homeland Thanksgiving Day
         */
        if ($this->year >= 1995) {
            $this->addHoliday(new Holiday('homelandThanksgiving', [
                'en_US' => 'Homeland Thanksgiving Day',
                'hr_HR' => 'Dan domovinske zahvalnosti'
            ], new DateTime("$this->year-8-5", new DateTimeZone($this->timezone)), $this->locale));
        }

        /**
         * Independence Day
         */
        if ($this->year >= 1991) {
            $this->addHoliday(new Holiday('independenceDay', [
                'en_US' => 'Independence Day',
                'hr_HR' => 'Dan neovisnosti'
            ], new DateTime("$this->year-10-8", new DateTimeZone($this->timezone)), $this->locale));
        }
    }
}
