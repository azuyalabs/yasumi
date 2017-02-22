<?php
/**
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 - 2017 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <stelgenhof@gmail.com>
 */

namespace Yasumi\Provider\Australia;

use DateTime;
use DateTimeZone;
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
    const ID = 'AU-VIC';

    /**
     * Initialize holidays for Victoria (Australia).
     *
     * @throws \InvalidArgumentException
     * @throws \Yasumi\Exception\UnknownLocaleException
     */
    public function initialize()
    {
        parent::initialize();

        $this->calculateLabourDay();
        $this->calculateQueensBirthday();
        $this->calculateMelbourneCupDay();
        $this->calculateAFLGrandFinalDay();
    }

    public function calculateChristmasDay()
    {
        $christmasDay = new DateTime("$this->year-12-25", new DateTimeZone($this->timezone));
        $boxingDay    = new DateTime("$this->year-12-26", new DateTimeZone($this->timezone));

        $this->calculateHoliday('christmasDay', [], $christmasDay);
        $this->calculateHoliday('secondChristmasDay', [], $boxingDay, false, true);
    }

    public function calculateLabourDay()
    {
        $date = new DateTime("second monday of march $this->year", new DateTimeZone($this->timezone));

        $this->addHoliday(new Holiday('labourDay', [], $date, $this->locale));
    }

    public function calculateMelbourneCupDay()
    {
        $date = new DateTime('first Tuesday of November' . " $this->year", new DateTimeZone($this->timezone));

        $this->addHoliday(new Holiday('melbourneCup', ['en_AU' => 'Melbourne Cup'], $date, $this->locale));
    }

    public function calculateAFLGrandFinalDay()
    {
        switch ($this->year) {
            case 2015:
                $aflGrandFinalFriday = '2015-10-02';
                break;
            case 2016:
                $aflGrandFinalFriday = '2016-09-30';
                break;
            default:
                return;
        }

        $date = new DateTime($aflGrandFinalFriday, new DateTimeZone($this->timezone));

        $this->addHoliday(new Holiday('aflGrandFinalFriday', ['en_AU' => 'AFL Grand Final Friday'], $date,
            $this->locale));
    }
}
