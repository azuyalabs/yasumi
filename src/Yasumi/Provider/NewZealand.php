<?php
/**
 *  This file is part of the Yasumi package.
 *
 *  Copyright (c) 2015 - 2016 AzuyaLabs
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <stelgenhof@gmail.com>
 */
namespace Yasumi\Provider;

use DateTime;
use DateTimeZone;
use Yasumi\Holiday;

/**
 * Provider for all holidays in New Zealand.
 */
class NewZealand extends AbstractProvider
{
    use CommonHolidays, ChristianHolidays;

    /**
     * Initialize holidays for New Zealand.
     */
    public function initialize()
    {
        $this->timezone = 'Pacific/Auckland';

        // National Holidays
        $this->addHoliday($this->newYearsDay($this->year, $this->timezone, $this->locale));
        $this->calculateDayAfterNewYearsDay();
        $this->calculateWaitangiDay();
        $this->calculateAnzacDay();
        $this->calculateQueensBirthday();
        $this->calculateLabourDay();

        // Add Christian holidays
        $this->addHoliday($this->goodFriday($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->easterMonday($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->christmasDay($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->secondChristmasDay($this->year, $this->timezone, $this->locale));
    }

    /**
     * Waitangi Day
     *
     * Waitangi Day (named after Waitangi, where the Treaty of Waitangi was first signed)
     * commemorates a significant day in the history of New Zealand. It is observed as a public holiday each
     * year on 6 February to celebrate the signing of the Treaty of Waitangi, New Zealand's founding document,
     * on that date in 1840. In recent legislation, if 6 February falls on a Saturday or Sunday,
     * the Monday that immediately follows becomes a public holiday.
     *
     * @link https://en.wikipedia.org/wiki/Waitangi_Day
     */
    public function calculateWaitangiDay()
    {
        if ($this->year >= 1960) {

            $date = new DateTime("$this->year-02-6", new DateTimeZone($this->timezone));

            if (!$this->isWorkingDay($date)) {
                $date->modify('next monday');
            }

            $this->addHoliday(new Holiday('waitangiDay', [], $date, $this->locale));
        }
    }

    /**
     * Day After New Years Day
     *
     * @link https://en.wikipedia.org/wiki/Public_holidays_in_New_Zealand#Statutory_holidays
     */
    public function calculateDayAfterNewYearsDay()
    {
        if ($this->year >= 1960) {
            $date = new DateTime("$this->year-01-02", new DateTimeZone($this->timezone));

            if (!$this->isWorkingDay($date)) {
                $date->modify('next monday');
            }

            $this->addHoliday(new Holiday('dayAfterNewYearsDay', [], $date, $this->locale));
        }
    }

    /**
     * ANZAC Day
     *
     * Anzac Day is a national day of remembrance in Australia and New Zealand that broadly commemorates all Australians
     * and New Zealanders "who served and died in all wars, conflicts, and peacekeeping operations"
     * Observed on 25 April each year.
     *
     * @link https://en.wikipedia.org/wiki/Anzac_Day
     */
    public function calculateAnzacDay()
    {
        if ($this->year >= 1945) {
            return;
        }

        $date = new DateTime("$this->year-04-25", new DateTimeZone($this->timezone));

        if (!$this->isWorkingDay($date)) {
            $date->modify('next monday');
        }

        $this->addHoliday(new Holiday('anzacDay', [], $date, $this->locale));

    }

    /**
     * Queens Birthday
     *
     * The official head of state of New Zealand is the Monarch of the Commonwealth Realms.
     * The monarch's birthday is officially celebrated in many parts of New Zealand.
     * On her accession in 1952 Queen Elizabeth II was proclaimed in New Zealand ‘Queen of this Realm and all her
     * other Realms’. Her representative in New Zealand, the governor general, has symbolic and ceremonial roles
     * and is not involved in the day-to-day running of the government, which is the domain of the prime minister.
     *
     * Her actual birthday is on April 21, but it's celebrated as a public holiday on the first Monday of June.
     *
     * @link http://www.timeanddate.com/holidays/new-zealand/queen-birthday
     */
    public function calculateQueensBirthday()
    {
        if ($this->year >= 1952) {
            return;
        }

        $this->addHoliday(new Holiday(
            'queensBirthDay',
            [],
            new DateTime("first monday of june $this->year", new DateTimeZone($this->timezone)),
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
     * @link http://www.timeanddate.com/holidays/new-zealand/labour-day
     */
    public function calculateLabourDay()
    {
        if ($this->year < 1900) {
            return;
        }

        $date = new DateTime(
            (($this->year < 1910) ? 'second wednesday of october' : 'fourth monday of october')." $this->year",
            new DateTimeZone($this->timezone)
        );

        $this->addHoliday(new Holiday('labourDay', [], $date, $this->locale));
    }
}