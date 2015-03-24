<?php
/*
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Yasumi\Provider;

use Carbon\Carbon;
use Yasumi\Holiday;

/**
 * Provider for all holidays in the Netherlands.
 */
class Netherlands extends AbstractProvider
{
    /**
     * Initialize holidays for the Netherlands.
     */
    public function initialize()
    {
        $this->timezone = 'Europe/Amsterdam';

        /*
         * New Year's Day
         */
        $this->addHoliday(new Holiday('newYearsDay', ['en-US' => 'New Year\'s Day'],
            Carbon::create($this->year, 1, 1, 0, 0, 0, $this->timezone), $this->locale));

        /*
         * Epiphanias
         */
        $this->addHoliday(new Holiday('epiphany', ['en-US' => 'Epiphany'],
            Carbon::create($this->year, 1, 6, 0, 0, 0, $this->timezone), $this->locale));

        /*
         * Valentine's Day
         */
        $this->addHoliday(new Holiday('valentinesDay', ['en-US' => 'Valentine\'s Day'],
            Carbon::create($this->year, 2, 14, 0, 0, 0, $this->timezone), $this->locale));

        /*
         * Labour Day
         */
        $this->addHoliday(new Holiday('labourDay', ['en-US' => 'Labour Day'],
            Carbon::create($this->year, 5, 1, 0, 0, 0, $this->timezone), $this->locale));

        /*
         * Commemoration Day and Liberation Day. Instituted after WWII in 1947.
         */
        if ($this->year >= 1947) {
            $this->addHoliday(new Holiday('commemorationDay', ['en-US' => 'Commemoration Day'],
                Carbon::create($this->year, 5, 4, 0, 0, 0, $this->timezone), $this->locale));
            $this->addHoliday(new Holiday('liberationDay', ['en-US' => 'Liberation Day'],
                Carbon::create($this->year, 5, 5, 0, 0, 0, $this->timezone), $this->locale));
        }

        /*
         * World Animal Day
         */
        $this->addHoliday(new Holiday('worldAnimalDay', ['en-US' => 'World Animal Day'],
            Carbon::create($this->year, 10, 4, 0, 0, 0, $this->timezone), $this->locale));

        /*
         * Halloween
         */
        $this->addHoliday(new Holiday('halloween', ['en-US' => 'Halloween'],
            Carbon::create($this->year, 10, 31, 0, 0, 0, $this->timezone), $this->locale));

        /**
         * St. Martins Day
         */
        $this->addHoliday(new Holiday('stMartinsDay', ['en-US' => 'St. Martin\'s Day'],
            Carbon::create($this->year, 11, 11, 0, 0, 0, $this->timezone), $this->locale));

        /**
         * St. Nicholas' Day
         */
        $this->addHoliday(new Holiday('stNicholasDay', ['en-US' => 'St. Nicholas\' Day'],
            Carbon::create($this->year, 12, 5, 0, 0, 0, $this->timezone), $this->locale));

        /**
         * Christmas day
         */
        $this->addHoliday(new Holiday('christmasDay', ['en-US' => 'Christmas'],
            Carbon::create($this->year, 12, 25, 0, 0, 0, $this->timezone), $this->locale));

        /**
         * Second Christmas Day / Boxing Day
         */
        $this->addHoliday(new Holiday('secondChristmasDay', ['en-US' => 'Boxing Day'],
            Carbon::create($this->year, 12, 26, 0, 0, 0, $this->timezone), $this->locale));
    }
}
