<?php
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
use Yasumi\Holiday;
use Yasumi\Provider\Australia;

/**
 * Provider for all holidays in New South Wales (Australia).
 *
 */
class NSW extends Australia
{
    /**
     * Code to identify this Holiday Provider. Typically this is the ISO3166 code corresponding to the respective
     * country or sub-region.
     */
    public const ID = 'AU-NSW';

    public $timezone = 'Australia/NSW';

    /**
     * Initialize holidays for New South Wales (Australia).
     *
     * @throws \InvalidArgumentException
     * @throws \Yasumi\Exception\UnknownLocaleException
     * @throws \Exception
     */
    public function initialize(): void
    {
        parent::initialize();

        $this->addHoliday(new Holiday('easter', ['en_AU' => 'Easter Sunday'], $this->calculateEaster($this->year, $this->timezone), $this->locale));
        $this->addHoliday($this->easterSaturday($this->year, $this->timezone, $this->locale));
        $this->calculateQueensBirthday();
        $this->calculateLabourDay();
        $this->calculateBankHoliday();
    }

    /**
     * Labour Day
     *
     * @throws \Exception
     */
    private function calculateLabourDay(): void
    {
        $date = new DateTime("first monday of october $this->year", new DateTimeZone($this->timezone));

        $this->addHoliday(new Holiday('labourDay', [], $date, $this->locale));
    }

    /**
     * Easter Saturday.
     *
     * Easter is a festival and holiday celebrating the resurrection of Jesus Christ from the dead. Easter is celebrated
     * on a date based on a certain number of days after March 21st. The date of Easter Day was defined by the Council
     * of Nicaea in AD325 as the Sunday after the first full moon which falls on or after the Spring Equinox.
     *
     * @link http://en.wikipedia.org/wiki/Easter
     *
     * @param int    $year     the year for which Easter Saturday need to be created
     * @param string $timezone the timezone in which Easter Saturday is celebrated
     * @param string $locale   the locale for which Easter Saturday need to be displayed in.
     * @param string $type     The type of holiday. Use the following constants: TYPE_OFFICIAL, TYPE_OBSERVANCE,
     *                         TYPE_SEASON, TYPE_BANK or TYPE_OTHER. By default an official holiday is considered.
     *
     * @return \Yasumi\Holiday
     *
     * @throws \Yasumi\Exception\UnknownLocaleException
     * @throws \InvalidArgumentException
     * @throws \Exception
     */
    private function easterSaturday($year, $timezone, $locale, $type = Holiday::TYPE_OFFICIAL): Holiday
    {
        return new Holiday(
            'easterSaturday',
            ['en_AU' => 'Easter Saturday'],
            $this->calculateEaster($year, $timezone)->sub(new DateInterval('P1D')),
            $locale,
            $type
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
            ['en_AU' => "Queen's Birthday"],
            new DateTime('second monday of june ' . $this->year, new DateTimeZone($this->timezone)),
            false,
            false
        );
    }
    
    /**
     * Bank Holiday.
     *
     * @throws \InvalidArgumentException
     * @throws \Exception
     */
    private function calculateBankHoliday(): void
    {
        $this->calculateHoliday(
            'bankHoliday',
            ['en_AU' => 'Bank Holiday'],
            new DateTime('first monday of august '. $this->year, new DateTimeZone($this->timezone)),
            false,
            false,
            Holiday::TYPE_BANK
        );
    }
}
