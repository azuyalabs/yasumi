<?php
/**
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 - 2018 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <stelgenhof@gmail.com>
 */

namespace Yasumi\Provider;

use DateInterval;
use DateTime;
use DateTimeZone;
use Yasumi\Holiday;

/**
 * Provider for all holidays in Australia.
 */
class Australia extends AbstractProvider
{
    use CommonHolidays, ChristianHolidays;

    /**
     * Code to identify this Holiday Provider. Typically this is the ISO3166 code corresponding to the respective
     * country or sub-region.
     */
    const ID = 'AU';

    public $timezone = 'Australia/Melbourne';

    /**
     * Initialize holidays for Australia.
     *
     * @throws \Yasumi\Exception\InvalidDateException
     * @throws \InvalidArgumentException
     * @throws \Yasumi\Exception\UnknownLocaleException
     * @throws \Exception
     */
    public function initialize()
    {
        // Official Holidays
        $this->calculateAustraliaDay();
        $this->calculateNewYearHolidays();
        $this->calculateAnzacDay();

        // Add Christian holidays
        $this->addHoliday($this->goodFriday($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->easterMonday($this->year, $this->timezone, $this->locale));
        $this->calculateChristmasDay();
    }

    /**
     * Australia Day.
     *
     * Australia Day is the official National Day of Australia. Celebrated annually on 26 January,
     * it marks the anniversary of the 1788 arrival of the First Fleet of British Ships at
     * Port Jackson, New South Wales, and the raising of the Flag of Great Britain at Sydney Cove
     * by Governor Arthur Phillip. In present-day Australia, celebrations reflect the diverse
     * society and landscape of the nation, and are marked by community and family events,
     * reflections on Australian history, official community awards, and citizenship ceremonies
     * welcoming new immigrants into the Australian community.
     *
     * @link https://en.wikipedia.org/wiki/Waitangi_Day
     * @link https://www.timeanddate.com/holidays/australia/australia-day
     *
     * @throws \Yasumi\Exception\InvalidDateException
     * @throws \InvalidArgumentException
     * @throws \Yasumi\Exception\UnknownLocaleException
     * @throws \Exception
     */
    public function calculateAustraliaDay()
    {
        $date = new DateTime("$this->year-01-26", new DateTimeZone($this->timezone));

        $this->calculateHoliday('australiaDay', [], $date);
    }

    /**
     * Function to simplify moving holidays to mondays if required
     *
     * @param string    $shortName
     * @param array     $names
     * @param \DateTime $date
     * @param bool      $moveFromSaturday
     * @param bool      $moveFromSunday
     *
     * @throws \Yasumi\Exception\InvalidDateException
     * @throws \InvalidArgumentException
     * @throws \Yasumi\Exception\UnknownLocaleException
     * @throws \Exception
     */
    public function calculateHoliday(
        string $shortName,
        array $names = [],
        \DateTime $date,
        bool $moveFromSaturday = true,
        bool $moveFromSunday = true
    ) {
        $day = (int)$date->format('w');
        if (($day === 0 && $moveFromSunday) || ($day === 6 && $moveFromSaturday)) {
            $date = $date->add($day === 0 ? new DateInterval('P1D') : new DateInterval('P2D'));
        }

        $this->addHoliday(new Holiday($shortName, $names, $date, $this->locale));
    }

    /**
     * Holidays associated with the start of the modern Gregorian calendar.
     *
     * New Year's Day is on January 1 and is the first day of a new year in the Gregorian calendar,
     * which is used in Australia and many other countries. Due to its geographical position close
     * to the International Date Line, Australia is one of the first countries in the world to
     * welcome the New Year.
     *
     * @link https://www.timeanddate.com/holidays/australia/new-year-day
     *
     * @throws \Yasumi\Exception\InvalidDateException
     * @throws \InvalidArgumentException
     * @throws \Yasumi\Exception\UnknownLocaleException
     * @throws \Exception
     */
    public function calculateNewYearHolidays()
    {
        $this->calculateHoliday(
            'newYearsDay',
            [],
            new DateTime("$this->year-01-01", new DateTimeZone($this->timezone))
        );
    }

    /**
     * ANZAC Day.
     *
     * Anzac Day is a national day of remembrance in Australia and New Zealand that broadly commemorates all Australians
     * and New Zealanders "who served and died in all wars, conflicts, and peacekeeping operations"
     * Observed on 25 April each year.
     *
     * @link https://en.wikipedia.org/wiki/Anzac_Day
     * @link https://www.timeanddate.com/holidays/australia/anzac-day
     *
     * @throws \Yasumi\Exception\InvalidDateException
     * @throws \InvalidArgumentException
     * @throws \Yasumi\Exception\UnknownLocaleException
     * @throws \Exception
     */
    public function calculateAnzacDay()
    {
        if ($this->year < 1921) {
            return;
        }

        $date = new DateTime("$this->year-04-25", new DateTimeZone($this->timezone));

        $this->calculateHoliday('anzacDay', [], $date);
    }

    /**
     * Christmas Day / Boxing Day.
     *
     * Christmas day, and Boxing day are public holidays in Australia,
     * if they fall on the weekend they are moved to the next available weekday.
     *
     * @link https://www.timeanddate.com/holidays/australia/christmas-day-holiday
     *
     * @throws \Yasumi\Exception\InvalidDateException
     * @throws \InvalidArgumentException
     * @throws \Yasumi\Exception\UnknownLocaleException
     * @throws \Exception
     */
    public function calculateChristmasDay()
    {
        $christmasDay = new DateTime("$this->year-12-25", new DateTimeZone($this->timezone));
        $boxingDay    = new DateTime("$this->year-12-26", new DateTimeZone($this->timezone));

        switch ($christmasDay->format('w')) {
            case 0: // sunday
                $christmasDay->add(new \DateInterval('P2D'));
                break;
            case 5: // friday
                $boxingDay->add(new \DateInterval('P2D'));
                break;
            case 6: // saturday
                $christmasDay->add(new \DateInterval('P2D'));
                $boxingDay->add(new \DateInterval('P2D'));
                break;
        }
        $this->calculateHoliday('christmasDay', [], $christmasDay);
        $this->calculateHoliday('secondChristmasDay', [], $boxingDay);
    }

    /**
     * Queens Birthday.
     *
     * The Queen's Birthday is an Australian public holiday but the date varies across
     * states and territories. Australia celebrates this holiday because it is a constitutional
     * monarchy, with the English monarch as head of state.
     *
     * Her actual birthday is on April 21, but it's celebrated as a public holiday on the second Monday of June.
     *  (Except QLD & WA)
     *
     * @link https://www.timeanddate.com/holidays/australia/queens-birthday
     *
     * @throws \InvalidArgumentException
     * @throws \Exception
     */
    public function calculateQueensBirthday()
    {
        $this->calculateHoliday(
            'queensBirthday',
            ['en_AU' => 'Queens Birthday'],
            new DateTime('second monday of june ' . $this->year, new DateTimeZone($this->timezone)),
            false,
            false
        );
    }

    /**
     * @link https://www.timeanddate.com/holidays/australia/labour-day
     *
     * @throws \Yasumi\Exception\InvalidDateException
     * @throws \InvalidArgumentException
     * @throws \Yasumi\Exception\UnknownLocaleException
     */
    public function calculateLabourDay()
    {
        $date = new DateTime('first Monday in October' . " $this->year", new DateTimeZone($this->timezone));

        $this->addHoliday(new Holiday('labourDay', [], $date, $this->locale));
    }
}
