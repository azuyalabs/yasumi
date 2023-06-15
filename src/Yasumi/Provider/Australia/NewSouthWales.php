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

namespace Yasumi\Provider\Australia;

use Yasumi\Exception\UnknownLocaleException;
use Yasumi\Holiday;
use Yasumi\Provider\Australia;
use Yasumi\Provider\DateTimeZoneFactory;

/**
 * Provider for all holidays in New South Wales (Australia).
 */
class NewSouthWales extends Australia
{
    /**
     * Code to identify this Holiday Provider. Typically, this is the ISO3166 code corresponding to the respective
     * country or sub-region.
     */
    public const ID = 'AU-NSW';

    public string $timezone = 'Australia/NSW';

    /**
     * Initialize holidays for New South Wales (Australia).
     *
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    public function initialize(): void
    {
        parent::initialize();

        $this->addHoliday(new Holiday('easter', [], $this->calculateEaster($this->year, $this->timezone), $this->locale));
        $this->addHoliday($this->easterSaturday($this->year, $this->timezone, $this->locale));
        $this->calculateMonarchsBirthday();
        $this->calculateLabourDay();
        $this->calculateBankHoliday();
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
            $this->calculateEaster($year, $timezone)->sub(new \DateInterval('P1D')),
            $locale,
            $type ?? Holiday::TYPE_OFFICIAL
        );
    }

    /**
     * Monarch's Birthday.
     *
     * During the reign of Queen Elizabeth II this was called Queens Birthday,
     * it has subsequently been changed due to the change to King Charles III being the reigning monarch
     *
     * King's Birthday.
     *
     * King's Birthday is a public holiday in 6 states, 2 external territories and 2 territories,
     * where it is a day off for the general population, and schools and most businesses are closed.
     * This holiday name was first used in 2023
     *
     * Queen's Birthday.
     *
     * The Queen's Birthday is an Australian public holiday but the date varies across
     * states and territories. Australia celebrates this holiday because it is a constitutional
     * monarchy, with the English monarch as head of state.
     * This holiday name was last used in 2022
     *
     * It is celebrated as a public holiday on the second Monday of June.
     *  (Except QLD & WA)
     *
     * @see https://www.industrialrelations.nsw.gov.au/public-holidays/public-holidays-in-nsw
     * @see https://www.australia.gov.au/public-holidays
     * @see https://www.timeanddate.com/holidays/australia/kings-birthday
     * @see https://www.timeanddate.com/holidays/australia/queens-birthday
     *
     * @throws \InvalidArgumentException
     * @throws \Exception
     */
    private function calculateMonarchsBirthday(): void
    {
        if (1950 > $this->year) {
            return;
        }
        if (2022 >= $this->year) {
            $name = "Queen’s Birthday";
        }
        if (2023 <= $this->year) {
            $name = "King’s Birthday";
        }
        $this->addHoliday(new Holiday(
            'monarchsBirthday',
            ['en' => $name],
            new \DateTime('second monday of june '.$this->year, DateTimeZoneFactory::getDateTimeZone($this->timezone)),
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
        $date = new \DateTime("first monday of october $this->year", DateTimeZoneFactory::getDateTimeZone($this->timezone));

        $this->addHoliday(new Holiday('labourDay', [], $date, $this->locale));
    }

    /**
     * Bank Holiday.
     *
     * @throws \InvalidArgumentException
     * @throws \Exception
     */
    private function calculateBankHoliday(): void
    {
        $this->addHoliday(new Holiday(
            'bankHoliday',
            ['en' => 'Bank Holiday'],
            new \DateTime('first monday of august '.$this->year, DateTimeZoneFactory::getDateTimeZone($this->timezone)),
            $this->locale,
            Holiday::TYPE_BANK
        ));
    }
}
