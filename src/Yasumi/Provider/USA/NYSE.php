<?php

declare(strict_types = 1);

/**
 * This file is part of the 'Yasumi' package.
 *
 * The easy PHP Library for calculating holidays.
 *
 * Copyright (c) 2015 - 2025 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <me at sachatelgenhof dot com>
 */

namespace Yasumi\Provider\USA;

use Yasumi\Holiday;
use Yasumi\Provider\USA;

/**
 * Class NYSE in addition to regular holidays observed by the New York Stock
 * Exchange (NYSE), includes full day special closure events due to:
 * weather, national emergencies and presidential proclamations.
 * All trading closure events are included from year 2000.
 *
 * @author Art Kurbakov <admin at mgwebgroup dot com>
 */
class NYSE extends USA
{
    /**
     * Code to identify this Holiday Provider. Typically, this is the ISO3166 code corresponding to the respective
     * country or sub-region.
     */
    public const ID = 'US-NYSE';

    /**
     * Initialize holidays for the NYSE.
     *
     * @throws \Exception
     */
    public function initialize(): void
    {
        $this->timezone = 'America/New_York';

        // Add exhange-specific holidays
        $this->addHoliday($this->newYearsDay($this->year, $this->timezone, $this->locale));
        $this->calculateMartinLutherKingday();
        $this->calculateWashingtonsBirthday();
        $this->addHoliday($this->goodFriday($this->year, $this->timezone, $this->locale));
        $this->calculateMemorialDay();
        if (2021 < $this->year) {
            $this->calculateJuneteenth();
        }
        $this->calculateIndependenceDay();
        $this->calculateLabourDay();
        $this->calculateThanksgivingDay();
        $this->addHoliday($this->christmasDay($this->year, $this->timezone, $this->locale));

        $this->calculateSubstituteHolidays();

        // Add other full-day closure events
        $this->addWeatherEvents();
        $this->addEmergencies();
        $this->addProclamations();
    }

    public function getSources(): array
    {
        return [
            'https://www.nyse.com/trader-update/history#11507',
            'https://s3.amazonaws.com/armstrongeconomics-wp/2013/07/NYSE-Closings.pdf',
            'https://ir.theice.com/press/news-details/2018/New-York-Stock-Exchange-to-Honor-President-George-H-W-Bush/default.aspx',
            'https://ir.theice.com/press/news-details/2024/The-New-York-Stock-Exchange-Will-Close-Markets-on-January-9-to-Honor-the-Passing-of-Former-President-Jimmy-Carter-on-National-Day-of-Mourning/default.aspx',
            'https://www.thecorporatecounsel.net/blog/2021/10/nyse-makes-juneteenth-a-new-market-holiday.html',
        ];
    }

    private function addWeatherEvents(): void
    {
        if (2012 == $this->year) {
            $this->addHoliday(new Holiday('hurricaneSandy1', [], new \DateTime('2012-10-29', new \DateTimeZone($this->timezone))));
            $this->addHoliday(new Holiday('hurricaneSandy2', [], new \DateTime('2012-10-30', new \DateTimeZone($this->timezone))));
        }
    }

    private function addEmergencies(): void
    {
        if (2001 == $this->year) {
            $this->addHoliday(new Holiday('groundZero1', [], new \DateTime('2001-09-11', new \DateTimeZone($this->timezone))));
            $this->addHoliday(new Holiday('groundZero2', [], new \DateTime('2001-09-12', new \DateTimeZone($this->timezone))));
            $this->addHoliday(new Holiday('groundZero3', [], new \DateTime('2001-09-13', new \DateTimeZone($this->timezone))));
            $this->addHoliday(new Holiday('groundZero4', [], new \DateTime('2001-09-14', new \DateTimeZone($this->timezone))));
        }
    }

    private function addProclamations(): void
    {
        if (2004 == $this->year) {
            $this->addHoliday(new Holiday('ReaganMourning', [], new \DateTime('2004-06-11', new \DateTimeZone($this->timezone))));
        }
        if (2007 == $this->year) {
            $this->addHoliday(new Holiday('GRFordMourning', [], new \DateTime('2007-01-02', new \DateTimeZone($this->timezone))));
        }
        if (2018 == $this->year) {
            $this->addHoliday(new Holiday('HWBushMourning', [], new \DateTime('2018-12-05', new \DateTimeZone($this->timezone))));
        }
        if (2025 == $this->year) {
            $this->addHoliday(new Holiday('CarterMourning', [], new \DateTime('2025-01-09', new \DateTimeZone($this->timezone))));
        }
    }
}
