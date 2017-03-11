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

use ArrayIterator;
use Countable;
use DateTime;
use InvalidArgumentException;
use IteratorAggregate;
use Yasumi\Filters\BetweenFilter;
use Yasumi\Holiday;
use Yasumi\ProviderInterface;
use Yasumi\TranslationsInterface;
use Yasumi\Yasumi;

/**
 * Class AbstractProvider.
 */
abstract class AbstractProvider implements ProviderInterface, Countable, IteratorAggregate
{
    /**
     * @var int the object's current year
     */
    protected $year;

    /**
     * @var string the object's current timezone
     */
    protected $timezone;

    /**
     * @var string the object's current locale
     */
    protected $locale;

    /**
     * @var array list of the days of the week (the index of the weekdays) that are considered weekend days. Defaults
     *            to Sunday (0) and Saturday (6), as this is globally the common standard. (0 = Sunday, 1 = Monday,
     *            etc.)
     */
    protected $weekend_days = [0, 6];

    /**
     * @var Holiday[] list of dates of the available holidays
     */
    private $holidays = [];

    /**
     * @var TranslationsInterface global translations
     */
    private $globalTranslations;

    /**
     * Creates a new holiday provider (i.e. country/state).
     *
     * @param int                   $year               the year for which to provide holidays
     * @param string                $locale             the locale/language in which holidays need to be represented
     * @param TranslationsInterface $globalTranslations global translations
     */
    public function __construct($year, $locale = 'en_US', TranslationsInterface $globalTranslations = null)
    {
        $this->clearHolidays();

        $this->year               = $year ?: date('Y');
        $this->locale             = $locale;
        $this->globalTranslations = $globalTranslations;

        $this->initialize();
    }

    /**
     * Clear all holidays.
     */
    protected function clearHolidays()
    {
        $this->holidays = [];
    }

    /**
     * Internal function to compare dates in order to sort them chronologically.
     *
     * @param $dateA DateTime First date
     * @param $dateB DateTime Second date
     *
     * @return int result where 0 means dates are equal, -1 the first date is before the second date, and 1 if the
     *             second date is after the first.
     */
    private static function compareDates(DateTime $dateA, DateTime $dateB)
    {
        if ($dateA == $dateB) {
            return 0;
        }

        return ($dateA < $dateB) ? -1 : 1;
    }

    /**
     * Adds a holiday to the holidays providers (i.e. country/state) list of holidays.
     *
     * @param Holiday $holiday Holiday instance (representing a holiday) to be added to the internal list
     *                         of holidays of this country.
     */
    public function addHoliday(Holiday $holiday)
    {
        if ($this->globalTranslations !== null) {
            $holiday->mergeGlobalTranslations($this->globalTranslations);
        }

        $this->holidays[$holiday->shortName] = $holiday;
        uasort($this->holidays, [AbstractProvider::class, 'compareDates']);
    }

    /**
     * Determines whether a date represents a working day or not.
     *
     * A working day is defined as a day that is not a holiday nor falls in the weekend. The index of the weekdays of
     * the defined date is used for establishing this (0 = Sunday, 1 = Monday, etc.)
     *
     * @param mixed $date a Yasumi\Holiday or DateTime object
     *
     * @return bool true if date represents a working day, otherwise false
     */
    public function isWorkingDay($date)
    {
        // Check if date is a holiday
        if ($this->isHoliday($date)) {
            return false;
        }

        // If given date is a DateTime object; check if it falls in the weekend
        if ($date instanceof DateTime) {
            if (in_array((int)$date->format('w'), $this->weekend_days, true)) {
                return false;
            }
        }

        return true;
    }

    /**
     * Determines whether a date represents a holiday or not.
     *
     * @param mixed $date a Yasumi\Holiday or DateTime object
     *
     * @return bool true if date represents a holiday, otherwise false
     */
    public function isHoliday($date)
    {
        // Return false if given date is empty
        if (null === $date) {
            return false;
        }

        // If given date is a DateTime object
        if ($date instanceof DateTime && in_array($date->format('Y-m-d'), array_values($this->getHolidayDates()))) {
            return true;
        }

        return false;
    }

    /**
     * Gets all of the holiday dates defined by this holiday provider (for the given year).
     *
     * @return array list of all holiday dates defined for the given year
     */
    public function getHolidayDates()
    {
        return array_map(function ($holiday) {
            return (string)$holiday;
        }, $this->holidays);
    }

    /**
     * On what date is the given holiday?
     *
     * @param string $shortName short name of the holiday
     *
     * @throws InvalidArgumentException when the given name is blank or empty.
     *
     * @return string the date of the requested holiday
     */
    public function whenIs($shortName)
    {
        $this->isHolidayNameNotEmpty($shortName); // Validate if short name is not empty

        return (string)$this->holidays[$shortName];
    }

    /**
     * Checks whether the given holiday (short name) is not empty.
     *
     * @param $shortName string the name of the holiday to be checked.
     *
     * @throws InvalidArgumentException An InvalidArgumentException is thrown if the given holiday parameter is empty.
     *
     * @return true upon success, otherwise an InvalidArgumentException is thrown
     */
    protected function isHolidayNameNotEmpty($shortName)
    {
        if (empty($shortName) || null === $shortName) {
            throw new InvalidArgumentException('Holiday name can not be blank.');
        }

        return true;
    }

    /**
     * On what day of the week is the given holiday?
     *
     * This function returns the index number for the day of the week on which the given holiday falls.
     * The index number is an integer starting with 0 being Sunday, 1 = Monday, etc.
     *
     * @param string $shortName short name of the holiday
     *
     * @throws InvalidArgumentException when the given name is blank or empty.
     *
     * @return int the index of the weekdays of the requested holiday (0 = Sunday, 1 = Monday, etc.)
     */
    public function whatWeekDayIs($shortName)
    {
        $this->isHolidayNameNotEmpty($shortName); // Validate if short name is not empty

        return (int)$this->holidays[$shortName]->format('w');
    }

    /**
     * Returns the number of defined holidays (for the given country and the given year).
     *
     * @return int number of holidays
     */
    public function count()
    {
        return (int)count($this->getHolidays());
    }

    /**
     * Gets all of the holidays defined by this holiday provider (for the given year).
     *
     * @return Holiday[] list of all holidays defined for the given year
     */
    public function getHolidays()
    {
        return $this->holidays;
    }

    /**
     * Gets all of the holiday names defined by this holiday provider (for the given year).
     *
     * @return array list of all holiday names defined for the given year
     */
    public function getHolidayNames()
    {
        return array_keys($this->holidays);
    }

    /**
     * Returns the current year set for this Holiday calendar.
     *
     * @return int the year set for this Holiday calendar
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * Retrieves the next date (year) the given holiday is going to take place.
     *
     * @param $shortName string the name of the holiday for which the next occurrence need to be retrieved.
     *
     * @return Holiday a Holiday instance for the given holiday
     *
     * @throws \Yasumi\Exception\UnknownLocaleException
     * @throws \RuntimeException
     * @throws \InvalidArgumentException
     *
     * @covers AbstractProvider::anotherTime
     */
    public function next($shortName)
    {
        return $this->anotherTime($this->year + 1, $shortName);
    }

    /**
     * Determines the date of the given holiday for another year.
     *
     * @param int    $year      the year to get the holiday date for
     * @param string $shortName the name of the holiday for which the date needs to be fetched
     *
     * @return Holiday a Holiday instance for the given holiday and year
     *
     * @throws InvalidArgumentException when the given name is blank or empty.
     * @throws \Yasumi\Exception\UnknownLocaleException
     * @throws \RuntimeException
     */
    private function anotherTime($year, $shortName)
    {
        $this->isHolidayNameNotEmpty($shortName); // Validate if short name is not empty

        // Get calling class name
        $hReflectionClass = new \ReflectionClass(get_class($this));

        return Yasumi::create($hReflectionClass->getShortName(), $year, $this->locale)->getHoliday($shortName);
    }

    /**
     * Retrieves the holiday object for the given holiday.
     *
     * @param $shortName string the name of the holiday.
     *
     * @throws InvalidArgumentException when the given name is blank or empty.
     *
     * @return Holiday a Holiday instance for the given holiday
     */
    public function getHoliday($shortName)
    {
        $this->isHolidayNameNotEmpty($shortName); // Validate if short name is not empty

        $holidays = $this->getHolidays();

        return isset($holidays[$shortName]) ? $holidays[$shortName] : null;
    }

    /**
     * Retrieves the previous date (year) the given holiday took place.
     *
     * @param $shortName string the name of the holiday for which the previous occurrence need to be retrieved.
     *
     * @return Holiday a Holiday instance for the given holiday
     *
     * @throws \Yasumi\Exception\UnknownLocaleException
     * @throws \RuntimeException
     * @throws \InvalidArgumentException
     *
     * @covers AbstractProvider::anotherTime
     */
    public function previous($shortName)
    {
        return $this->anotherTime($this->year - 1, $shortName);
    }

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
     * @param \DateTime $start_date Start date of the time frame to check against
     * @param \DateTime $end_date   End date of the time frame to check against
     * @param bool      $equals     indicate whether the start and end dates should be included in the comparison
     *
     * @throws InvalidArgumentException An InvalidArgumentException is thrown if the start date is set after the end
     *                                  date.
     *
     * @return \Yasumi\Filters\BetweenFilter
     */
    public function between(DateTime $start_date, DateTime $end_date = null, $equals = true)
    {
        if ($start_date > $end_date) {
            throw new InvalidArgumentException('Start date must be a date before the end date.');
        }

        return new BetweenFilter($this->getIterator(), $start_date, $end_date, $equals);
    }

    /**
     * Get an iterator for the holidays.
     *
     * @return ArrayIterator iterator for the holidays of this calendar
     */
    public function getIterator()
    {
        return new ArrayIterator($this->getHolidays());
    }
}
