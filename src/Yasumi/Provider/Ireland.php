<?php

/**
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 - 2017 AzuyaLabs
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
     *
     * @throws \InvalidArgumentException
     * @throws \Yasumi\Exception\UnknownLocaleException
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
        $this->calculateChristmasDay();
        $this->calculateStStephensDay();

        // Calculate other holidays
        $this->calculateStPatricksDay();
        $this->calculateMayDay();
        $this->calculateJuneHoliday();
        $this->addHoliday(new Holiday('augustHoliday',
            ['en_IE' => 'August Holiday', 'ga_IE' => 'Lá Saoire i mí Lúnasa'],
            new DateTime("next monday $this->year-7-31", new DateTimeZone($this->timezone)), $this->locale));
        $this->calculateOctoberHoliday();
    }

    /**
     * New Years Day.
     *
     * New Year's Day was recognized as a church holiday in the Holidays (Employees) Act 1961 in the Republic of
     * Ireland. It became a public holiday following the Holidays (Employees) Act 1973. The public holiday was first
     * observed in 1974.
     *
     * @link http://www.timeanddate.com/holidays/ireland/new-year-day
     * @link http://www.irishstatutebook.ie/eli/1974/si/341
     *
     * @TODO : Check substitution of New Years Day when it falls on a Saturday. The Holidays (Employees) Act 1973
     *       states that New Years Day is substituted the *next* day if it does not fall on a weekday. So what if it
     *       falls on a Saturday?
     *
     * @throws \InvalidArgumentException
     * @throws \Yasumi\Exception\UnknownLocaleException
     */
    public function calculateNewYearsDay()
    {
        if ($this->year < 1974) {
            return;
        }

        $holiday = $this->newYearsDay($this->year, $this->timezone, $this->locale);
        $this->addHoliday($holiday);

        // Substitute holiday is on the next available weekday if a holiday falls on a Sunday.
        if (0 === (int) $holiday->format('w')) {
            $substituteHoliday = clone $holiday;
            $substituteHoliday->modify('next monday');

            $this->addHoliday(new Holiday('substituteHoliday:' . $substituteHoliday->shortName, [
                'en_IE' => $substituteHoliday->getName() . ' observed',
            ], $substituteHoliday, $this->locale));
        }
    }

    /**
     * Pentecost Monday.
     *
     * Whitmonday (Pentecost Monday) was considered a public holiday in Ireland until 1973.
     *
     * @link http://www.irishstatutebook.ie/eli/1939/act/1/section/8/enacted/en/html
     * @link http://www.irishstatutebook.ie/eli/1973/act/25/schedule/1/enacted/en/html#sched1
     *
     * @throws \InvalidArgumentException
     * @throws \Yasumi\Exception\UnknownLocaleException
     */
    public function calculatePentecostMonday()
    {
        if ($this->year > 1973) {
            return;
        }

        $this->addHoliday($this->pentecostMonday($this->year, $this->timezone, $this->locale));
    }

    /**
     * Christmas Day.
     *
     * Most people in Ireland start Christmas celebrations on Christmas Eve (Oíche Nollag), including taking time
     * off work.
     *
     * @link http://www.irishstatutebook.ie/eli/1973/act/25/schedule/1/enacted/en/html#sched1
     *
     * @throws \InvalidArgumentException
     * @throws \Yasumi\Exception\UnknownLocaleException
     */
    public function calculateChristmasDay()
    {
        $holiday = new Holiday('christmasDay', ['en_IE' => 'Christmas Day', 'ga_IE' => 'Lá Nollag'],
            new DateTime($this->year . '-12-25', new DateTimeZone($this->timezone)), $this->locale);

        $this->addHoliday($holiday);

        // Whenever Christmas Day does not fall on a weekday, the Tuesday following on it shall be a public holiday.
        if (in_array((int) $holiday->format('w'), [0, 6], true)) {
            $substituteHoliday = clone $holiday;
            $substituteHoliday->modify('next tuesday');

            $this->addHoliday(new Holiday('substituteHoliday:' . $substituteHoliday->shortName, [
                'en_IE' => $substituteHoliday->getName() . ' observed',
            ], $substituteHoliday, $this->locale));
        }
    }

    /**
     * St. Stephens Day.
     *
     * The day after Christmas celebrating the feast day of Saint Stephen.
     *
     * @link http://www.irishstatutebook.ie/eli/1973/act/25/schedule/1/enacted/en/html#sched1
     * @link https://en.wikipedia.org/wiki/St._Stephen%27s_Day
     * @see  ChristianHolidays
     *
     * @throws \InvalidArgumentException
     * @throws \Yasumi\Exception\UnknownLocaleException
     */
    public function calculateStStephensDay()
    {
        $holiday = new Holiday('stStephensDay', [],
            new DateTime($this->year . '-12-26', new DateTimeZone($this->timezone)), $this->locale);

        $this->addHoliday($holiday);

        // Whenever St. Stephens Day does not fall on a weekday, the Monday following on it shall be a public holiday.
        if (in_array((int) $holiday->format('w'), [0, 6], true)) {
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
     *
     * @throws \InvalidArgumentException
     * @throws \Yasumi\Exception\UnknownLocaleException
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
        if (in_array((int) $holiday->format('w'), [0, 6], true)) {
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
     *
     * @throws \InvalidArgumentException
     * @throws \Yasumi\Exception\UnknownLocaleException
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
     * June Holiday.
     *
     * The first Monday in June is considered a public holiday since 1974. Previously observed as Whit Monday until
     * 1973.
     *
     * @link http://www.irishstatutebook.ie/eli/1961/act/33/section/8/enacted/en/html
     *
     * @throws \InvalidArgumentException
     * @throws \Yasumi\Exception\UnknownLocaleException
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

    /**
     * October Holiday.
     *
     * The last Monday in October is considered a public holiday since 1977.
     *
     * @link http://www.irishstatutebook.ie/eli/1973/act/25/schedule/1/enacted/en/html#sched1
     *
     * @throws \InvalidArgumentException
     * @throws \Yasumi\Exception\UnknownLocaleException
     */
    public function calculateOctoberHoliday()
    {
        if ($this->year < 1977) {
            return;
        }

        $this->addHoliday(new Holiday('octoberHoliday',
            ['en_IE' => 'October Holiday', 'ga_IE' => 'Lá Saoire i mí Dheireadh Fómhair'],
            new DateTime("previous monday $this->year-11-01", new DateTimeZone($this->timezone)), $this->locale));
    }
}
