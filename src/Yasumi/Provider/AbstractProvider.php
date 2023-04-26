<?php

declare(strict_types=1);
/*
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 - 2023 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <me at sachatelgenhof dot com>
 */

namespace Yasumi\Provider;

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
abstract class AbstractProvider implements \Countable, ProviderInterface, \IteratorAggregate
{
    /**
     * Code to identify the Holiday Provider. Typically, this is the ISO3166 code corresponding to the respective
     * country or sub-region.
     */
    public const ID = 'US';

    /**
     * @var array<string, array<int>> list of the days of the week (the index of the weekdays) that are considered weekend days.
     *                                This list only concerns those countries that deviate from the global common definition,
     *                                where the weekend starts on Saturday and ends on Sunday (0 = Sunday, 1 = Monday, etc.).
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

    /** the object's current year */
    protected int $year;

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

        $this->year = $year ?: (int) date('Y');
        $this->locale = $locale ?? 'en_US';
        $this->globalTranslations = $globalTranslations;

        $this->initialize();
    }

    public function addHoliday(Holiday $holiday): void
    {
        if ($this->globalTranslations instanceof TranslationsInterface) {
            $holiday->mergeGlobalTranslations($this->globalTranslations);
        }

        $this->holidays[$holiday->getKey()] = $holiday;
        uasort($this->holidays, fn (\DateTimeInterface $dateA, \DateTimeInterface $dateB): int => self::compareDates($dateA, $dateB));
    }

    public function removeHoliday(string $key): void
    {
        unset($this->holidays[$key]);
    }

    public function isWorkingDay(\DateTimeInterface $date): bool
    {
        if ($this->isHoliday($date)) {
            return false;
        }

        return !$this->isWeekendDay($date);
    }

    public function isHoliday(\DateTimeInterface $date): bool
    {
        // Check if given date is a holiday or not
        return \in_array($date->format('Y-m-d'), $this->getHolidayDates(), true);
    }

    public function isWeekendDay(\DateTimeInterface $date): bool
    {
        // If no data is defined for this Holiday Provider, the function falls back to the global weekend definition.
        return \in_array(
            (int) $date->format('w'),
            static::WEEKEND_DATA[$this::ID] ?? [0, 6],
            true
        );
    }

    public function whenIs(string $key): string
    {
        $this->isHolidayKeyNotEmpty($key); // Validate if key is not empty

        return (string) $this->holidays[$key];
    }

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

    public function getHolidays(): array
    {
        return $this->holidays;
    }

    public function getHolidayNames(): array
    {
        return array_keys($this->holidays);
    }

    public function getYear(): int
    {
        return $this->year;
    }

    public function next(string $key): ?Holiday
    {
        return $this->anotherTime($this->year + 1, $key);
    }

    public function getHoliday(string $key): ?Holiday
    {
        $this->isHolidayKeyNotEmpty($key); // Validate if key is not empty

        $holidays = $this->getHolidays();

        return $holidays[$key] ?? null;
    }

    public function previous(string $key): ?Holiday
    {
        return $this->anotherTime($this->year - 1, $key);
    }

    public function between(
        \DateTimeInterface $startDate,
        \DateTimeInterface $endDate,
        ?bool $equals = null
    ): BetweenFilter {
        if ($startDate > $endDate) {
            throw new \InvalidArgumentException('Start date must be a date before the end date.');
        }

        return new BetweenFilter($this->getIterator(), $startDate, $endDate, $equals ?? true);
    }

    public function getIterator(): \ArrayIterator
    {
        return new \ArrayIterator($this->getHolidays());
    }

    public function on(\DateTimeInterface $date): OnFilter
    {
        return new OnFilter($this->getIterator(), $date);
    }

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
     * @throws \InvalidArgumentException an InvalidArgumentException is thrown if the given holiday parameter is empty
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
     * @throws \InvalidArgumentException an InvalidArgumentException is thrown if the given holiday parameter is empty
     */
    private function isHolidayKeyNotEmpty(string $key): bool
    {
        if (empty($key)) {
            throw new \InvalidArgumentException('Holiday key can not be blank.');
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
     * @throws \InvalidArgumentException when the given name is blank or empty
     * @throws UnknownLocaleException
     * @throws \RuntimeException
     */
    private function anotherTime(int $year, string $key): ?Holiday
    {
        $this->isHolidayKeyNotEmpty($key); // Validate if key is not empty

        // Get calling class name
        $hReflectionClass = new \ReflectionClass(\get_class($this));

        return Yasumi::create($hReflectionClass->getName(), $year, $this->locale)->getHoliday($key);
    }
}
