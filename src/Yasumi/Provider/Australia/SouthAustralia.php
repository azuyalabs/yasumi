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

namespace Yasumi\Provider\Australia;

use DateInterval;
use DateTime;
use Yasumi\Exception\UnknownLocaleException;
use Yasumi\Holiday;
use Yasumi\Provider\Australia;
use Yasumi\Provider\DateTimeZoneFactory;

/**
 * Provider for all holidays in South Australia (Australia).
 */
class SouthAustralia extends Australia
{
    /**
     * Code to identify this Holiday Provider. Typically, this is the ISO3166 code corresponding to the respective
     * country or sub-region.
     */
    public const ID = 'AU-SA';

    public string $timezone = 'Australia/South';

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
     * @see https://en.wikipedia.org/wiki/Easter
     *
     * @param int         $year     the year for which Easter Saturday need to be created
     * @param string      $timezone the timezone in which Easter Saturday is celebrated
     * @param string      $locale   the locale for which Easter Saturday need to be displayed in
     * @param string|null $type     The type of holiday. Use the following constants: TYPE_OFFICIAL, TYPE_OBSERVANCE,
     *                              TYPE_SEASON, TYPE_BANK or TYPE_OTHER. By default an official holiday is considered.
     *
     * @throws \Exception
     */
    private function easterSaturday(
        int $year,
        string $timezone,
        string $locale,
        ?string $type = null
    ): Holiday {
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
     * @see https://www.timeanddate.com/holidays/australia/queens-birthday
     *
     * @throws \InvalidArgumentException
     * @throws \Exception
     */
    private function calculateQueensBirthday(): void
    {
        $this->addHoliday(new Holiday(
            'queensBirthday',
            [],
            new DateTime('second monday of june '.$this->year, DateTimeZoneFactory::getDateTimeZone($this->timezone)),
            $this->locale,
            Holiday::TYPE_OFFICIAL
        ));
    }

    /**
     * Labour Day.
     *
     * @throws \Exception
     */
    private function calculateLabourDay(): void
    {
        $date = new DateTime("first monday of october $this->year", DateTimeZoneFactory::getDateTimeZone($this->timezone));

        $this->addHoliday(new Holiday('labourDay', ['en' => 'Labour Day'], $date, $this->locale));
    }

    /**
     * Adelaide Cup Day.
     *
     * @see https://en.wikipedia.org/wiki/Adelaide_Cup
     *
     * @throws \InvalidArgumentException
     * @throws \Exception
     */
    private function calculateAdelaideCupDay(): void
    {
        if ($this->year >= 1973) {
            $cupDay = 'second monday of march '.$this->year;

            if ($this->year < 2006) {
                $cupDay = 'third monday of may '.$this->year;
            }

            $this->addHoliday(new Holiday(
                'adelaideCup',
                ['en' => 'Adelaide Cup'],
                new DateTime($cupDay, DateTimeZoneFactory::getDateTimeZone($this->timezone)),
                $this->locale,
                Holiday::TYPE_OFFICIAL
            ));
        }
    }

    /**
     * Proclamation Day.
     *
     * @throws \Exception
     */
    private function calculateProclamationDay(): void
    {
        $christmasDay = new DateTime("$this->year-12-25", DateTimeZoneFactory::getDateTimeZone($this->timezone));

        $this->addHoliday(new Holiday(
            'christmasDay',
            [],
            $christmasDay,
            $this->locale,
            Holiday::TYPE_OFFICIAL
        ));

        switch ($christmasDay->format('w')) {
            case 0: // sunday
                $christmasDay->add(new DateInterval('P1D'));
                $this->addHoliday(new Holiday(
                    'christmasHoliday',
                    ['en' => 'Christmas Holiday'],
                    $christmasDay,
                    $this->locale,
                    Holiday::TYPE_OFFICIAL
                ));
                $christmasDay->add(new DateInterval('P1D'));
                break;
            case 5: // friday
                $christmasDay->add(new DateInterval('P3D'));
                break;
            case 6: // saturday
                $christmasDay->add(new DateInterval('P2D'));
                $this->addHoliday(new Holiday(
                    'christmasHoliday',
                    ['en' => 'Christmas Holiday'],
                    $christmasDay,
                    $this->locale,
                    Holiday::TYPE_OFFICIAL
                ));
                $christmasDay->add(new DateInterval('P1D'));
                break;
            default: // monday-thursday
                $christmasDay->add(new DateInterval('P1D'));
                break;
        }

        $this->addHoliday(new Holiday(
            'proclamationDay',
            ['en' => 'Proclamation Day'],
            $christmasDay,
            $this->locale,
            Holiday::TYPE_OFFICIAL
        ));
    }
}
