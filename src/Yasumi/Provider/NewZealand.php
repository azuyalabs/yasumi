<?php

declare(strict_types=1);
/*
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 - 2021 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <me@sachatelgenhof.com>
 */

namespace Yasumi\Provider;

use DateInterval;
use DateTime;
use Yasumi\Exception\InvalidDateException;
use Yasumi\Exception\UnknownLocaleException;
use Yasumi\Holiday;

/**
 * Provider for all holidays in New Zealand.
 */
class NewZealand extends AbstractProvider
{
    use CommonHolidays;
    use ChristianHolidays;

    /**
     * Code to identify this Holiday Provider. Typically this is the ISO3166 code corresponding to the respective
     * country or sub-region.
     */
    public const ID = 'NZ';

    /**
     * Initialize holidays for New Zealand.
     *
     * @throws InvalidDateException
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    public function initialize(): void
    {
        $this->timezone = 'Pacific/Auckland';

        // Official Holidays
        $this->calculateNewYearHolidays();
        $this->calculateWaitangiDay();
        $this->calculateAnzacDay();
        $this->calculateQueensBirthday();
        $this->calculateLabourDay();

        // Add Christian holidays
        $this->addHoliday($this->goodFriday($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->easterMonday($this->year, $this->timezone, $this->locale));
        $this->calculateChristmasHolidays();
    }

    /**
     * Holidays associated with the start of the modern Gregorian calendar.
     *
     * New Zealanders celebrate New Years Day and The Day After New Years Day,
     * if either of these holidays occur on a weekend, the dates need to be adjusted.
     *
     * @see https://en.wikipedia.org/wiki/Public_holidays_in_New_Zealand#Statutory_holidays
     * @see https://www.timeanddate.com/holidays/new-zealand/new-year-day
     * @see https://www.timeanddate.com/holidays/new-zealand/day-after-new-years-day
     * @see https://www.employment.govt.nz/leave-and-holidays/public-holidays/public-holidays-falling-on-a-weekend/
     *
     * @throws InvalidDateException
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    private function calculateNewYearHolidays(): void
    {
        $newYearsDay = new DateTime("$this->year-01-01", DateTimeZoneFactory::getDateTimeZone($this->timezone));
        $dayAfterNewYearsDay = new DateTime("$this->year-01-02", DateTimeZoneFactory::getDateTimeZone($this->timezone));

        switch ($newYearsDay->format('w')) {
            case 0:
                $newYearsDay->add(new DateInterval('P1D'));
                $dayAfterNewYearsDay->add(new DateInterval('P1D'));
                break;
            case 5:
                $dayAfterNewYearsDay->add(new DateInterval('P2D'));
                break;
            case 6:
                $newYearsDay->add(new DateInterval('P2D'));
                $dayAfterNewYearsDay->add(new DateInterval('P2D'));
                break;
        }

        $this->addHoliday(new Holiday('newYearsDay', [], $newYearsDay, $this->locale));
        $this->addHoliday(new Holiday('dayAfterNewYearsDay', [], $dayAfterNewYearsDay, $this->locale));
    }

    /**
     * Waitangi Day.
     *
     * Waitangi Day (named after Waitangi, where the Treaty of Waitangi was first signed)
     * commemorates a significant day in the history of New Zealand. It is observed as a public holiday each
     * year on 6 February to celebrate the signing of the Treaty of Waitangi, New Zealand's founding document,
     * on that date in 1840. In recent legislation, if 6 February falls on a Saturday or Sunday,
     * the Monday that immediately follows becomes a public holiday.
     *
     * @see https://en.wikipedia.org/wiki/Waitangi_Day
     * @see https://www.employment.govt.nz/leave-and-holidays/public-holidays/public-holidays-falling-on-a-weekend/
     *
     * @throws InvalidDateException
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    private function calculateWaitangiDay(): void
    {
        if ($this->year < 1974) {
            return;
        }

        $date = new DateTime("$this->year-02-6", DateTimeZoneFactory::getDateTimeZone($this->timezone));

        if ($this->year >= 2015 && !$this->isWorkingDay($date)) {
            $date->modify('next monday');
        }

        $this->addHoliday(new Holiday('waitangiDay', [], $date, $this->locale));
    }

    /**
     * ANZAC Day.
     *
     * Anzac Day is a national day of remembrance in Australia and New Zealand that broadly commemorates all Australians
     * and New Zealanders "who served and died in all wars, conflicts, and peacekeeping operations"
     * Observed on 25 April each year.
     *
     * @see https://en.wikipedia.org/wiki/Anzac_Day
     * @see https://www.employment.govt.nz/leave-and-holidays/public-holidays/public-holidays-falling-on-a-weekend/
     *
     * @throws InvalidDateException
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    private function calculateAnzacDay(): void
    {
        if ($this->year < 1921) {
            return;
        }

        $date = new DateTime("$this->year-04-25", DateTimeZoneFactory::getDateTimeZone($this->timezone));

        if ($this->year >= 2015 && !$this->isWorkingDay($date)) {
            $date->modify('next monday');
        }

        $this->addHoliday(new Holiday('anzacDay', [], $date, $this->locale));
    }

    /**
     * Queens Birthday.
     *
     * The official head of state of New Zealand is the Monarch of the Commonwealth Realms.
     * The monarch's birthday is officially celebrated in many parts of New Zealand.
     * On her accession in 1952 Queen Elizabeth II was proclaimed in New Zealand ‘Queen of this Realm and all her
     * other Realms’. Her representative in New Zealand, the governor general, has symbolic and ceremonial roles
     * and is not involved in the day-to-day running of the government, which is the domain of the prime minister.
     *
     * Her actual birthday is on April 21, but it's celebrated as a public holiday on the first Monday of June.
     *
     * @see https://www.timeanddate.com/holidays/new-zealand/queen-birthday
     *
     * @throws InvalidDateException
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    private function calculateQueensBirthday(): void
    {
        if ($this->year < 1952) {
            return;
        }

        $this->addHoliday(new Holiday(
            'queensBirthday',
            [],
            new DateTime("first monday of june $this->year", DateTimeZoneFactory::getDateTimeZone($this->timezone)),
            $this->locale
        ));
    }

    /**
     * During the 19th century, workers in New Zealand tried to claim the right for an 8-hour working day.
     * In 1840 carpenter Samuel Parnell fought for this right in Wellington, NZ, and won.
     * Labour Day was first celebrated in New Zealand on October 28, 1890, when thousands of workers paraded in the
     * main city centres.
     * Government employees were given the day off to attend the parades and many businesses closed for at least part
     * of the day.
     *
     * The first official Labour Day public holiday in New Zealand was celebrated on the
     * second Wednesday in October in 1900. The holiday was moved to the fourth Monday of October in 1910
     * has remained on this date since then.
     *
     * @see https://www.timeanddate.com/holidays/new-zealand/labour-day
     *
     * @throws InvalidDateException
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    private function calculateLabourDay(): void
    {
        if ($this->year < 1900) {
            return;
        }

        $date = new DateTime(
            ($this->year < 1910 ? 'second wednesday of october' : 'fourth monday of october')." $this->year",
            DateTimeZoneFactory::getDateTimeZone($this->timezone)
        );

        $this->addHoliday(new Holiday('labourDay', [], $date, $this->locale));
    }

    /**
     * Christmas Day / Boxing Day.
     *
     * Christmas day, and Boxing day are public holidays in New Zealand,
     * they are subject to mondayisation rules.
     *
     * @see https://www.timeanddate.com/holidays/new-zealand/boxing-day
     * @see https://www.timeanddate.com/holidays/new-zealand/christmas-day
     * @see https://www.employment.govt.nz/leave-and-holidays/public-holidays/public-holidays-falling-on-a-weekend/
     *
     * @throws InvalidDateException
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    private function calculateChristmasHolidays(): void
    {
        $christmasDay = new DateTime("$this->year-12-25", DateTimeZoneFactory::getDateTimeZone($this->timezone));
        $boxingDay = new DateTime("$this->year-12-26", DateTimeZoneFactory::getDateTimeZone($this->timezone));

        switch ($christmasDay->format('w')) {
            case 0:
                $christmasDay->add(new DateInterval('P2D'));
                break;
            case 5:
                $boxingDay->add(new DateInterval('P2D'));
                break;
            case 6:
                $christmasDay->add(new DateInterval('P2D'));
                $boxingDay->add(new DateInterval('P2D'));
                break;
        }

        $this->addHoliday(new Holiday('christmasDay', [], $christmasDay, $this->locale));
        $this->addHoliday(new Holiday('secondChristmasDay', [], $boxingDay, $this->locale));
    }
}
