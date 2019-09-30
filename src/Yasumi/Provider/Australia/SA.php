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

namespace Yasumi\Provider\Australia;

use DateInterval;
use DateTime;
use DateTimeZone;
use Yasumi\Exception\UnknownLocaleException;
use Yasumi\Holiday;
use Yasumi\Provider\Australia;

/**
 * Provider for all holidays in South Australia (Australia).
 *
 */
class SA extends Australia
{
    /**
     * Code to identify this Holiday Provider. Typically this is the ISO3166 code corresponding to the respective
     * country or sub-region.
     */
    public const ID = 'AU-SA';

    public $timezone = 'Australia/South';

    /**
     * Initialize holidays for South Australia (Australia).
     *
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    public function initialize(): void
    {
        parent::initialize();

        $this->addHoliday($this->easterSaturday($this->year, $this->timezone, $this->locale));
        $this->calculateQueensBirthday();
        $this->calculateLabourDay();
        $this->calculateAdelaideCupDay();

        // South Australia have Proclamation Day instead of Boxing Day, but the date definition is slightly different,
        // so we have to rework everything here...
        $this->removeHoliday('christmasDay');
        $this->removeHoliday('secondChristmasDay');
        $this->removeHoliday('christmasHoliday');
        $this->removeHoliday('secondChristmasHoliday');
        $this->calculateProclamationDay();
    }

    /**
     * Easter Saturday.
     *
     * Easter is a festival and holiday celebrating the resurrection of Jesus Christ from the dead. Easter is celebrated
     * on a date based on a certain number of days after March 21st. The date of Easter Day was defined by the Council
     * of Nicaea in AD325 as the Sunday after the first full moon which falls on or after the Spring Equinox.
     *
     * @link https://en.wikipedia.org/wiki/Easter
     *
     * @param int $year the year for which Easter Saturday need to be created
     * @param string $timezone the timezone in which Easter Saturday is celebrated
     * @param string $locale the locale for which Easter Saturday need to be displayed in.
     * @param string $type The type of holiday. Use the following constants: TYPE_OFFICIAL, TYPE_OBSERVANCE,
     *                         TYPE_SEASON, TYPE_BANK or TYPE_OTHER. By default an official holiday is considered.
     *
     * @return Holiday
     *
     * @throws UnknownLocaleException
     * @throws \InvalidArgumentException
     * @throws \Exception
     */
    private function easterSaturday($year, $timezone, $locale, $type = null): Holiday
    {
        return new Holiday(
            'easterSaturday',
            ['en' => 'Easter Saturday'],
            $this->calculateEaster($year, $timezone)->sub(new DateInterval('P1D')),
            $locale,
            $type ?? Holiday::TYPE_OFFICIAL
        );
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
    private function calculateQueensBirthday(): void
    {
        $this->calculateHoliday(
            'queensBirthday',
            ['en' => "Queen's Birthday"],
            new DateTime('second monday of june ' . $this->year, new DateTimeZone($this->timezone)),
            false,
            false
        );
    }

    /**
     * Labour Day
     *
     * @throws \Exception
     */
    private function calculateLabourDay(): void
    {
        $date = new DateTime("first monday of october $this->year", new DateTimeZone($this->timezone));

        $this->addHoliday(new Holiday('labourDay', ['en' => 'Labour Day'], $date, $this->locale));
    }

    /**
     * Adelaide Cup Day
     *
     * @link https://en.wikipedia.org/wiki/Adelaide_Cup
     *
     * @throws \InvalidArgumentException
     * @throws \Exception
     */
    private function calculateAdelaideCupDay(): void
    {
        if ($this->year >= 1973) {
            if ($this->year < 2006) {
                $this->calculateHoliday(
                    'adelaideCup',
                    ['en' => 'Adelaide Cup'],
                    new DateTime('third monday of may ' . $this->year, new DateTimeZone($this->timezone)),
                    false,
                    false
                );
            } else {
                $this->calculateHoliday(
                    'adelaideCup',
                    ['en' => 'Adelaide Cup'],
                    new DateTime('second monday of march ' . $this->year, new DateTimeZone($this->timezone)),
                    false,
                    false
                );
            }
        }
    }

    /**
     * Proclamation Day
     *
     * @throws \Exception
     */
    private function calculateProclamationDay(): void
    {
        $christmasDay = new DateTime("$this->year-12-25", new DateTimeZone($this->timezone));
        $this->calculateHoliday('christmasDay', [], $christmasDay, false, false);
        switch ($christmasDay->format('w')) {
            case 0: // sunday
                $christmasDay->add(new DateInterval('P1D'));
                $this->calculateHoliday('christmasHoliday', ['en' => 'Christmas Holiday'], $christmasDay, false, false);
                $proclamationDay = $christmasDay->add(new DateInterval('P1D'));
                $this->calculateHoliday('proclamationDay', ['en' => 'Proclamation Day'], $proclamationDay, false, false);
                break;
            case 5: // friday
                $proclamationDay = $christmasDay->add(new DateInterval('P3D'));
                $this->calculateHoliday('proclamationDay', ['en' => 'Proclamation Day'], $proclamationDay, false, false);
                break;
            case 6: // saturday
                $christmasDay->add(new DateInterval('P2D'));
                $this->calculateHoliday('christmasHoliday', ['en' => 'Christmas Holiday'], $christmasDay, false, false);
                $proclamationDay = $christmasDay->add(new DateInterval('P1D'));
                $this->calculateHoliday('proclamationDay', ['en' => 'Proclamation Day'], $proclamationDay, false, false);
                break;
            default: // monday-thursday
                $proclamationDay = $christmasDay->add(new DateInterval('P1D'));
                $this->calculateHoliday('proclamationDay', ['en' => 'Proclamation Day'], $proclamationDay, false, false);
                break;
        }
    }
}
