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
 * Provider for all holidays in Victoria (Australia).
 *
 */
class Victoria extends Australia
{
    /**
     * Code to identify this Holiday Provider. Typically this is the ISO3166 code corresponding to the respective
     * country or sub-region.
     */
    public const ID = 'AU-VIC';

    public $timezone = 'Australia/Victoria';

    /**
     * Initialize holidays for Victoria (Australia).
     *
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    public function initialize(): void
    {
        parent::initialize();

        $this->addHoliday($this->easterSunday($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->easterSaturday($this->year, $this->timezone, $this->locale));
        $this->calculateLabourDay();
        $this->calculateQueensBirthday();
        $this->calculateMelbourneCupDay();
        $this->calculateAFLGrandFinalDay();
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
    private function easterSunday($year, $timezone, $locale, $type = null): Holiday
    {
        return new Holiday(
            'easter',
            ['en_AU' => 'Easter Sunday'],
            $this->calculateEaster($year, $timezone),
            $locale,
            $type ?? Holiday::TYPE_OFFICIAL
        );
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
            ['en_AU' => 'Easter Saturday'],
            $this->calculateEaster($year, $timezone)->sub(new DateInterval('P1D')),
            $locale,
            $type ?? Holiday::TYPE_OFFICIAL
        );
    }

    /**
     * Labour Day
     *
     * @throws \Exception
     */
    private function calculateLabourDay(): void
    {
        $date = new DateTime("second monday of march $this->year", new DateTimeZone($this->timezone));

        $this->addHoliday(new Holiday('labourDay', ['en_AU' => 'Labour Day'], $date, $this->locale));
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
            ['en_AU' => 'Queen\'s Birthday'],
            new DateTime('second monday of june ' . $this->year, new DateTimeZone($this->timezone)),
            false,
            false
        );
    }

    /**
     * Melbourne Cup Day
     *
     * @throws \Exception
     */
    private function calculateMelbourneCupDay(): void
    {
        $date = new DateTime('first Tuesday of November' . " $this->year", new DateTimeZone($this->timezone));

        $this->addHoliday(new Holiday('melbourneCup', ['en_AU' => 'Melbourne Cup'], $date, $this->locale));
    }

    /**
     * AFL Grand Final Day
     *
     * @throws \Exception
     */
    private function calculateAFLGrandFinalDay(): void
    {
        switch ($this->year) {
            case 2015:
                $aflGrandFinalFriday = '2015-10-02';
                break;
            case 2016:
                $aflGrandFinalFriday = '2016-09-30';
                break;
            case 2017:
                $aflGrandFinalFriday = '2017-09-29';
                break;
            case 2018:
                $aflGrandFinalFriday = '2018-09-28';
                break;
            default:
                return;
        }

        $date = new DateTime($aflGrandFinalFriday, new DateTimeZone($this->timezone));

        $this->addHoliday(new Holiday(
            'aflGrandFinalFriday',
            ['en_AU' => 'AFL Grand Final Friday'],
            $date,
            $this->locale
        ));
    }
}
