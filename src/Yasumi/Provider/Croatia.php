<?php

declare(strict_types = 1);

/**
 * This file is part of the 'Yasumi' package.
 *
 * The easy PHP Library for calculating holidays.
 *
 * Copyright (c) 2015 - 2024 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <me at sachatelgenhof dot com>
 */

namespace Yasumi\Provider;

use Yasumi\Exception\UnknownLocaleException;
use Yasumi\Holiday;

/**
 * Provider for all holidays in Croatia.
 *
 * @author Karlo Mikus <contact@karlomikus.com>
 */
class Croatia extends AbstractProvider
{
    use CommonHolidays;
    use ChristianHolidays;

    /**
     * Code to identify this Holiday Provider. Typically, this is the ISO3166 code corresponding to the respective
     * country or sub-region.
     */
    public const ID = 'HR';

    /**
     * Initialize holidays for Croatia.
     *
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    public function initialize(): void
    {
        $this->timezone = 'Europe/Zagreb';

        // Add common holidays
        $this->addHoliday($this->newYearsDay($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->internationalWorkersDay($this->year, $this->timezone, $this->locale));

        // Add Christian holidays
        $this->addHoliday($this->epiphany($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->easter($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->easterMonday($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->corpusChristi($this->year, $this->timezone, $this->locale, Holiday::TYPE_OFFICIAL));
        $this->addHoliday($this->assumptionOfMary($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->allSaintsDay($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->christmasDay($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->stStephensDay($this->year, $this->timezone, $this->locale));

        // Add other holidays
        $this->calculateAntiFascistsStruggleDay();
        $this->calculateStatehoodDay();
        $this->calculateHomelandThanksgivingDay();
        $this->calculateIndependenceDay();
        $this->calculateRemembranceDayForHomelandWarVictims();
    }

    public function getSources(): array
    {
        return [
            'https://en.wikipedia.org/wiki/Public_holidays_in_Croatia',
            'https://sh.wikipedia.org/wiki/Praznici_u_Hrvatskoj',
            'https://hr.wikipedia.org/wiki/Blagdani_i_spomendani_u_Hrvatskoj',
        ];
    }

    /**
     * Starting from the year 2020. statehood day is celebrated at a new date
     * Source: https://narodne-novine.nn.hr/clanci/sluzbeni/2019_11_110_2212.html.
     *
     * @throws \Exception
     */
    protected function calculateStatehoodDay(): void
    {
        if ($this->year >= 1991) {
            $statehoodDayDate = new \DateTime($this->year >= 2020 ? "{$this->year}-5-30" : "{$this->year}-6-25", DateTimeZoneFactory::getDateTimeZone($this->timezone));
            $this->addHoliday(new Holiday('statehoodDay', [
                'en' => 'Statehood Day',
                'hr' => 'Dan državnosti',
            ], $statehoodDayDate, $this->locale));
        }
    }

    /**
     * Starting from the year 2020. Homeland Thanksgiving Day name is slightly changed
     * Source: https://narodne-novine.nn.hr/clanci/sluzbeni/2019_11_110_2212.html.
     *
     * @throws \Exception
     */
    protected function calculateHomelandThanksgivingDay(): void
    {
        $names = [];
        if ($this->year >= 1995 && $this->year < 2020) {
            $names['en'] = 'Homeland Thanksgiving Day';
            $names['hr'] = 'Dan domovinske zahvalnosti';
        } elseif ($this->year >= 2020) {
            $names['en'] = 'Victory and Homeland Thanksgiving Day and the Day of Croatian Defenders';
            $names['hr'] = 'Dan pobjede i domovinske zahvalnosti i Dan hrvatskih branitelja';
        }

        if ([] !== $names) {
            $this->addHoliday(new Holiday(
                'homelandThanksgiving',
                $names,
                new \DateTime("{$this->year}-8-5", DateTimeZoneFactory::getDateTimeZone($this->timezone)),
                $this->locale
            ));
        }
    }

    /**
     * Starting from the year 2020. Independence Day is no longer an official holiday,
     * but is still remembered under a different name as Croatian Parliament Day (Dan Hrvatskog sabora)
     * Source: https://narodne-novine.nn.hr/clanci/sluzbeni/2019_11_110_2212.html.
     *
     * @throws \Exception
     */
    protected function calculateIndependenceDay(): void
    {
        if ($this->year < 1991) {
            return;
        }

        if ($this->year >= 2020) {
            return;
        }

        $this->addHoliday(new Holiday('independenceDay', [
            'en' => 'Independence Day',
            'hr' => 'Dan neovisnosti',
        ], new \DateTime("{$this->year}-10-8", DateTimeZoneFactory::getDateTimeZone($this->timezone)), $this->locale));
    }

    /**
     * Starting from the year 2020. a new holiday was added
     * Source: https://narodne-novine.nn.hr/clanci/sluzbeni/2019_11_110_2212.html.
     *
     * @throws \Exception
     */
    protected function calculateRemembranceDayForHomelandWarVictims(): void
    {
        if ($this->year >= 2020) {
            $this->addHoliday(new Holiday('remembranceDay', [
                'en' => 'Remembrance Day for Homeland War Victims and Remembrance Day for the Victims of Vukovar and Skabrnja',
                'hr' => 'Dan sjećanja na žrtve Domovinskog rata i Dan sjećanja na žrtvu Vukovara i Škabrnje',
            ], new \DateTime("{$this->year}-11-18", DateTimeZoneFactory::getDateTimeZone($this->timezone)), $this->locale));
        }
    }

    /*
     * Day of Antifascist Struggle
     */
    protected function calculateAntiFascistsStruggleDay(): void
    {
        if ($this->year >= 1941) {
            $this->addHoliday(new Holiday('antifascistStruggleDay', [
                'en' => 'Day of Antifascist Struggle',
                'hr' => 'Dan antifašističke borbe',
            ], new \DateTime("{$this->year}-6-22", DateTimeZoneFactory::getDateTimeZone($this->timezone)), $this->locale));
        }
    }
}
