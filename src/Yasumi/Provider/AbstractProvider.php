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

use ArrayIterator;
use Countable;
use DateTime;
use InvalidArgumentException;
use IteratorAggregate;
use Yasumi\Holiday;
use Yasumi\ProviderInterface;
use Yasumi\TranslationsInterface;
use Yasumi\Yasumi;

/**
 * Class AbstractProvider
 * @package Yasumi\Provider
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
     * Clear all holidays
     *
     * @return void
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
    private static function compareDates($dateA, $dateB)
    {
        if ($dateA == $dateB) {
            return 0;
        }

        return ($dateA < $dateB) ? - 1 : 1;
    }

    /**
     * Adds a holiday to the holidays providers (i.e. country/state) list of holidays.
     *
     * @param Holiday $holiday Holiday instance (representing a holiday) to be added to the internal list
     *                         of holidays of this country.
     *
     */
    public function addHoliday(Holiday $holiday)
    {
        if ($this->globalTranslations !== null) {
            $holiday->mergeGlobalTranslations($this->globalTranslations);
        }

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
        if ( ! is_null($date) && in_array($date, $this->holidays)) {
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
        $this->isHolidayNameNotEmpty($shortName); // Validate if short name is not empty

        return (string) $this->holidays[$shortName];
    }

    /**
     * Checks whether the given holiday (short name) is not empty.
     *
     * @param $shortName string the name of the holiday to be checked.
     *
     * @throws InvalidArgumentException An InvalidArgumentException is thrown if the given holiday parameter is empty.
     * @return true upon success, otherwise an InvalidArgumentException is thrown
     */
    protected function isHolidayNameNotEmpty($shortName)
    {
        if (empty($shortName) || is_null($shortName)) {
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
     * @return int the index of the weekdays of the requested holiday (0 = Sunday, 1 = Monday, etc.)
     */
    public function whatWeekDayIs($shortName)
    {
        $this->isHolidayNameNotEmpty($shortName); // Validate if short name is not empty

        return (int) $this->holidays[$shortName]->format('w');
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
     * @return Holiday a Holiday instance for the given holiday
     *
     * @covers AbstractProvider::anotherTime
     */
    public function next($shortName)
    {
        return $this->anotherTime($this->year + 1, $shortName);
    }

    /**
     * Determines the date of the given holiday for another year
     *
     * @param int    $year      the year to get the holiday date for
     * @param string $shortName the name of the holiday for which the date needs to be fetched
     *
     * @throws InvalidArgumentException when the given name is blank or empty.
     * @return Holiday a Holiday instance for the given holiday and year
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
     * @return Holiday a Holiday instance for the given holiday
     */
    public function getHoliday($shortName)
    {
        $this->isHolidayNameNotEmpty($shortName); // Validate if short name is not empty

        $holidays = $this->getHolidays();

        return (isset($holidays[$shortName])) ? $holidays[$shortName] : null;
    }

    /**
     * Retrieves the previous date (year) the given holiday took place.
     *
     * @param $shortName string the name of the holiday for which the previous occurrence need to be retrieved.
     *
     * @return Holiday a Holiday instance for the given holiday
     *
     * @covers AbstractProvider::anotherTime
     */
    public function previous($shortName)
    {
        return $this->anotherTime($this->year - 1, $shortName);
    }
}
