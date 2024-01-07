<?php

declare(strict_types=1);

/*
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 - 2024 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <me at sachatelgenhof dot com>
 */

namespace Yasumi;

use Yasumi\Exception\UnknownLocaleException;
use Yasumi\Filters\BetweenFilter;
use Yasumi\Filters\OnFilter;

/**
 * Interface ProviderInterface - Holiday provider interface.
 *
 * This interface class defines the standard functions that any country provider needs to define.
 *
 * @see     AbstractProvider
 */
interface ProviderInterface extends \Countable
{
    /** Initialize country holidays */
    public function initialize(): void;

    /**
     * Returns a list of sources (i.e. references to websites, books, scientific papers, etc.) that are
     * used for determining the calculation logic of the providers' holidays.
     *
     * @return array<string> a list of external sources (empty when no sources are defined)
     */
    public function getSources(): array;

    /**
     * Returns the current year set for this Holiday calendar.
     *
     * @return int the year set for this Holiday calendar
     */
    public function getYear(): int;

    /**
     * Determines whether a date represents a working day or not.
     *
     * A working day is defined as a day that is not a holiday nor falls in the weekend. The index of the weekdays of
     * the defined date is used for establishing this (0 = Sunday, 1 = Monday, etc.)
     *
     * @param \DateTimeInterface $date any date object that implements the DateTimeInterface (e.g. Yasumi\Holiday,
     *                                 \DateTime)
     *
     * @return bool true if date represents a working day, otherwise false
     */
    public function isWorkingDay(\DateTimeInterface $date): bool;

    /**
     * Retrieves the holiday object for the given holiday.
     *
     * @param string $key the name of the holiday
     *
     * @return Holiday|null a Holiday instance for the given holiday
     *
     * @throws \InvalidArgumentException when the given name is blank or empty
     */
    public function getHoliday(string $key): ?Holiday;

    /**
     * Gets all the holidays defined by this holiday provider (for the given year).
     *
     * @return Holiday[] list of all holidays defined for the given year
     */
    public function getHolidays(): array;

    /**
     * Determines whether a date represents a holiday or not.
     *
     * @param \DateTimeInterface $date any date object that implements the DateTimeInterface (e.g. Yasumi\Holiday,
     *                                 \DateTime)
     *
     * @return bool true if date represents a holiday, otherwise false
     */
    public function isHoliday(\DateTimeInterface $date): bool;

    /**
     * Get an iterator for the holidays.
     *
     * @return \ArrayIterator iterator for the holidays of this calendar
     */
    public function getIterator(): \ArrayIterator;

    /**
     * Adds a holiday to the holidays providers (i.e. country/state) list of holidays.
     *
     * @param Holiday $holiday holiday instance (representing a holiday) to be added to the internal list
     *                         of holidays of this country
     */
    public function addHoliday(Holiday $holiday): void;

    /**
     * Removes a holiday from the holidays providers (i.e. country/state) list of holidays.
     *
     * This function can be helpful in cases where an existing holiday provider class can be extended but some holidays
     * are not part of the original (extended) provider.
     *
     * @param string $key holiday key
     */
    public function removeHoliday(string $key): void;

    /**
     * Determines whether a date represents a weekend day or not.
     *
     * @param \DateTimeInterface $date any date object that implements the DateTimeInterface (e.g. Yasumi\Holiday,
     *                                 \DateTime)
     *
     * @return bool true if date represents a weekend day, otherwise false
     */
    public function isWeekendDay(\DateTimeInterface $date): bool;

    /**
     * On what date is the given holiday?
     *
     * @param string $key holiday key
     *
     * @return string the date of the requested holiday
     *
     * @throws \InvalidArgumentException when the given name is blank or empty
     */
    public function whenIs(string $key): string;

    /**
     * On what day of the week is the given holiday?
     *
     * This function returns the index number for the day of the week on which the given holiday falls.
     * The index number is an integer starting with 0 being Sunday, 1 = Monday, etc.
     *
     * @param string $key key of the holiday
     *
     * @return int the index of the weekdays of the requested holiday (0 = Sunday, 1 = Monday, etc.)
     *
     * @throws \InvalidArgumentException when the given name is blank or empty
     */
    public function whatWeekDayIs(string $key): int;

    /**
     * Gets all the holiday names defined by this holiday provider (for the given year).
     *
     * @return array<string>|array<int> list of all holiday names defined for the given year
     */
    public function getHolidayNames(): array;

    /**
     * Retrieves the next date (year) the given holiday is going to take place.
     *
     * @param string $key key of the holiday for which the next occurrence need to be retrieved
     *
     * @return Holiday|null a Holiday instance for the given holiday
     *
     * @throws UnknownLocaleException
     * @throws \RuntimeException
     * @throws \InvalidArgumentException
     *
     * @covers AbstractProvider::anotherTime
     */
    public function next(string $key): ?Holiday;

    /**
     * Retrieves the previous date (year) the given holiday took place.
     *
     * @param string $key key of the holiday for which the previous occurrence need to be retrieved
     *
     * @return Holiday|null a Holiday instance for the given holiday
     *
     * @throws UnknownLocaleException
     * @throws \RuntimeException
     * @throws \InvalidArgumentException
     *
     * @covers AbstractProvider::anotherTime
     */
    public function previous(string $key): ?Holiday;

    /**
     * Retrieves a list of all holidays between the given start and end date.
     *
     * Yasumi only calculates holidays for a single year, so a start date or end date beyond the given year will only
     * return holidays for the given year. For example, holidays calculated for the year 2016, will only return 2016
     * holidays if the provided period is for example 01/01/2012 - 31/12/2017.
     *
     * Please take care to use the appropriate timezone for the start and end date parameters. In case you use
     * different
     * timezone for these parameters versus the instantiated Holiday Provider, the outcome might be unexpected (but
     * correct).
     *
     * @param \DateTimeInterface $startDate Start date of the time frame to check against
     * @param \DateTimeInterface $endDate   End date of the time frame to check against
     * @param ?bool              $equals    indicate whether the start and end dates should be included in the
     *                                      comparison
     *
     * @throws \InvalidArgumentException an InvalidArgumentException is thrown if the start date is set after the end
     *                                   date
     */
    public function between(
        \DateTimeInterface $startDate,
        \DateTimeInterface $endDate,
        ?bool $equals = null
    ): BetweenFilter;

    /**
     * Retrieves a list of all holidays that happen on the given date.
     *
     * Yasumi only calculates holidays for a single year, so a date outside the given year will not appear to
     * contain any holidays.
     *
     * Please take care to use the appropriate timezone for the date parameters. If there is a different timezone used
     * for these parameters versus the instantiated Holiday Provider, the outcome might be unexpected (but correct).
     *
     * @param \DateTimeInterface $date date to check for holidays on
     */
    public function on(\DateTimeInterface $date): OnFilter;

    /**
     * Gets all the holiday dates defined by this holiday provider (for the given year).
     *
     * @return array<string> list of all holiday dates defined for the given year
     */
    public function getHolidayDates(): array;
}
