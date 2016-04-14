<?php
/**
 *  This file is part of the Yasumi package.
 *
 *  Copyright (c) 2015 - 2016 AzuyaLabs
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 *
 *  @author Sacha Telgenhof <stelgenhof@gmail.com>
 */

namespace Yasumi\Provider;

use DateTime;
use DateTimeZone;
use Yasumi\Holiday;

/**
 * Provider for all holidays in Belgium.
 */
class Belgium extends AbstractProvider
{
    use CommonHolidays, ChristianHolidays;

    /**
     * Initialize holidays for Belgium.
     */
    public function initialize()
    {
        $this->timezone = 'Europe/Brussels';

        // Add common holidays
        $this->addHoliday($this->newYearsDay($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->internationalWorkersDay($this->year, $this->timezone, $this->locale));

        // Add Christian holidays
        $this->addHoliday($this->easter($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->easterMonday($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->ascensionDay($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->pentecost($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->pentecostMonday($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->christmasDay($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->allSaintsDay($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->assumptionOfMary($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->armisticeDay($this->year, $this->timezone, $this->locale));

        /*
         * Belgian National Day.
         *
         * Belgian National Day is the National Day of Belgium celebrated on 21 July each year.
         */
        $this->addHoliday(new Holiday('nationalDay', [
            'fr_FR' => 'Fête nationale',
            'fr_BE' => 'Fête nationale',
            'en_US' => 'Belgian National Day',
            'nl_NL' => 'Nationale feestdag',
            'nl_BE' => 'Nationale feestdag',
        ], new DateTime("$this->year-7-21", new DateTimeZone($this->timezone)), $this->locale));
    }
}
