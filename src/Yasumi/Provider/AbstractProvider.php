<?php

declare(strict_types=1);
/*
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 - 2022 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <me at sachatelgenhof dot com>
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
     * Code to identify the Holiday Provider. Typically, this is the ISO3166 code corresponding to the respective
     * country or sub-region.
     */
    public const ID = 'US';

    /**
     * @var array<string,array> list of the days of the week (the index of the weekdays) that are considered weekend days.
     *                          This list only concerns those countries that deviate from the global common definition,
     *                          where the weekend starts on Saturday and ends on Sunday (0 = Sunday, 1 = Monday, etc.).
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

    /** the object's current timezone */
    protected string $timezone;

    /** the object's current locale */
    protected string $locale;

    /**
     * @var Holiday[] list of dates of the available holidays
     */
    private array $holidays = [];

    /** global translations */
    private ?TranslationsInterface $globalTranslations;

    /**
     * Creates a new holiday provider (i.e. country/state).
     *
     * @param int                        $year               the year for which to provide holidays
     * @param string|null                $locale             |null the locale/language in which holidays need to be
     *                                                       represented
     * @param TranslationsInterface|null $globalTranslations global translations
     */
    public function __construct(
        int $year,
        ?string $locale = null,
        ?TranslationsInterface $globalTranslations = null
    ) {
        $this->clearHolidays();

        $this->year = $year ?: getdate()['year'];
        $this->locale = $locale ?? 'en_US';
        $this->globalTranslations = $globalTranslations;

        $this->initialize();
    }

    /**
     * Adds a holiday to the holidays providers (i.e. country/state) list of holidays.
     *
     * @param Holiday $holiday holiday instance (representing a holiday) to be added to the internal list
     *                         of holidays of this country
     */
    public function addHoliday(Holiday $holiday): void
    {
        if ($this->globalTranslations instanceof TranslationsInterface) {
            $holiday->mergeGlobalTranslations($this->globalTranslations);
        }

        $this->holidays[$holiday->getKey()] = $holiday;
        uasort($this->holidays, fn (\DateTimeInterface $dateA, \DateTimeInterface $dateB): int => $this::compareDates($dateA, $dateB));
    }

    /**
     * Removes a holiday from the holidays providers (i.e. country/state) list of holidays.
     *
     * This function can be helpful in cases where an existing holiday provider class can be extended but some holidays
     * are not part of the original (extended) provider.
     *
     * @param string $key holiday key
     */
    public function removeHoliday(string $key): void
    {
        unset($this->holidays[$key]);
    }

    /** {@inheritdoc} */
    public function isWorkingDay(\DateTimeInterface $date): bool
    {
        return !$this->isHoliday($date) && !$this->isWeekendDay($date);
    }

    /**
     * Determines whether a date represents a holiday or not.
     *
     * @param \DateTimeInterface $date any date object that implements the DateTimeInterface (e.g. Yasumi\Holiday,
     *                                 \DateTime)
     *
     * @return bool true if date represents a holiday, otherwise false
     *
     * @throws InvalidDateException
     */
    public function isHoliday(\DateTimeInterface $date): bool
    {
        // Check if given date is a holiday or not
        return \in_array($date->format('Y-m-d'), $this->getHolidayDates(), true);
    }

    /**
     * Determines whether a date represents a weekend day or not.
     *
     * @param \DateTimeInterface $date any date object that implements the DateTimeInterface (e.g. Yasumi\Holiday,
     *                                 \DateTime)
     *
     * @return bool true if date represents a weekend day, otherwise false
     *
     * @throws InvalidDateException
     */
    public function isWeekendDay(\DateTimeInterface $date): bool
    {
        // If no data is defined for this Holiday Provider, the function falls back to the global weekend definition.
        return \in_array(
            (int) $date->format('w'),
            static::WEEKEND_DATA[$this::ID] ?? [0, 6],
            true
        );
    }

    /**
     * On what date is the given holiday?
     *
     * @param string $key holiday key
     *
     * @return string the date of the requested holiday
     *
     * @throws InvalidArgumentException when the given name is blank or empty
     */
    public function whenIs(string $key): string
    {
        $this->isHolidayKeyNotEmpty($key); // Validate if key is not empty

        return (string) $this->holidays[$key];
    }

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
     * @throws InvalidArgumentException when the given name is blank or empty
     */
    public function whatWeekDayIs(string $key): int
    {
        $this->isHolidayKeyNotEmpty($key); // Validate if key is not empty

        return (int) $this->holidays[$key]->format('w');
    }

    /**
     * Returns the number of defined holidays (for the given country and the given year).
     * In case a holiday is substituted (e.g. observed), the holiday is only counted once.
     *
     * @return int number of holidays
     */
    public function count(): int
    {
        $names = array_map(static function ($holiday): string {
            if ($holiday instanceof SubstituteHoliday) {
                return $holiday->getSubstitutedHoliday()->getKey();
            }

            return $holiday->getKey();
        }, $this->getHolidays());

        return \count(array_unique($names));
    }

    /**
     * Gets all the holidays defined by this holiday provider (for the given year).
     *
     * @return Holiday[] list of all holidays defined for the given year
     */
    public function getHolidays(): array
    {
        return $this->holidays;
    }

    /**
     * Gets all the holiday names defined by this holiday provider (for the given year).
     *
     * @return array<string> list of all holiday names defined for the given year
     */
    public function getHolidayNames(): array
    {
        return array_keys($this->holidays);
    }

    /** {@inheritdoc} */
    public function getYear(): int
    {
        return $this->year;
    }

    /**
     * Retrieves the next date (year) the given holiday is going to take place.
     *
     * @param string $key key of the holiday for which the next occurrence need to be retrieved
     *
     * @return Holiday|null a Holiday instance for the given holiday
     *
     * @throws UnknownLocaleException
     * @throws \RuntimeException
     * @throws InvalidArgumentException
     *
     * @covers AbstractProvider::anotherTime
     */
    public function next(string $key): ?Holiday
    {
        return $this->anotherTime($this->year + 1, $key);
    }

    /** {@inheritdoc} */
    public function getHoliday(string $key): ?Holiday
    {
        $this->isHolidayKeyNotEmpty($key); // Validate if key is not empty

        $holidays = $this->getHolidays();

        return $holidays[$key] ?? null;
    }

    /**
     * Retrieves the previous date (year) the given holiday took place.
     *
     * @param string $key key of the holiday for which the previous occurrence need to be retrieved
     *
     * @return Holiday|null a Holiday instance for the given holiday
     *
     * @throws UnknownLocaleException
     * @throws \RuntimeException
     * @throws InvalidArgumentException
     *
     * @covers AbstractProvider::anotherTime
     */
    public function previous(string $key): ?Holiday
    {
        return $this->anotherTime($this->year - 1, $key);
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
     * @param \DateTimeInterface $endDate   End date of the time frame to check against
     * @param ?bool              $equals    indicate whether the start and end dates should be included in the
     *                                      comparison
     *
     * @throws InvalidArgumentException an InvalidArgumentException is thrown if the start date is set after the end
     *                                  date
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
     * Yasumi only calculates holidays for a single year, so a date outside the given year will not appear to
     * contain any holidays.
     *
     * Please take care to use the appropriate timezone for the date parameters. If there is a different timezone used
     * for these parameters versus the instantiated Holiday Provider, the outcome might be unexpected (but correct).
     *
     * @param \DateTimeInterface $date date to check for holidays on
     */
    public function on(\DateTimeInterface $date): OnFilter
    {
        return new OnFilter($this->getIterator(), $date);
    }

    /**
     * Gets all the holiday dates defined by this holiday provider (for the given year).
     *
     * @return array<string> list of all holiday dates defined for the given year
     */
    public function getHolidayDates(): array
    {
        return array_map(static fn ($holiday): string => (string) $holiday, $this->holidays);
    }

    /**
     * Checks whether the given holiday is not empty.
     *
     * @param string $key key of the holiday to be checked
     *
     * @return true upon success, otherwise an InvalidArgumentException is thrown
     *
     * @throws InvalidArgumentException an InvalidArgumentException is thrown if the given holiday parameter is empty
     *
     * @deprecated deprecated in favor of isHolidayKeyNotEmpty()
     * @deprecated see isHolidayKeyNotEmpty()
     */
    protected function isHolidayNameNotEmpty(string $key): bool
    {
        return $this->isHolidayKeyNotEmpty($key);
    }

    /**
     * Clear all holidays.
     */
    private function clearHolidays(): void
    {
        $this->holidays = [];
    }

    /**
     * Checks whether the given holiday is not empty.
     *
     * @param string $key key of the holiday to be checked
     *
     * @return true upon success, otherwise an InvalidArgumentException is thrown
     *
     * @throws InvalidArgumentException an InvalidArgumentException is thrown if the given holiday parameter is empty
     */
    private function isHolidayKeyNotEmpty(string $key): bool
    {
        if (empty($key)) {
            throw new InvalidArgumentException('Holiday key can not be blank.');
        }

        return true;
    }

    /**
     * Internal function to compare dates in order to sort them chronologically.
     *
     * @param \DateTimeInterface $dateA First date
     * @param \DateTimeInterface $dateB Second date
     *
     * @return int result where 0 means dates are equal, -1 the first date is before the second date, and 1 if the
     *             second date is after the first
     */
    private static function compareDates(\DateTimeInterface $dateA, \DateTimeInterface $dateB): int
    {
        return $dateA <=> $dateB;
    }

    /**
     * Determines the date of the given holiday for another year.
     *
     * @param int    $year the year to get the holiday date for
     * @param string $key  key of the holiday for which the date needs to be fetched
     *
     * @return Holiday|null a Holiday instance for the given holiday and year
     *
     * @throws InvalidArgumentException when the given name is blank or empty
     * @throws UnknownLocaleException
     * @throws \RuntimeException
     */
    private function anotherTime(int $year, string $key): ?Holiday
    {
        $this->isHolidayKeyNotEmpty($key); // Validate if key is not empty

        // Get calling class name
        $hReflectionClass = new \ReflectionClass(\get_class($this));

        return Yasumi::create($hReflectionClass->getShortName(), $year, $this->locale)->getHoliday($key);
    }
}
