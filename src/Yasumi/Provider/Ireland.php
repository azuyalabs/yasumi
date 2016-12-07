<?php

/**
 *  This file is part of the Yasumi package.
 *
 *  Copyright (c) 2015 - 2016 AzuyaLabs
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <stelgenhof@gmail.com>
 */

namespace Yasumi\Provider;

use DateTime;
use DateTimeZone;
use Yasumi\Holiday;

/**
 * Provider for all holidays in Ireland.
 */
class Ireland extends AbstractProvider
{
    use CommonHolidays, ChristianHolidays;

    /**
     * Code to identify this Holiday Provider. Typically this is the ISO3166 code corresponding to the respective
     * country or sub-region.
     */
    const ID = 'IE';

    /**
     * Initialize holidays for Ireland.
     */
    public function initialize()
    {
        $this->timezone = 'Europe/Dublin';

        // Add common holidays
        $this->calculateNewYearsDay();

        // Add common Christian holidays (common in Ireland)
        //$this->addHoliday($this->epiphany($this->year, $this->timezone, $this->locale));
        //$this->addHoliday($this->assumptionOfMary($this->year, $this->timezone, $this->locale));
        // $this->addHoliday($this->easter($this->year, $this->timezone, $this->locale));
        //$this->addHoliday($this->easterMonday($this->year, $this->timezone, $this->locale));
        //$this->addHoliday($this->internationalWorkersDay($this->year, $this->timezone, $this->locale));
        //$this->addHoliday($this->ascensionDay($this->year, $this->timezone, $this->locale));
        //$this->addHoliday($this->pentecost($this->year, $this->timezone, $this->locale, Holiday::TYPE_OBSERVANCE));
        //$this->addHoliday($this->pentecostMonday($this->year, $this->timezone, $this->locale));
        //$this->addHoliday($this->corpusChristi($this->year, $this->timezone, $this->locale, Holiday::TYPE_NATIONAL));
        //$this->addHoliday($this->allSaintsDay($this->year, $this->timezone, $this->locale));
        //$this->addHoliday($this->immaculateConception($this->year, $this->timezone, $this->locale));
        //$this->addHoliday($this->christmasDay($this->year, $this->timezone, $this->locale));
        //$this->addHoliday($this->secondChristmasDay($this->year, $this->timezone, $this->locale));

        // Calculate other holidays
        $this->calculateStPatricksDay();
    }

    /**
     * New Years Day.
     *
     * New Year's Day was recognized as a church holiday in the Holidays (Employees) Act 1961 in the Republic of
     * Ireland. It became a public holiday following the Holidays (Employees) Act 1973. The public holiday was first
     * observed in 1974.
     *
     * @link http://www.timeanddate.com/holidays/ireland/new-year-day
     */
    public function calculateNewYearsDay()
    {
        if ($this->year < 1974) {
            return;
        }

        $this->addHoliday($this->newYearsDay($this->year, $this->timezone, $this->locale));
    }

    /**
     * St. Patrick's Day.
     *
     * New Year's Day was recognized as a church holiday in the Holidays (Employees) Act 1961 in the Republic of
     * Ireland. It became a public holiday following the Holidays (Employees) Act 1973. The public holiday was first
     * observed in 1974.
     *
     * @link http://www.timeanddate.com/holidays/ireland/new-year-day
     */
    public function calculateStPatricksDay()
    {
        if ($this->year < 1903) {
            return;
        }

        $this->addHoliday(new Holiday('stPatricksDay',
            ['en_IE' => 'St. Patrick\'s Day', 'ga_IE' => 'Lá Fhéile Pádraig'],
            new DateTime($this->year . '-3-17', new DateTimeZone($this->timezone)), $this->locale));
    }
}
