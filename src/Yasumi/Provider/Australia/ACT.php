<?php
/**
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 - 2018 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author William Sanders <williamrsanders@hotmail.com>
 */

namespace Yasumi\Provider\Australia;

use DateInterval;
use DateTime;
use DateTimeZone;
use Yasumi\Holiday;
use Yasumi\Provider\Australia;

/**
 * Provider for all holidays in Australian Capital Territory (Australia).
 *
 */
class ACT extends Australia
{
    /**
     * Code to identify this Holiday Provider. Typically this is the ISO3166 code corresponding to the respective
     * country or sub-region.
     */
    const ID = 'AU-ACT';

    public $timezone = 'Australia/ACT';

    /**
     * Initialize holidays for Australian Capital Territory (Australia).
     *
     * @throws \InvalidArgumentException
     * @throws \Yasumi\Exception\UnknownLocaleException
     * @throws \Exception
     */
    public function initialize()
    {
        parent::initialize();

        $this->addHoliday($this->easterSunday($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->easterSaturday($this->year, $this->timezone, $this->locale));
        $this->calculateQueensBirthday();
        $this->calculateLabourDay();
        $this->calculateCanberraDay();
        $this->calculateReconciliationDay();
    }

    public function calculateCanberraDay()
    {
        if ($this->year < 2007) {
            $date = new DateTime("third monday of march $this->year", new DateTimeZone($this->timezone));
        } else {
            $date = new DateTime("second monday of march $this->year", new DateTimeZone($this->timezone));
        }
        $this->addHoliday(new Holiday('canberraDay', ['en_AU' => 'Canberra Day'], $date, $this->locale));
    }
    
    public function calculateReconciliationDay()
    {
        if ($this->year < 2018) {
            return;
        } else {
            $date = new DateTime($this->year."-05-27", new DateTimeZone($this->timezone));
            $day = (int)$date->format('w');
            if ($day !== 1) {
                $date = $date->add($day === 0 ? new DateInterval('P1D') : new DateInterval('P'.(8-$day).'D'));
            }
            $this->addHoliday(new Holiday('reconciliationDay', ['en_AU' => 'Reconciliation Day'], $date, $this->locale));
        }
    }
    
    public function calculateLabourDay()
    {
        $date = new DateTime("first monday of october $this->year", new DateTimeZone($this->timezone));

        $this->addHoliday(new Holiday('labourDay', ['en_AU' => 'Labour Day'], $date, $this->locale));
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
    public function easterSaturday($year, $timezone, $locale, $type = Holiday::TYPE_OFFICIAL)
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
     * Easter Sunday.
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
    public function easterSunday($year, $timezone, $locale, $type = Holiday::TYPE_OFFICIAL)
    {
        return new Holiday(
            'easter',
            ['en_AU' => 'Easter Sunday'],
            $this->calculateEaster($year, $timezone),
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
    public function calculateQueensBirthday()
    {
        $this->calculateHoliday(
            'queensBirthday',
            ['en_AU' => "Queen's Birthday"],
            'second monday of june ' . $this->year,
            false,
            false
        );
    }
}
