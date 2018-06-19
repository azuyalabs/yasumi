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
 * Provider for all holidays in Tasmania (Australia).
 *
 */
class Tasmania extends Australia
{
    /**
     * Code to identify this Holiday Provider. Typically this is the ISO3166 code corresponding to the respective
     * country or sub-region.
     */
    const ID = 'AU-TAS';

    public $timezone = 'Australia/Tasmania';

    /**
     * Initialize holidays for Tasmania (Australia).
     *
     * @throws \InvalidArgumentException
     * @throws \Yasumi\Exception\UnknownLocaleException
     * @throws \Exception
     */
    public function initialize()
    {
        parent::initialize();

        $this->calculateEightHoursDay();
        $this->calculateQueensBirthday();
        $this->calculateRecreationDay();
    }

    public function calculateEightHoursDay()
    {
        $date = new DateTime("second monday of march $this->year", new DateTimeZone($this->timezone));

        $this->addHoliday(new Holiday('eightHourDay', ['en_AU' => 'Eight Hour Day'], $date, $this->locale));
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
            ['en_AU' => 'Queen\'s Birthday'],
            'second monday of june ' . $this->year,
            false,
            false
        );
    }
    
    /**
     * Recreation Day
     *
     * @link https://en.wikipedia.org/wiki/Recreation_Day_holiday
     *
     * @throws \InvalidArgumentException
     * @throws \Exception
     */
    public function calculateRecreationDay()
    {
        $this->calculateHoliday(
            'recreationDay',
            ['en_AU' => 'Recreation Day'],
            'first monday of november ' . $this->year,
            false,
            false
        );
    }
}
