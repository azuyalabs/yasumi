<?php
/*
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Yasumi\Provider;

use ArrayIterator;
use Countable;
use InvalidArgumentException;
use IteratorAggregate;
use Yasumi\Holiday;
use Yasumi\ProviderInterface;
use Yasumi\Yasumi;

/**
 * Class AbstractProvider
 * @package Yasumi\Provider
 */
abstract class AbstractProvider implements ProviderInterface, Countable, IteratorAggregate
{
    /**
     * @var array list of dates of the available holidays
     */
    private $holidays = [];

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
     * Creates a new holiday provider (i.e. country/state).
     *
     * @param int    $year   the year for which to provide holidays
     * @param string $locale the locale/language in which holidays need to be represented
     */
    public function __construct($year, $locale = 'en-US')
    {
        $this->clearHolidays();

        $this->year   = $year ?: date('Y');
        $this->locale = $locale;

        $this->initialize();
    }

    /**
     * Clear all holidays
     *
     * @return void
     */
    protected function clearHolidays()
    {
        $this->holidays = [];
    }

    /**
     * Adds a holiday to the holidays providers (i.e. country/state) list of holidays.
     *
     * @param Holiday $holiday Holiday instance (representing a holiday) to be added to the internal list
     *                         of holidays of this country.
     *
     * @access   protected
     */
    public function addHoliday(Holiday $holiday)
    {
        $this->holidays[$holiday->shortName] = $holiday;
        uasort($this->holidays, ['Yasumi\Provider\AbstractProvider', 'compareDates']);
    }

    /**
     * Determines whether a date represents a holiday or not.
     *
     * @param mixed $date a timestamp, string or PEAR::Date object
     *
     * @return boolean true if date represents a holiday, otherwise false
     */
    public function isHoliday($date)
    {
        if ( ! is_null($date) && in_array($date->timezone($this->timezone)->startOfDay(), $this->holidays)) {
            return true;
        }

        return false;
    }

    /**
     * On what date is the given holiday?
     *
     * @param string $shortName short name of the holiday
     *
     * @throws InvalidArgumentException when the given name is blank or empty.
     * @return string the date of the requested holiday
     */
    public function whenIs($shortName)
    {
        // Validate if short name is not empty
        if (empty($shortName) || is_null($shortName)) {
            throw new InvalidArgumentException('Holiday name can not be blank.');
        }

        return (string) $this->holidays[$shortName];
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
     * @return int the index of the weekdays of the requested holiday (0 = Sunday, 1 = Monday, etc.)
     */
    public function whatWeekDayIs($shortName)
    {
        // Validate if short name is not empty
        if (empty($shortName) || is_null($shortName)) {
            throw new InvalidArgumentException('Holiday name can not be blank.');
        }

        return (int) $this->holidays[$shortName]->dayOfWeek;
    }

    /**
     * Returns the number of defined holidays (for the given country and the given year)
     *
     * @return int number of holidays
     */
    public function count()
    {
        return (int) count($this->getHolidays());
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
     * Gets all of the holiday dates defined by this holiday provider (for the given year).
     *
     * @return array list of all holiday dates defined for the given year
     */
    public function getHolidayDates()
    {
        return array_map(function ($holiday) {
            return (string) $holiday;
        }, $this->holidays);
    }

    /**
     * Gets all of the holidays defined by this holiday provider (for the given year).
     *
     * @return array list of all holidays defined for the given year
     */
    public function getHolidays()
    {
        return $this->holidays;
    }

    /**
     * Retrieves the holiday object for the given holiday.
     *
     * @param $shortName string the name of the holiday.
     *
     * @throws InvalidArgumentException when the given name is blank or empty.
     * @return \Yasumi\Holiday a Holiday instance for the given holiday
     */
    public function getHoliday($shortName)
    {
        // Validate if short name is not empty
        if (empty($shortName) || is_null($shortName)) {
            throw new InvalidArgumentException('Holiday name can not be blank.');
        }

        $holidays = $this->getHolidays();

        return (isset($holidays[$shortName])) ? $holidays[$shortName] : null;
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

    /**
     * Returns the current year set for this Holiday calendar
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
     * @return \Yasumi\Holiday a Holiday instance for the given holiday
     *
     * @covers AbstractProvider::anotherTime
     */
    public function next($shortName)
    {
        return $this->anotherTime($this->year + 1, $shortName);
    }

    /**
     * Retrieves the previous date (year) the given holiday took place.
     *
     * @param $shortName string the name of the holiday for which the previous occurrence need to be retrieved.
     *
     * @return \Yasumi\Holiday a Holiday instance for the given holiday
     *
     * @covers AbstractProvider::anotherTime
     */
    public function previous($shortName)
    {
        return $this->anotherTime($this->year - 1, $shortName);
    }

    /**
     * Determines the date of the given holiday for another year
     *
     * @param int    $year      the year to get the holiday date for
     * @param string $shortName the name of the holiday for which the date needs to be fetched
     *
     * @throws InvalidArgumentException when the given name is blank or empty.
     * @return \Yasumi\Holiday a Holiday instance for the given holiday and year
     */
    private function anotherTime($year, $shortName)
    {
        // Validate if short name is not empty
        if (empty($shortName) || is_null($shortName)) {
            throw new InvalidArgumentException('Holiday name can not be blank.');
        }

        // Get calling class name
        $hReflectionClass = new \ReflectionClass(get_class($this));

        return Yasumi::create($hReflectionClass->getShortName(), $year, $this->locale)->getHoliday($shortName);
    }

    /**
     * Internal function to compare dates in order to sort them chronologically.
     *
     * @param $dateA \Carbon\Carbon First date
     * @param $dateB \Carbon\Carbon Second date
     *
     * @return int result where 0 means dates are equal, -1 the first date is before the second date, and 1 if the
     *             second date is after the first.
     */
    private static function compareDates($dateA, $dateB)
    {
        if ($dateA->eq($dateB)) {
            return 0;
        }

        return ($dateA->lt($dateB)) ? - 1 : 1;
    }
}
