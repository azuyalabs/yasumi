<?php

/**
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 - 2018 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <stelgenhof@gmail.com>
 */

namespace Yasumi\Provider;

use Yasumi\Holiday;

/**
 * Provider for all holidays in Latvia.
 *
 * @author Gedas Lukošius <gedas@lukosius.me>
 */
class Latvia extends AbstractProvider
{
    use CommonHolidays, ChristianHolidays;

    const RESTORATION_OF_INDEPENDENCE_YEAR = 1990;

    const PROCLAMATION_OF_INDEPENDENCE_YEAR = 1918;

    /**
     * Code to identify this Holiday Provider. Typically this is the ISO3166 code corresponding to the respective
     * country or sub-region.
     */
    const ID = 'LV';

    /**
     * Initialize holidays for Latvia.
     *
     * @throws \InvalidArgumentException
     * @throws \Exception
     */
    public function initialize()
    {
        $this->timezone = 'Europe/Riga';

        // Official
        $this->addHoliday($this->newYearsDay($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->goodFriday($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->easter($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->easterMonday($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->internationalWorkersDay($this->year, $this->timezone, $this->locale));
        $this->addRestorationOfIndependenceDay();
        $this->addMidsummerEveDay();
        $this->addHoliday($this->stJohnsDay($this->year, $this->timezone, $this->locale));
        $this->addProclamationDay();
        $this->addHoliday($this->christmasEve($this->year, $this->timezone, $this->locale, Holiday::TYPE_OFFICIAL));
        $this->addHoliday($this->christmasDay($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->secondChristmasDay($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->newYearsEve($this->year, $this->timezone, $this->locale));
    }

    /**
     * On 4 May 1990. Latvia proclaimed its independence from the USSR, and restoration of the Republic of Latvia.
     * If the day is on the weekend the next Monday is a holiday.
     *
     * @throws \InvalidArgumentException
     * @throws \TypeError
     */
    private function addRestorationOfIndependenceDay()
    {
        if ($this->year >= self::RESTORATION_OF_INDEPENDENCE_YEAR) {
            $date = new \DateTime("{$this->year}-05-04", new \DateTimeZone($this->timezone));

            if (! $this->isWorkingDay($date)) {
                $date->modify('next monday');
            }

            $this->addHoliday(new Holiday('restorationOfIndependenceOfLatviaDay', [
                'en_US' => 'Restoration of Independence day',
                'lv_LV' => 'Latvijas Republikas Neatkarības atjaunošanas diena'
            ], $date));
        }
    }

    /**
     * @throws \InvalidArgumentException
     */
    private function addMidsummerEveDay()
    {
        $this->addHoliday(new Holiday('midsummerEveDay', [
            'en_US' => 'Midsummer Eve',
            'lv_LV' => 'Līgo Diena'
        ], new \DateTime("{$this->year}-06-23", new \DateTimeZone($this->timezone))));
    }

    /**
     * The independence of Latvia was proclaimed on this day in 1918.
     * If the day is on the weekend the next Monday is a holiday.
     *
     * @throws \InvalidArgumentException
     * @throws \TypeError
     */
    private function addProclamationDay()
    {
        if ($this->year >= self::PROCLAMATION_OF_INDEPENDENCE_YEAR) {
            $date = new \DateTime("{$this->year}-11-18", new \DateTimeZone($this->timezone));

            if (! $this->isWorkingDay($date)) {
                $date->modify('next monday');
            }

            $this->addHoliday(new Holiday('proclamationOfTheRepublicOfLatviaDay', [
                'en_US' => 'Proclamation Day of the Republic of Latvia',
                'lv_LV' => 'Latvijas Republikas proklamēšanas diena'
            ], $date));
        }
    }
}
