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
 *
 * Note: All calculations are based on the schedule published in the Holidays (Employees) Act, 1973 and its amendments
 * thereafter.
 *
 * @link: http://www.irishstatutebook.ie/eli/1973/act/25/schedule/1/enacted/en/html#sched1
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
        $this->addHoliday($this->easterMonday($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->pentecost($this->year, $this->timezone, $this->locale, Holiday::TYPE_OBSERVANCE));
        $this->calculatePentecostMonday();
        //$this->addHoliday($this->epiphany($this->year, $this->timezone, $this->locale));
        //$this->addHoliday($this->assumptionOfMary($this->year, $this->timezone, $this->locale));
        //$this->addHoliday($this->internationalWorkersDay($this->year, $this->timezone, $this->locale));
        //$this->addHoliday($this->ascensionDay($this->year, $this->timezone, $this->locale));

        //$this->addHoliday($this->corpusChristi($this->year, $this->timezone, $this->locale, Holiday::TYPE_NATIONAL));
        //$this->addHoliday($this->allSaintsDay($this->year, $this->timezone, $this->locale));
        //$this->addHoliday($this->immaculateConception($this->year, $this->timezone, $this->locale));
        //$this->addHoliday($this->christmasDay($this->year, $this->timezone, $this->locale));
        //$this->addHoliday($this->secondChristmasDay($this->year, $this->timezone, $this->locale));

        // Calculate other holidays
        $this->calculateStPatricksDay();
        $this->calculateMayDay();
        $this->calculateJuneHoliday();
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

        $holiday = $this->newYearsDay($this->year, $this->timezone, $this->locale);
        $this->addHoliday($holiday);

        // Substitute holiday is on the next available weekday if a holiday falls on a Saturday or Sunday
        if (in_array($holiday->format('w'), [0, 6])) {
            $substituteHoliday = clone $holiday;
            $substituteHoliday->modify('next monday');

            $this->addHoliday(new Holiday('substituteHoliday:' . $substituteHoliday->shortName, [
                'en_IE' => $substituteHoliday->getName() . ' observed',
            ], $substituteHoliday, $this->locale));
        }
    }

    /**
     * St. Patrick's Day.
     *
     * Saint Patrick's Day, or the Feast of Saint Patrick (Irish: Lá Fhéile Pádraig, "the Day of the Festival of
     * Patrick"), is a cultural and religious celebration held on 17 March, the traditional death date of Saint Patrick
     * (c. AD 385–461), the foremost patron saint of Ireland. Saint Patrick's Day is a public holiday in the Republic
     * of Ireland, Northern Ireland, the Canadian province of Newfoundland and Labrador, and the British Overseas
     * Territory of Montserrat.
     *
     * @link https://en.wikipedia.org/wiki/Saint_Patrick%27s_Day
     */
    public function calculateStPatricksDay()
    {
        if ($this->year < 1903) {
            return;
        }
        $holiday = new Holiday('stPatricksDay', ['en_IE' => 'St. Patrick\'s Day', 'ga_IE' => 'Lá Fhéile Pádraig'],
            new DateTime($this->year . '-3-17', new DateTimeZone($this->timezone)), $this->locale);

        $this->addHoliday($holiday);

        // Substitute holiday is on the next available weekday if a holiday falls on a Saturday or Sunday
        if (in_array($holiday->format('w'), [0, 6])) {
            $substituteHoliday = clone $holiday;
            $substituteHoliday->modify('next monday');

            $this->addHoliday(new Holiday('substituteHoliday:' . $substituteHoliday->shortName, [
                'en_IE' => $substituteHoliday->getName() . ' observed',
            ], $substituteHoliday, $this->locale));
        }
    }

    /**
     * May Day.
     *
     * May Day has been celebrated in Ireland since pagan times as the feast of Beltane and in latter times as
     * Mary's day. Traditionally, bonfires were lit to mark the coming of summer and to banish the long nights of
     * winter. Officially Irish May Day holiday is the first Monday in May. Old traditions such as bonfires are no
     * longer widely observed, though the practice still persists in some places across the country. Limerick, Clare
     * and many other people in other counties still keep on this tradition.
     *
     * @link https://en.wikipedia.org/wiki/May_Day
     */
    public function calculateMayDay()
    {
        if ($this->year < 1994) {
            return;
        }

        $this->addHoliday(new Holiday('mayDay', ['en_IE' => 'May Day', 'ga_IE' => 'Lá Bealtaine'],
            new DateTime("next monday $this->year-4-30", new DateTimeZone($this->timezone)), $this->locale));
    }

    /**
     * Pentecost Monday.
     *
     * Whitmonday (Pentecost Monday) was considered a public holiday in Ireland until 1973.
     *
     * @link http://www.irishstatutebook.ie/eli/1939/act/1/section/8/enacted/en/html
     * @link http://www.irishstatutebook.ie/eli/1973/act/25/schedule/1/enacted/en/html#sched1
     */
    public function calculatePentecostMonday()
    {
        if ($this->year > 1973) {
            return;
        }

        $this->addHoliday($this->pentecostMonday($this->year, $this->timezone, $this->locale));
    }

    /**
     * June Holiday.
     *
     * The first Monday in June is considered a public holiday since 1974. Previously observed as Whit Monday until
     * 1973.
     *
     * @link http://www.irishstatutebook.ie/eli/1961/act/33/section/8/enacted/en/html
     */
    public function calculateJuneHoliday()
    {
        if ($this->year < 1974) {
            return;
        }

        $this->addHoliday(new Holiday('juneHoliday',
            ['en_IE' => 'June Holiday', 'ga_IE' => 'Lá Saoire i mí an Mheithimh'],
            new DateTime("next monday $this->year-5-31", new DateTimeZone($this->timezone)), $this->locale));
    }
}
