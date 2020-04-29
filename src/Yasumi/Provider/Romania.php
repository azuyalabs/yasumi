<?php declare(strict_types=1);
/**
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 - 2020 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <me@sachatelgenhof.com>
 */

namespace Yasumi\Provider;

use DateTime;
use Yasumi\Exception\InvalidDateException;
use Yasumi\Exception\UnknownLocaleException;
use Yasumi\Holiday;

/**
 * Provider for all holidays in Romania.
 * https://en.wikipedia.org/wiki/Public_holidays_in_Romania
 *
 * Class Romania
 * @package Yasumi\Provider
 * @author  Angelin Calu <angelin.calu@gmail.com>
 */
class Romania extends AbstractProvider
{
    use CommonHolidays, ChristianHolidays;

    /**
     * Code to identify this Holiday Provider.
     * Typically this is the ISO3166 code corresponding to the respective country or sub-region.
     */
    public const ID = 'RO';

    /**
     * Initialize holidays for Romania.
     *
     * @throws InvalidDateException
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    public function initialize(): void
    {
        $this->timezone = 'Europe/Bucharest';

        // Add common holidays
        $this->addHoliday($this->newYearsDay($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->internationalWorkersDay($this->year, $this->timezone, $this->locale));

        // Add Christian holidays
        $this->addHoliday($this->easter($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->easterMonday($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->christmasDay($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->secondChristmasDay($this->year, $this->timezone, $this->locale));

        // Pentecost (50th and 51st day after Easter) and Asumption of Mary (15.08) were added as legal holidays acc. to the Law '202/2008'
        if ($this->year >= 2008) {
            $this->addHoliday($this->pentecost($this->year, $this->timezone, $this->locale));
            $this->addHoliday($this->pentecostMonday($this->year, $this->timezone, $this->locale));
            $this->addHoliday($this->assumptionOfMary($this->year, $this->timezone, $this->locale));
        }

        // Add other holidays
        $this->calculateDayAfterNewYearsDay();  //2nd of January
        $this->calculateUnitedPrincipalitiesDay();  //since 21.12.2014 (Law 171/2014), celebrated on 24th of January
        $this->calculateStAndrewDay();  //since 24.07.2012 (Law 147/2012), celebrated on 30th of November
        $this->calculateNationalDay();  //after 1990, celebrated on December 1st
        $this->calculateConstantinBrancusiDay();
        $this->calculateChildrensDay(); // Since 18.11.2016 (Law 220/2016), Celebrated on 1st of June
    }

    /**
     * Day after New Year's Day
     *
     * 2nd of January one of Romania's official non-working holidays
     *
     * @link https://en.wikipedia.org/wiki/Public_holidays_in_Romania
     *
     * @throws InvalidDateException
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    private function calculateDayAfterNewYearsDay(): void
    {
        $this->addHoliday(new Holiday(
            'dayAfterNewYearsDay',
            [],
            new DateTime("$this->year-01-02", DateTimeZoneFactory::getDateTimeZone($this->timezone)),
            $this->locale
        ));
    }

    /**
     * Celebration of United Principalities
     *
     * On 24 January 1862, the Principality of Moldavia and the Principality of Wallachia
     * formally united to create the Romanian United Principalities.
     * It is officially a non-working holiday since 7 October 2016.
     *
     *
     * @link https://en.wikipedia.org/wiki/United_Principalities
     *
     * @throws InvalidDateException
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    private function calculateUnitedPrincipalitiesDay(): void
    {
        // The law is official since 21.12.2014.
        if ($this->year > 2014) {
            $this->addHoliday(new Holiday('unitedPrincipalitiesDay', [
                'en' => 'Union Day / Small Union',
                'ro' => 'Unirea Principatelor Române / Mica Unire',
            ], new DateTime("$this->year-01-24", DateTimeZoneFactory::getDateTimeZone($this->timezone)), $this->locale));
        }
    }

    /**
     * St. Andrew's day
     *
     * Saint Andrew is the patron saint of Romania.
     *
     * @link https://en.wikipedia.org/wiki/St._Andrew%27s_Day
     *
     * @throws InvalidDateException
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    private function calculateStAndrewDay(): void
    {
        if ($this->year >= 2012) {
            $this->addHoliday(new Holiday(
                'stAndrewsDay',
                [],
                new DateTime($this->year . '-11-30', DateTimeZoneFactory::getDateTimeZone($this->timezone)),
                $this->locale
            ));
        }
    }

    /**
     * National Day.
     *
     * Great Union Day (Romanian: Ziua Marii Uniri, also called Unification Day) .
     * Occurring on December 1, is the national holiday of Romania.
     * It commemorates the assembly of the delegates of ethnic Romanians held in Alba Iulia,
     * which declared the Union of Transylvania with Romania.
     *
     * @link https://en.wikipedia.org/wiki/Great_Union_Day
     * @link https://ro.wikipedia.org/wiki/Ziua_na%C8%9Bional%C4%83_a_Rom%C3%A2niei
     *
     * @throws InvalidDateException
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    private function calculateNationalDay(): void
    {
        $nationalDay = null;

        //@link https://en.wikipedia.org/wiki/Great_Union_Day
        if ($this->year >= 1990) {
            $nationalDay = "$this->year-12-01";
        }

        if ($this->year >= 1948 && $this->year <= 1989) {
            $nationalDay = "$this->year-08-23";
        }

        if ($this->year >= 1866 && $this->year <= 1947) {
            $nationalDay = "$this->year-05-10";
        }

        if (\is_string($nationalDay)) {
            $this->addHoliday(new Holiday('nationalDay', [
                'en' => 'National Day',
                'ro' => 'Ziua Națională',
            ], new DateTime($nationalDay, DateTimeZoneFactory::getDateTimeZone($this->timezone)), $this->locale));
        }
    }

    /**
     * Constantin Brancusi Day
     *
     * Constantin Brâncuși (February 19, 1876 – March 16, 1957) was a Romanian sculptor, painter and photographer.
     *
     * @link https://en.wikipedia.org/wiki/Constantin_Br%C3%A2ncu%C8%99i
     * @throws InvalidDateException
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    private function calculateConstantinBrancusiDay(): void
    {
        if ($this->year >= 2016) {
            $this->addHoliday(new Holiday(
                'constantinBrancusiDay',
                [
                    'en' => 'Constantin Brâncuși day',
                    'ro' => 'Ziua Constantin Brâncuși',
                ],
                new DateTime("$this->year-02-19", DateTimeZoneFactory::getDateTimeZone($this->timezone)),
                $this->locale,
                Holiday::TYPE_OBSERVANCE
            ));
        }
    }

    /**
     * Children's Day
     *
     * International Children's Day becamed a public Holiday in Romania starting with 2017
     * according to the Law 220/2016 (18.11.2016)
     *
     * @link https://en.wikipedia.org/wiki/Children%27s_Day
     * @throws InvalidDateException
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     * @throws \Exception
     */
    private function calculateChildrensDay(): void
    {
        if ($this->year >= 1950 && $this->year <= 2016) {
            $this->addHoliday(new Holiday(
                'childrensDay',
                [
                    'en' => 'International Children’s Day',
                    'ro' => 'Ziua Copilului',
                ],
                new DateTime("$this->year-06-01", DateTimeZoneFactory::getDateTimeZone($this->timezone)),
                $this->locale,
                Holiday::TYPE_OBSERVANCE
            ));
        }

        if ($this->year >= 2017) {
            $this->addHoliday(new Holiday('childrensDay', [
                'en' => 'International Children’s Day',
                'ro' => 'Ziua Copilului',
            ], new DateTime("$this->year-06-01", DateTimeZoneFactory::getDateTimeZone($this->timezone)), $this->locale));
        }
    }

    /**
     * @param int $year
     * @param string $timezone
     *
     * @return DateTime
     *
     * @throws \Exception
     */
    public function calculateEaster(int $year, string $timezone): DateTime
    {
        return $this->calculateOrthodoxEaster($year, $timezone);
    }
}
