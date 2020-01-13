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

use Yasumi\Exception\InvalidDateException;
use Yasumi\Exception\UnknownLocaleException;
use Yasumi\Holiday;

/**
 * Provider for all holidays in Ukraine.
 * https://en.wikipedia.org/wiki/Public_holidays_in_Ukraine
 *
 * Class Ukraine
 * @package Yasumi\Provider
 *
 * @author  Dmitry Machin <machin.dmitry@gmail.com>
 */
class Ukraine extends AbstractProvider
{
    use CommonHolidays, ChristianHolidays;

    /**
     * Code to identify this Holiday Provider.
     * Typically this is the ISO3166 code corresponding to the respective country or sub-region.
     */
    public const ID = 'UA';

    /**
     * Initialize holidays for Ukraine.
     *
     * @throws InvalidDateException
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    public function initialize(): void
    {
        $this->timezone = 'Europe/Kiev';

        // Add common holidays
        $this->addHoliday($this->newYearsDay($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->internationalWorkersDay($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->internationalWomensDay($this->year, $this->timezone, $this->locale));

        // Add Christian holidays
        $this->addHoliday($this->easter($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->pentecost($this->year, $this->timezone, $this->locale));

        // Add other holidays
        $this->calculateChristmasDay();
        $this->calculateSecondInternationalWorkersDay();
        $this->calculateVictoryDay();
        $this->calculateConstitutionDay();
        $this->calculateIndependenceDay();
        $this->calculateDefenderOfUkraineDay();
    }

    /**
     * Christmas Day.
     *
     * @throws InvalidDateException
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    private function calculateChristmasDay(): void
    {
        $this->addHoliday(new Holiday(
            'christmasDay',
            [],
            new \DateTime("$this->year-01-07", new \DateTimeZone($this->timezone)),
            $this->locale
        ));
    }

    /**
     * International Workers' Day.
     *
     * @link https://en.wikipedia.org/wiki/International_Workers%27_Day#Ukraine
     *
     * @throws InvalidDateException
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    private function calculateSecondInternationalWorkersDay(): void
    {
        $this->addHoliday(new Holiday('secondInternationalWorkersDay', [
            'uk' => 'День міжнародної солідарності трудящих',
            'ru' => 'День международной солидарности трудящихся',
        ], new \DateTime("$this->year-05-02", new \DateTimeZone($this->timezone)), $this->locale));
    }

    /**
     * Victory Day over Nazism in World War II
     *
     * Victory Day over Nazism in World War II (Ukrainian: День перемоги над нацизмом у Другій світовій війні)
     * or Victory Day (Ukrainian: День перемоги) is a national holiday and a day off in Ukraine.
     * It was first celebrated on 9 May 2015 and follows the Day of Remembrance and Reconciliation on May 8.
     * The holiday replaced the Soviet "Victory Day", which was celebrated in the post-Soviet Union states, including
     * Ukraine, until 2014 inclusive.
     *
     * @link https://en.wikipedia.org/wiki/Victory_Day_over_Nazism_in_World_War_II
     *
     * @throws InvalidDateException
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    private function calculateVictoryDay(): void
    {
        $this->addHoliday(new Holiday(
            'victoryDay',
            ['uk' => 'День перемоги', 'ru' => 'День победы'],
            new \DateTime("$this->year-05-09", new \DateTimeZone($this->timezone)),
            $this->locale
        ));
    }

    /**
     * Constitution Day
     *
     * Constitution Day (Ukrainian: День Конституції) is an Ukrainian public holiday celebrated on 28 June since 1996.
     *
     * @link https://en.wikipedia.org/wiki/Constitution_Day_(Ukraine)
     *
     * @throws InvalidDateException
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    private function calculateConstitutionDay(): void
    {
        if ($this->year < 1996) {
            return;
        }

        $this->addHoliday(new Holiday(
            'constitutionDay',
            ['uk' => 'День Конституції', 'ru' => 'День Конституции'],
            new \DateTime("$this->year-06-28", new \DateTimeZone($this->timezone)),
            $this->locale
        ));
    }

    /**
     * Independence Day
     *
     * The Act of Declaration of Independence of Ukraine (Ukrainian: Акт проголошення незалежності України, translit.
     * Akt proholoshennya nezalezhnosti Ukrayiny) was adopted by the Ukrainian parliament on 24 August 1991.
     * The Act established Ukraine as an independent state.
     *
     * @link https://en.wikipedia.org/wiki/Declaration_of_Independence_of_Ukraine
     *
     * @throws InvalidDateException
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    private function calculateIndependenceDay(): void
    {
        if ($this->year < 1991) {
            return;
        }

        $this->addHoliday(new Holiday(
            'independenceDay',
            ['uk' => 'День Незалежності', 'ru' => 'День Независимости'],
            new \DateTime("$this->year-08-24", new \DateTimeZone($this->timezone)),
            $this->locale
        ));
    }

    /**
     * Defender of Ukraine Day
     *
     * Defender of Ukraine Day (Ukrainian: День захисника України, Denʹ zakhysnyka Ukrayiny)
     * is a state holiday in Ukraine celebrated annually on October 14.
     * Its first celebration was in 2015.
     * Starting from 2015, this day is considered a public holiday (this is thus a day off in Ukraine)
     *
     * @link https://en.wikipedia.org/wiki/Defender_of_Ukraine_Day
     *
     * @throws InvalidDateException
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    private function calculateDefenderOfUkraineDay(): void
    {
        if ($this->year < 2015) {
            return;
        }

        $this->addHoliday(new Holiday(
            'defenderOfUkraineDay',
            ['uk' => 'День захисника України', 'ru' => 'День Защитника Украины'],
            new \DateTime("$this->year-10-14", new \DateTimeZone($this->timezone)),
            $this->locale
        ));
    }

    /**
     * @param int $year
     * @param string $timezone
     *
     * @return \DateTime
     *
     * @throws \Exception
     */
    public function calculateEaster(int $year, string $timezone): \DateTime
    {
        return $this->calculateOrthodoxEaster($year, $timezone);
    }
}
