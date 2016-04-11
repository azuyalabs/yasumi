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
 * Provider for all holidays in Poland.
 */
class Poland extends AbstractProvider
{
    use CommonHolidays, ChristianHolidays;

    /**
     * Initialize holidays for Poland.
     */
    public function initialize()
    {
        $this->timezone = 'Europe/Warsaw';

        // Add common holidays
        $this->addHoliday($this->newYearsDay($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->internationalWorkersDay($this->year, $this->timezone, $this->locale));

        // Add Christian holidays
        $this->addHoliday($this->allSaintsDay($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->assumptionOfMary($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->christmasDay($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->corpusChristi($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->easter($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->easterMonday($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->epiphany($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->pentecost($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->secondChristmasDay($this->year, $this->timezone, $this->locale));

        // Add other holidays
        $this->calculateIndependenceDay();
        $this->calculateConstitutionDay();
    }

    /*
     * Constitution Day
     *
     * @link https://en.wikipedia.org/wiki/May_3rd_Constitution_Day
     */
    public function calculateConstitutionDay()
    {
        if ($this->year >= 1791) {
            $this->addHoliday(new Holiday('constitutionDay', ['pl_PL' => 'Święto Narodowe Trzeciego Maja'],
                new DateTime("$this->year-5-3", new DateTimeZone($this->timezone)), $this->locale));
        }
    }

    /*
     * Independence Day
     *
     * @link https://en.wikipedia.org/wiki/National_Independence_Day_(Poland)
     */
    public function calculateIndependenceDay()
    {
        if ($this->year >= 1918) {
            $this->addHoliday(new Holiday('independenceDay', ['pl_PL' => 'Narodowe Święto Niepodległości'],
                new DateTime("$this->year-11-11", new DateTimeZone($this->timezone)), $this->locale));
        }
    }
}
