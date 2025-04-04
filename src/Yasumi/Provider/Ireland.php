<?php

declare(strict_types = 1);

/**
 * This file is part of the 'Yasumi' package.
 *
 * The easy PHP Library for calculating holidays.
 *
 * Copyright (c) 2015 - 2025 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <me at sachatelgenhof dot com>
 */

namespace Yasumi\Provider;

use Yasumi\Exception\UnknownLocaleException;
use Yasumi\Holiday;
use Yasumi\SubstituteHoliday;

/**
 * Provider for all holidays in Ireland.
 *
 * The public holidays of Ireland are defined in the Organisation of Working Time Act, 1993,
 * or in statutory instruments issued pursuant on this act.
 *
 * @see https://www.irishstatutebook.ie/eli/1997/act/20
 */
class Ireland extends AbstractProvider
{
    use CommonHolidays;
    use ChristianHolidays;

    /**
     * Code to identify this Holiday Provider. Typically, this is the ISO3166 code corresponding to the respective
     * country or sub-region.
     */
    public const ID = 'IE';

    /**
     * Initialize holidays for Ireland.
     *
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    public function initialize(): void
    {
        $this->timezone = 'Europe/Dublin';

        // Add common holidays
        $this->calculateNewYearsDay();
        $this->calculateStBrigidsDay();

        // Add common Christian holidays (common in Ireland)
        $this->addHoliday($this->goodFriday($this->year, $this->timezone, $this->locale, Holiday::TYPE_OBSERVANCE));
        $this->addHoliday($this->easter($this->year, $this->timezone, $this->locale, Holiday::TYPE_OBSERVANCE));
        $this->addHoliday($this->easterMonday($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->pentecost($this->year, $this->timezone, $this->locale, Holiday::TYPE_OBSERVANCE));
        $this->calculatePentecostMonday();
        $this->calculateChristmasDay();
        $this->calculateStStephensDay();

        // Calculate other holidays
        $this->calculateStPatricksDay();
        $this->calculateMayDay();
        $this->calculateJuneHoliday();
        $this->addHoliday(new Holiday(
            'augustHoliday',
            ['en' => 'August Holiday', 'ga' => 'Lá Saoire i mí Lúnasa'],
            new \DateTime("next monday {$this->year}-7-31", DateTimeZoneFactory::getDateTimeZone($this->timezone)),
            $this->locale
        ));
        $this->calculateOctoberHoliday();
    }

    public function getSources(): array
    {
        return [
            'https://en.wikipedia.org/wiki/Public_holidays_in_Ireland',
            'https://www.irishstatutebook.ie/eli/1997/act/20/schedule/2/enacted/en/html',
            'https://www.irishstatutebook.ie/eli/2022/si/50/made/en/html',
        ];
    }

    /**
     * New Years Day.
     *
     * New Year's Day was recognized as a church holiday in the Holidays (Employees) Act 1961 in the Republic of
     * Ireland. It became a public holiday following the Holidays (Employees) Act 1973. The public holiday was first
     * observed in 1974.
     *
     * @see https://www.timeanddate.com/holidays/ireland/new-year-day
     * @see https://www.irishstatutebook.ie/eli/1997/act/20/schedule/2/enacted/en/html
     *
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    protected function calculateNewYearsDay(): void
    {
        if ($this->year < 1974) {
            return;
        }

        $holiday = $this->newYearsDay($this->year, $this->timezone, $this->locale);
        $this->addHoliday($holiday);

        // Substitute holiday is on the next available weekday if a holiday falls on a weekend.
        if (\in_array((int) $holiday->format('w'), [0, 6], true)) {
            $date = clone $holiday;
            $date->modify('next monday');

            $this->addHoliday(new SubstituteHoliday(
                $holiday,
                [],
                $date,
                $this->locale
            ));
        }
    }

    /**
     * Saint Brigid's Day.
     *
     * Saint Brigid's Day, also known as Imbolc, is a Gaelic traditional festival. It became an official public
     * holiday in 2023.
     *
     * @see https://www.irishstatutebook.ie/eli/2022/si/50/made/en/html
     * @see https://en.wikipedia.org/wiki/Imbolc
     */
    protected function calculateStBrigidsDay(): void
    {
        if ($this->year < 2023) {
            return;
        }

        $dateTime = new \DateTime("{$this->year}-02-01", DateTimeZoneFactory::getDateTimeZone($this->timezone));
        if (5 !== (int) $dateTime->format('w')) {
            $dateTime->modify('next monday');
        }

        $this->addHoliday(new Holiday(
            'stBrigidsDay',
            ['en' => 'Saint Brigid’s Day', 'ga' => 'Lá Fhéile Bríde'],
            $dateTime,
            $this->locale
        ));
    }

    /**
     * Pentecost Monday.
     *
     * Whitmonday (Pentecost Monday) was considered a public holiday in Ireland until 1973.
     *
     * @see https://www.irishstatutebook.ie/eli/1939/act/1/section/8/enacted/en/html
     * @see https://www.irishstatutebook.ie/eli/1997/act/20/schedule/2/enacted/en/html
     *
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    protected function calculatePentecostMonday(): void
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
     * @see https://www.irishstatutebook.ie/eli/1997/act/20/schedule/2/enacted/en/html
     *
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    protected function calculateChristmasDay(): void
    {
        $holiday = new Holiday(
            'christmasDay',
            ['en' => 'Christmas Day', 'ga' => 'Lá Nollag'],
            new \DateTime("{$this->year}-12-25", DateTimeZoneFactory::getDateTimeZone($this->timezone)),
            $this->locale
        );

        $this->addHoliday($holiday);

        // Whenever Christmas Day does not fall on a weekday, the Tuesday following on it shall be a public holiday.
        if (\in_array((int) $holiday->format('w'), [0, 6], true)) {
            $date = clone $holiday;
            $date->modify('next tuesday');

            $this->addHoliday(new SubstituteHoliday(
                $holiday,
                [],
                $date,
                $this->locale
            ));
        }
    }

    /**
     * St. Stephens Day.
     *
     * The day after Christmas celebrating the feast day of Saint Stephen.
     *
     * @see https://www.irishstatutebook.ie/eli/1997/act/20/schedule/2/enacted/en/html
     * @see https://en.wikipedia.org/wiki/St._Stephen%27s_Day
     * @see  ChristianHolidays
     *
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    protected function calculateStStephensDay(): void
    {
        $holiday = new Holiday(
            'stStephensDay',
            [],
            new \DateTime("{$this->year}-12-26", DateTimeZoneFactory::getDateTimeZone($this->timezone)),
            $this->locale
        );

        $this->addHoliday($holiday);

        // Whenever St. Stephens Day does not fall on a weekday, the Monday following on it shall be a public holiday.
        if (\in_array((int) $holiday->format('w'), [0, 6], true)) {
            $date = clone $holiday;
            $date->modify('next monday');

            $this->addHoliday(new SubstituteHoliday(
                $holiday,
                [],
                $date,
                $this->locale
            ));
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
     * @see https://en.wikipedia.org/wiki/Saint_Patrick%27s_Day
     * @see https://www.irishstatutebook.ie/eli/1997/act/20/schedule/2/enacted/en/html
     *
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    protected function calculateStPatricksDay(): void
    {
        if ($this->year < 1903) {
            return;
        }
        $holiday = new Holiday(
            'stPatricksDay',
            ['en' => 'St. Patrick’s Day', 'ga' => 'Lá Fhéile Pádraig'],
            new \DateTime("{$this->year}-3-17", DateTimeZoneFactory::getDateTimeZone($this->timezone)),
            $this->locale
        );

        $this->addHoliday($holiday);

        // Substitute holiday is on the next available weekday if a holiday falls on a Saturday or Sunday
        if (\in_array((int) $holiday->format('w'), [0, 6], true)) {
            $date = clone $holiday;
            $date->modify('next monday');

            $this->addHoliday(new SubstituteHoliday(
                $holiday,
                [],
                $date,
                $this->locale
            ));
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
     * @see https://en.wikipedia.org/wiki/May_Day
     * @see https://www.irishstatutebook.ie/eli/1993/si/91/made/en/html
     *
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    protected function calculateMayDay(): void
    {
        if ($this->year < 1994) {
            return;
        }

        $this->addHoliday(new Holiday(
            'mayDay',
            ['en' => 'May Day', 'ga' => 'Lá Bealtaine'],
            new \DateTime("next monday {$this->year}-4-30", DateTimeZoneFactory::getDateTimeZone($this->timezone)),
            $this->locale
        ));
    }

    /**
     * June Holiday.
     *
     * The first Monday in June is considered a public holiday since 1974. Previously observed as Whit Monday until
     * 1973.
     *
     * @see http://www.irishstatutebook.ie/eli/1961/act/33/section/8/enacted/en/html
     *
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    protected function calculateJuneHoliday(): void
    {
        if ($this->year < 1974) {
            return;
        }

        $this->addHoliday(new Holiday(
            'juneHoliday',
            ['en' => 'June Holiday', 'ga' => 'Lá Saoire i mí an Mheithimh'],
            new \DateTime("next monday {$this->year}-5-31", DateTimeZoneFactory::getDateTimeZone($this->timezone)),
            $this->locale
        ));
    }

    /**
     * October Holiday.
     *
     * The last Monday in October is considered a public holiday since 1977.
     *
     * @see https://www.irishstatutebook.ie/eli/1977/si/193/made/en/html
     * @see https://www.irishstatutebook.ie/eli/1997/act/20/schedule/2/enacted/en/html
     *
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    protected function calculateOctoberHoliday(): void
    {
        if ($this->year < 1977) {
            return;
        }

        $this->addHoliday(new Holiday(
            'octoberHoliday',
            ['en' => 'October Holiday', 'ga' => 'Lá Saoire i mí Dheireadh Fómhair'],
            new \DateTime("previous monday {$this->year}-11-01", DateTimeZoneFactory::getDateTimeZone($this->timezone)),
            $this->locale
        ));
    }
}
