<?php declare(strict_types=1);
/**
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 - 2019 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <me@sachatelgenhof.com>
 */

namespace Yasumi\Provider;

use DateInterval;
use DateTime;
use DateTimeZone;
use Yasumi\Exception\InvalidDateException;
use Yasumi\Exception\UnknownLocaleException;
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
    public const ID = 'AU';

    public $timezone = 'Australia/Melbourne';

    /**
     * Initialize holidays for Australia.
     *
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    public function initialize(): void
    {
        // Official Holidays
        $this->calculateNewYearHolidays();
        $this->calculateAustraliaDay();
        $this->calculateAnzacDay();

        // Add Christian holidays
        $this->addHoliday($this->goodFriday($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->easterMonday($this->year, $this->timezone, $this->locale));
        $this->calculateChristmasDay();
    }

    /**
     * Holidays associated with the start of the modern Gregorian calendar.
     *
     * New Year's Day is on January 1 and is the first day of a new year in the Gregorian calendar,
     * which is used in Australia and many other countries. Due to its geographical position close
     * to the International Date Line, Australia is one of the first countries in the world to welcome the New Year.
     * If it falls on a weekend an additional public holiday is held on the next available weekday.
     *
     * @link https://www.timeanddate.com/holidays/australia/new-year-day
     *
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    private function calculateNewYearHolidays(): void
    {
        $newyearsday = new DateTime("$this->year-01-01", new DateTimeZone($this->timezone));
        $this->calculateHoliday('newYearsDay', ['en_AU' => 'New Year\'s Day'], $newyearsday, false, false);
        switch ($newyearsday->format('w')) {
            case 0: // sunday
                $newyearsday->add(new DateInterval('P1D'));
                $this->calculateHoliday('newYearsHoliday', ['en_AU' => 'New Year\'s Holiday'], $newyearsday, false, false);
                break;
            case 6: // saturday
                $newyearsday->add(new DateInterval('P2D'));
                $this->calculateHoliday('newYearsHoliday', ['en_AU' => 'New Year\'s Holiday'], $newyearsday, false, false);
                break;
        }
    }

    /**
     * Function to simplify moving holidays to mondays if required
     *
     * @param string $shortName
     * @param array $names
     * @param DateTime $date
     * @param bool $moveFromSaturday
     * @param bool $moveFromSunday
     * @param string $type
     *
     * @throws InvalidDateException
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    public function calculateHoliday(
        string $shortName,
        array $names = [],
        $date,
        $moveFromSaturday = null,
        $moveFromSunday = null,
        $type = null
    ): void {
        $day = (int)$date->format('w');
        if ((0 === $day && ($moveFromSunday ?? true)) || (6 === $day && ($moveFromSaturday ?? true))) {
            $date = $date->add(0 === $day ? new DateInterval('P1D') : new DateInterval('P2D'));
        }

        $this->addHoliday(new Holiday($shortName, $names, $date, $this->locale, $type ?? Holiday::TYPE_OFFICIAL));
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
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    private function calculateAustraliaDay(): void
    {
        $date = new DateTime("$this->year-01-26", new DateTimeZone($this->timezone));

        $this->calculateHoliday('australiaDay', ['en_AU' => 'Australia Day'], $date);
    }

    /**
     * ANZAC Day.
     *
     * Anzac Day is a national day of remembrance in Australia and New Zealand that broadly commemorates all Australians
     * and New Zealanders "who served and died in all wars, conflicts, and peacekeeping operations"
     * Observed on 25 April each year. Unlike most other Australian public holidays, If it falls on a weekend it is NOT moved
     * to the next available weekday, nor is there an additional public holiday held. However, if it clashes with Easter,
     * an additional public holiday is held for Easter.
     *
     * @link https://en.wikipedia.org/wiki/Anzac_Day
     * @link https://www.timeanddate.com/holidays/australia/anzac-day
     *
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    private function calculateAnzacDay(): void
    {
        if ($this->year < 1921) {
            return;
        }

        $date = new DateTime("$this->year-04-25", new DateTimeZone($this->timezone));
        $this->calculateHoliday('anzacDay', ['en_AU' => 'ANZAC Day'], $date, false, false);
        $easter = $this->calculateEaster($this->year, $this->timezone);

        $easterMonday = $this->calculateEaster($this->year, $this->timezone);
        $easterMonday->add(new DateInterval('P1D'));

        $fDate = $date->format('Y-m-d');
        if ($fDate === $easter->format('Y-m-d') || $fDate === $easterMonday->format('Y-m-d')) {
            $easterMonday->add(new DateInterval('P1D'));
            $this->calculateHoliday('easterTuesday', ['en_AU' => 'Easter Tuesday'], $easterMonday, false, false);
        }
        unset($fDate);
    }

    /**
     * Christmas Day / Boxing Day.
     *
     * Christmas day, and Boxing day are public holidays in Australia,
     * if they fall on the weekend an additional public holiday is held on the next available weekday.
     *
     * @link https://www.timeanddate.com/holidays/australia/christmas-day-holiday
     *
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    private function calculateChristmasDay(): void
    {
        $christmasDay = new DateTime("$this->year-12-25", new DateTimeZone($this->timezone));
        $boxingDay = new DateTime("$this->year-12-26", new DateTimeZone($this->timezone));
        $this->calculateHoliday('christmasDay', ['en_AU' => 'Christmas Day'], $christmasDay, false, false);
        $this->calculateHoliday('secondChristmasDay', ['en_AU' => 'Boxing Day'], $boxingDay, false, false);

        switch ($christmasDay->format('w')) {
            case 0: // sunday
                $christmasDay->add(new DateInterval('P2D'));
                $this->calculateHoliday('christmasHoliday', ['en_AU' => 'Christmas Holiday'], $christmasDay, false, false);
                break;
            case 5: // friday
                $boxingDay->add(new DateInterval('P2D'));
                $this->calculateHoliday('secondChristmasHoliday', ['en_AU' => 'Boxing Day Holiday'], $boxingDay, false, false);
                break;
            case 6: // saturday
                $christmasDay->add(new DateInterval('P2D'));
                $boxingDay->add(new DateInterval('P2D'));
                $this->calculateHoliday('christmasHoliday', ['en_AU' => 'Christmas Holiday'], $christmasDay, false, false);
                $this->calculateHoliday('secondChristmasHoliday', ['en_AU' => 'Boxing Day Holiday'], $boxingDay, false, false);
                break;
        }
    }
}
