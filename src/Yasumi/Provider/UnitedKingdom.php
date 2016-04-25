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

use DateInterval;
use DateTime;
use DateTimeZone;
use Yasumi\Holiday;

/**
 * Provider for all holidays in the United Kingdom.
 */
class UnitedKingdom extends AbstractProvider
{
    use CommonHolidays, ChristianHolidays;

    /**
     * Initialize holidays for the United Kingdom.
     */
    public function initialize()
    {
        $this->timezone = 'Europe/London';

        // Add common holidays
        $this->calculateNewYearsDay();

        // Add common Christian holidays (common in the United Kingdom)
        $this->addHoliday($this->goodFriday($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->easterMonday($this->year, $this->timezone, $this->locale, Holiday::TYPE_BANK));

        // National Holidays
        //$this->calculateNewYearHolidays();
        //$this->calculateWaitangiDay();
        //$this->calculateAnzacDay();
        //$this->calculateQueensBirthday();
        //$this->calculateLabourDay();

        // Add Christian holidays
        //$this->addHoliday($this->goodFriday($this->year, $this->timezone, $this->locale));
        //$this->addHoliday($this->easterMonday($this->year, $this->timezone, $this->locale));
        //$this->calculateChristmasHolidays();
    }

    /**
     * New Year's Day is a public holiday in the United Kingdom on January 1 each year. It marks
     * the start of the New Year in the Gregorian calendar. For many people have a quiet day on
     * January 1, which marks the end of the Christmas break before they return to work.
     *
     * If New Years Day falls on a Saturday or Sunday, it is observed the next Monday (January 2nd or 3rd)
     * Before 1871 it was not an observed or statutory holiday, after 1871 only an observed holiday.
     * Since 1974 (by Royal Proclamation) it was established as a bank holiday.
     *
     * @link https://en.wikipedia.org/wiki/Public_holidays_in_the_United_Kingdom
     * @link http://www.timeanddate.com/holidays/uk/new-year-day
     */
    public function calculateNewYearsDay()
    {
        // Before 1871 it was not an observed or statutory holiday
        if ($this->year < 1871) {
            return;
        }

        $type = Holiday::TYPE_BANK;
        if ($this->year <= 1974) {
            $type = Holiday::TYPE_OBSERVANCE;
        }

        $newYearsDay = new DateTime("$this->year-01-01", new DateTimeZone($this->timezone));

        // If New Years Day falls on a Saturday or Sunday, it is observed the next Monday (January 2nd or 3rd)
        if (in_array($newYearsDay->format('w'), [0, 6])) {
            $newYearsDay->modify('next monday');
        }

        $this->addHoliday(new Holiday('newYearsDay', ['en_GB' => 'New Year\'s Day'], $newYearsDay, $this->locale, $type));
    }


    /**
     * Queens Birthday.
     *
     * The official head of state of the United Kingdom is the Monarch of the Commonwealth Realms.
     * The monarch's birthday is officially celebrated in many parts of the United Kingdom.
     * On her accession in 1952 Queen Elizabeth II was proclaimed in the United Kingdom ‘Queen of this Realm and all her
     * other Realms’. Her representative in the United Kingdom, the governor general, has symbolic and ceremonial roles
     * and is not involved in the day-to-day running of the government, which is the domain of the prime minister.
     *
     * Her actual birthday is on April 21, but it's celebrated as a public holiday on the first Monday of June.
     *
     * @link http://www.timeanddate.com/holidays/new-zealand/queen-birthday
     */
    public function calculateQueensBirthday()
    {
        if ($this->year < 1952) {
            return;
        }

        $this->addHoliday(new Holiday(
            'queensBirthday',
            [],
            new DateTime("first monday of june $this->year", new DateTimeZone($this->timezone)),
            $this->locale
        ));
    }

    /**
     * During the 19th century, workers in the United Kingdom tried to claim the right for an 8-hour working day.
     * In 1840 carpenter Samuel Parnell fought for this right in Wellington, NZ, and won.
     * Labour Day was first celebrated in the United Kingdom on October 28, 1890, when thousands of workers paraded in the
     * main city centres.
     * Government employees were given the day off to attend the parades and many businesses closed for at least part
     * of the day.
     *
     * The first official Labour Day public holiday in the United Kingdom was celebrated on the
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

        $date = new DateTime((($this->year < 1910) ? 'second wednesday of october' : 'fourth monday of october')." $this->year",
            new DateTimeZone($this->timezone)
        );

        $this->addHoliday(new Holiday('labourDay', [], $date, $this->locale));
    }

    /**
     * Christmas Day / Boxing Day.
     *
     * Christmas day, and Boxing day are public holidays in the United Kingdom,
     * they are subject to mondayisation rules.
     *
     * @link http://www.timeanddate.com/holidays/new-zealand/boxing-day
     * @link http://www.timeanddate.com/holidays/new-zealand/christmas-day
     * @link http://employment.govt.nz/er/holidaysandleave/publicholidays/mondayisation.asp
     */
    public function calculateChristmasHolidays()
    {
        $christmasDay = new DateTime("$this->year-12-25", new DateTimeZone($this->timezone));
        $boxingDay = new DateTime("$this->year-12-26", new DateTimeZone($this->timezone));

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
