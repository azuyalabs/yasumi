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

namespace Yasumi;

use Yasumi\Exception\InvalidDateException;

/**
 * Interface ProviderInterface - Holiday provider interface.
 *
 * This interface class defines the standard functions that any country provider needs to define.
 *
 * @see     AbstractProvider
 */
interface ProviderInterface
{
    /**
     * Initialize country holidays.
     */
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
     *
     * @throws InvalidDateException
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
}
