<?php declare(strict_types=1);
/**
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 - 2020 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <me@sachatelgenhof.com>
 */

namespace Yasumi\Provider;

use ArrayIterator;
use Countable;
use InvalidArgumentException;
use IteratorAggregate;
use Yasumi\Exception\InvalidDateException;
use Yasumi\Exception\UnknownLocaleException;
use Yasumi\Filters\BetweenFilter;
use Yasumi\Filters\OnFilter;
use Yasumi\Holiday;
use Yasumi\ProviderInterface;
use Yasumi\SubstituteHoliday;
use Yasumi\TranslationsInterface;
use Yasumi\Yasumi;

/**
 * Class AbstractProvider.
 */
abstract class AbstractProvider implements ProviderInterface, Countable, IteratorAggregate
{
    /**
     * Code to identify the Holiday Provider. Typically this is the ISO3166 code corresponding to the respective
     * country or sub-region.
     */
    public const ID = 'US';

    /**
     * @var array list of the days of the week (the index of the weekdays) that are considered weekend days.
     *            This list only concerns those countries that deviate from the global common definition,
     *            where the weekend starts on Saturday and ends on Sunday (0 = Sunday, 1 = Monday, etc.).
     */
    public const WEEKEND_DATA = [

        // Thursday and Friday
        'AF' => [4, 5], // Afghanistan

        // Friday and Saturday
        'AE' => [5, 6], // United Arab Emirates
        'BH' => [5, 6], // Bahrain
        'DZ' => [5, 6], // Algeria
        'EG' => [5, 6], // Egypt
        'IL' => [5, 6], // Israel
        'IQ' => [5, 6], // Iraq
        'JO' => [5, 6], // Jordan
        'KW' => [5, 6], // Kuwait
        'LY' => [5, 6], // Libya
        'MA' => [5, 6], // Morocco
        'OM' => [5, 6], // Oman
        'QA' => [5, 6], // Qatar
        'SA' => [5, 6], // Saudi Arabia
        'SD' => [5, 6], // Sudan
        'SY' => [5, 6], // Syrian Arab Republic (Syria)
        'TN' => [5, 6], // Tunisia
        'YE' => [5, 6], // Yemen

        // Friday
        'IR' => [5], // Iran, Islamic Republic of

        // Sunday
        'IN' => [0], // India
    ];

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
     * @var TranslationsInterface|null global translations
     */
    private $globalTranslations;

    /**
     * Creates a new holiday provider (i.e. country/state).
     *
     * @param int $year the year for which to provide holidays
     * @param string $locale |null the locale/language in which holidays need to be
     *                                                       represented
     * @param TranslationsInterface|null $globalTranslations global translations
     */
    public function __construct(
        int $year,
        ?string $locale = null,
        ?TranslationsInterface $globalTranslations = null
    ) {
        $this->clearHolidays();

        $this->year = $year ?: \getdate()['year'];
        $this->locale = $locale ?? 'en_US';
        $this->globalTranslations = $globalTranslations;

        $this->initialize();
    }

    /**
     * Clear all holidays.
     */
    protected function clearHolidays(): void
    {
        $this->holidays = [];
    }

    /**
     * Internal function to compare dates in order to sort them chronologically.
     *
     * @param \DateTimeInterface $dateA First date
     * @param \DateTimeInterface $dateB Second date
     *
     * @return int result where 0 means dates are equal, -1 the first date is before the second date, and 1 if the
     *             second date is after the first.
     */
    private static function compareDates(\DateTimeInterface $dateA, \DateTimeInterface $dateB): int
    {
        if ($dateA === $dateB) {
            return 0;
        }

        return $dateA < $dateB ? -1 : 1;
    }

    /**
     * Adds a holiday to the holidays providers (i.e. country/state) list of holidays.
     *
     * @param Holiday $holiday Holiday instance (representing a holiday) to be added to the internal list
     *                         of holidays of this country.
     */
    public function addHoliday(Holiday $holiday): void
    {
        if ($this->globalTranslations instanceof TranslationsInterface) {
            $holiday->mergeGlobalTranslations($this->globalTranslations);
        }

        $this->holidays[$holiday->shortName] = $holiday;
        \uasort($this->holidays, [__CLASS__, 'compareDates']);
    }


    /**
     * Removes a holiday from the holidays providers (i.e. country/state) list of holidays.
     *
     * This function can be helpful in cases where an existing holiday provider class can be extended but some holidays
     * are not part of the original (extended) provider.
     *
     * @param string $shortName short name of the holiday
     *
     * @return void
     */
    public function removeHoliday(string $shortName): void
    {
        unset($this->holidays[$shortName]);
    }

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
     * @throws InvalidDateException
     *
     */
    public function isWorkingDay(\DateTimeInterface $date): bool
    {
        $isWorkingDay = true;

        // First check if the given date is a holiday
        if ($this->isHoliday($date)) {
            $isWorkingDay = false;
        }

        // Check if given date is a falls in the weekend or not
        // If no data is defined for this Holiday Provider, the function falls back to the global weekend definition.
        // @TODO Ideally avoid late static binding here (static::ID)
        $weekendData = self::WEEKEND_DATA;
        $weekendDays = $weekendData[$this::ID] ?? [0, 6];

        if (\in_array((int)$date->format('w'), $weekendDays, true)) {
            $isWorkingDay = false;
        }

        return $isWorkingDay;
    }

    /**
     * Determines whether a date represents a holiday or not.
     *
     * @param \DateTimeInterface $date any date object that implements the DateTimeInterface (e.g. Yasumi\Holiday,
     *                                 \DateTime)
     *
     * @return bool true if date represents a holiday, otherwise false
     * @throws InvalidDateException
     *
     */
    public function isHoliday(\DateTimeInterface $date): bool
    {
        // Check if given date is a holiday or not
        if (\in_array($date->format('Y-m-d'), \array_values($this->getHolidayDates()), true)) {
            return true;
        }

        return false;
    }

    /**
     * Gets all of the holiday dates defined by this holiday provider (for the given year).
     *
     * @return array list of all holiday dates defined for the given year
     */
    public function getHolidayDates(): array
    {
        return \array_map(static function ($holiday) {
            return (string)$holiday;
        }, $this->holidays);
    }

    /**
     * On what date is the given holiday?
     *
     * @param string $shortName short name of the holiday
     *
     * @return string the date of the requested holiday
     * @throws InvalidArgumentException when the given name is blank or empty.
     *
     */
    public function whenIs(string $shortName): string
    {
        $this->isHolidayNameNotEmpty($shortName); // Validate if short name is not empty

        return (string)$this->holidays[$shortName];
    }

    /**
     * Checks whether the given holiday (short name) is not empty.
     *
     * @param string $shortName the name of the holiday to be checked.
     *
     * @return true upon success, otherwise an InvalidArgumentException is thrown
     * @throws InvalidArgumentException An InvalidArgumentException is thrown if the given holiday parameter is empty.
     */
    protected function isHolidayNameNotEmpty(string $shortName): bool
    {
        if (empty($shortName)) {
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
     * @return int the index of the weekdays of the requested holiday (0 = Sunday, 1 = Monday, etc.)
     * @throws InvalidArgumentException when the given name is blank or empty.
     *
     */
    public function whatWeekDayIs(string $shortName): int
    {
        $this->isHolidayNameNotEmpty($shortName); // Validate if short name is not empty

        return (int)$this->holidays[$shortName]->format('w');
    }

    /**
     * Returns the number of defined holidays (for the given country and the given year).
     * In case a holiday is substituted (e.g. observed), the holiday is only counted once.
     *
     * @return int number of holidays
     */
    public function count(): int
    {
        $names = \array_map(static function (&$holiday) {
            if ($holiday instanceof SubstituteHoliday) {
                return $holiday->substitutedHoliday->shortName;
            }

            return $holiday->shortName;
        }, $this->getHolidays());

        return \count(\array_unique($names));
    }

    /**
     * Gets all of the holidays defined by this holiday provider (for the given year).
     *
     * @return Holiday[] list of all holidays defined for the given year
     */
    public function getHolidays(): array
    {
        return $this->holidays;
    }

    /**
     * Gets all of the holiday names defined by this holiday provider (for the given year).
     *
     * @return array list of all holiday names defined for the given year
     */
    public function getHolidayNames(): array
    {
        return \array_keys($this->holidays);
    }

    /**
     * Returns the current year set for this Holiday calendar.
     *
     * @return int the year set for this Holiday calendar
     */
    public function getYear(): int
    {
        return $this->year;
    }

    /**
     * Retrieves the next date (year) the given holiday is going to take place.
     *
     * @param string $shortName the name of the holiday for which the next occurrence need to be retrieved.
     *
     * @return Holiday|null a Holiday instance for the given holiday
     *
     * @throws \ReflectionException
     * @throws UnknownLocaleException
     * @throws \RuntimeException
     * @throws InvalidArgumentException
     *
     * @covers AbstractProvider::anotherTime
     */
    public function next(string $shortName): ?Holiday
    {
        return $this->anotherTime($this->year + 1, $shortName);
    }

    /**
     * Determines the date of the given holiday for another year.
     *
     * @param int $year the year to get the holiday date for
     * @param string $shortName the name of the holiday for which the date needs to be fetched
     *
     * @return Holiday|null a Holiday instance for the given holiday and year
     *
     * @throws \ReflectionException
     * @throws InvalidArgumentException when the given name is blank or empty.
     * @throws UnknownLocaleException
     * @throws \RuntimeException
     */
    private function anotherTime(int $year, string $shortName): ?Holiday
    {
        $this->isHolidayNameNotEmpty($shortName); // Validate if short name is not empty

        // Get calling class name
        $hReflectionClass = new \ReflectionClass(\get_class($this));

        return Yasumi::create($hReflectionClass->getShortName(), $year, $this->locale)->getHoliday($shortName);
    }

    /**
     * Retrieves the holiday object for the given holiday.
     *
     * @param string $shortName the name of the holiday.
     *
     * @return Holiday|null a Holiday instance for the given holiday
     * @throws InvalidArgumentException when the given name is blank or empty.
     *
     */
    public function getHoliday(string $shortName): ?Holiday
    {
        $this->isHolidayNameNotEmpty($shortName); // Validate if short name is not empty

        $holidays = $this->getHolidays();

        return $holidays[$shortName] ?? null;
    }

    /**
     * Retrieves the previous date (year) the given holiday took place.
     *
     * @param string $shortName the name of the holiday for which the previous occurrence need to be retrieved.
     *
     * @return Holiday|null a Holiday instance for the given holiday
     *
     * @throws \ReflectionException
     * @throws UnknownLocaleException
     * @throws \RuntimeException
     * @throws InvalidArgumentException
     *
     * @covers AbstractProvider::anotherTime
     */
    public function previous(string $shortName): ?Holiday
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
     * @param \DateTimeInterface $startDate Start date of the time frame to check against
     * @param \DateTimeInterface $endDate End date of the time frame to check against
     * @param bool $equals indicate whether the start and end dates should be included in the
     *                                       comparison
     *
     * @return BetweenFilter
     * @throws InvalidArgumentException An InvalidArgumentException is thrown if the start date is set after the end
     *                                  date.
     *
     */
    public function between(
        \DateTimeInterface $startDate,
        \DateTimeInterface $endDate,
        ?bool $equals = null
    ): BetweenFilter {
        if ($startDate > $endDate) {
            throw new InvalidArgumentException('Start date must be a date before the end date.');
        }

        return new BetweenFilter($this->getIterator(), $startDate, $endDate, $equals ?? true);
    }

    /**
     * Get an iterator for the holidays.
     *
     * @return ArrayIterator iterator for the holidays of this calendar
     */
    public function getIterator(): ArrayIterator
    {
        return new ArrayIterator($this->getHolidays());
    }

    /**
     * Retrieves a list of all holidays that happen on the given date.
     *
     * Yasumi only calculates holidays for a single year, so a date outside of the given year will not appear to
     * contain any holidays.
     *
     * Please take care to use the appropriate timezone for the date parameters. If there is a different timezone used
     * for these parameters versus the instantiated Holiday Provider, the outcome might be unexpected (but correct).
     *
     * @param \DateTimeInterface $date Date to check for holidays on.
     *
     * @return OnFilter
     */
    public function on(\DateTimeInterface $date): OnFilter
    {
        return new OnFilter($this->getIterator(), $date);
    }
}
