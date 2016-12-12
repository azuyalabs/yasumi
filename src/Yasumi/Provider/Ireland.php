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

use DateInterval;
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
        $this->addHoliday($this->goodFriday($this->year, $this->timezone, $this->locale, Holiday::TYPE_OBSERVANCE));
        $this->addHoliday($this->easter($this->year, $this->timezone, $this->locale));

        //$this->addHoliday($this->epiphany($this->year, $this->timezone, $this->locale));
        //$this->addHoliday($this->assumptionOfMary($this->year, $this->timezone, $this->locale));
        //
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


        // var_dump($this->goodFriday($this->year, $this->timezone, $this->locale, Holiday::TYPE_OBSERVANCE));

        // Calculate other holidays
        $this->calculateStPatricksDay();

        // Determine whether any of the holidays is substituted on another day
        $this->calculateSubstituteHolidays();
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

    /**
     * Calculate substitute holidays.
     *
     * Where a public holiday falls on a Saturday or a Sunday, or possibly coincides with another public holiday, it
     * is generally observed (as a day off work) on the next available weekday, even though the public holiday itself
     * does not move.
     *
     * @TODO: Implement calculation when an holiday coincides with another.
     */
    private function calculateSubstituteHolidays()
    {
        $datesIterator = $this->getIterator();

        // Loop through all defined holidays
        while ($datesIterator->valid()) {

            // Substitute holiday is on the next available weekday if a holiday falls on a Saturday or Sunday
            if (in_array($datesIterator->current()->format('w'), [0, 6])) {
                $substituteHoliday = clone $datesIterator->current();
                $substituteHoliday->add(new DateInterval('P1D'));

                $this->addHoliday(new Holiday('substituteHoliday:' . $substituteHoliday->shortName, [
                    'en_IE' => $substituteHoliday->getName() . ' observed',
                ], $substituteHoliday, $this->locale));
            }

            $datesIterator->next();
        }
    }
}
