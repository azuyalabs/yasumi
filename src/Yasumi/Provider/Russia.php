<?php

declare(strict_types=1);
/*
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 - 2022 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <me at sachatelgenhof dot com>
 */

namespace Yasumi\Provider;

use Yasumi\Holiday;

/**
 * Provider for all holidays in Russia.
 *
 * @author Gedas Lukošius <gedas@lukosius.me>
 */
class Russia extends AbstractProvider
{
    use CommonHolidays;

    public const DEFENCE_OF_THE_FATHERLAND_START_YEAR = 1919;

    public const RUSSIA_DAY_START_YEAR = 1990;

    public const UNITY_DAY_START_YEAR = 2005;

    /**
     * Code to identify this Holiday Provider. Typically, this is the ISO3166 code corresponding to the respective
     * country or sub-region.
     */
    public const ID = 'RU';

    /**
     * Initialize holidays for Russia.
     *
     * @throws \InvalidArgumentException
     * @throws \Exception
     */
    public function initialize(): void
    {
        $this->timezone = 'Europe/Moscow';

        // Official
        $this->addHoliday($this->newYearsDay($this->year, $this->timezone, $this->locale));
        $this->addNewYearsHolidays();
        $this->addOrthodoxChristmasDay();
        $this->addDefenceOfTheFatherlandDay();
        $this->addInternationalWomensDay();
        $this->addSpringAndLabourDay();
        $this->addVictoryDay();
        $this->addRussiaDay();
        $this->addUnityDay();
    }

    public function getSources(): array
    {
        return [
            'https://en.wikipedia.org/wiki/Public_holidays_in_Russia',
            'https://ru.wikipedia.org/wiki/%D0%9F%D1%80%D0%B0%D0%B7%D0%B4%D0%BD%D0%B8%D0%BA%D0%B8_%D0%A0%D0%BE%D1%81%D1%81%D0%B8%D0%B8',
        ];
    }

    /**
     * @throws \InvalidArgumentException
     * @throws \Exception
     */
    private function addNewYearsHolidays(): void
    {
        $holidayDays = [2, 3, 4, 5, 6, 8];

        foreach ($holidayDays as $day) {
            $this->addHoliday(new Holiday('newYearHolidaysDay'.$day, [
                'en' => 'New Year’s holidays',
                'ru' => 'Новогодние каникулы',
            ], new \DateTime("$this->year-01-$day", new \DateTimeZone($this->timezone)), $this->locale));
        }
    }

    /**
     * @throws \InvalidArgumentException
     * @throws \Exception
     */
    private function addOrthodoxChristmasDay(): void
    {
        $this->addHoliday(new Holiday('orthodoxChristmasDay', [
            'en' => 'Orthodox Christmas Day',
            'ru' => 'Рождество',
        ], new \DateTime("$this->year-01-07", new \DateTimeZone($this->timezone)), $this->locale));
    }

    /**
     * @throws \InvalidArgumentException
     * @throws \Exception
     */
    private function addDefenceOfTheFatherlandDay(): void
    {
        if ($this->year < self::DEFENCE_OF_THE_FATHERLAND_START_YEAR) {
            return;
        }

        $this->addHoliday(new Holiday('defenceOfTheFatherlandDay', [
            'en' => 'Defence of the Fatherland Day',
            'ru' => 'День защитника Отечества',
        ], new \DateTime("$this->year-02-23", new \DateTimeZone($this->timezone)), $this->locale));
    }

    /**
     * @throws \InvalidArgumentException
     * @throws \Exception
     */
    private function addInternationalWomensDay(): void
    {
        $this->addHoliday($this->internationalWomensDay($this->year, $this->timezone, $this->locale));
    }

    /**
     * @throws \InvalidArgumentException
     * @throws \Exception
     */
    private function addSpringAndLabourDay(): void
    {
        $this->addHoliday(new Holiday('springAndLabourDay', [
            'en' => 'Spring and Labour Day',
            'ru' => 'Праздник Весны и Труда',
        ], new \DateTime("$this->year-05-01", new \DateTimeZone($this->timezone)), $this->locale));
    }

    /**
     * @throws \InvalidArgumentException
     * @throws \Exception
     */
    private function addVictoryDay(): void
    {
        $this->addHoliday(new Holiday('victoryDay', [
            'en' => 'Victory Day',
            'ru' => 'День Победы',
        ], new \DateTime("$this->year-05-09", new \DateTimeZone($this->timezone)), $this->locale));
    }

    /**
     * @throws \InvalidArgumentException
     * @throws \Exception
     */
    private function addRussiaDay(): void
    {
        if ($this->year < self::RUSSIA_DAY_START_YEAR) {
            return;
        }

        $this->addHoliday(new Holiday('russiaDay', [
            'en' => 'Russia Day',
            'ru' => 'День России',
        ], new \DateTime("$this->year-06-12", new \DateTimeZone($this->timezone)), $this->locale));
    }

    /**
     * @throws \InvalidArgumentException
     * @throws \Exception
     */
    private function addUnityDay(): void
    {
        if ($this->year < self::UNITY_DAY_START_YEAR) {
            return;
        }

        $this->addHoliday(new Holiday('unityDay', [
            'en' => 'Unity Day',
            'ru' => 'День народного единства',
        ], new \DateTime("$this->year-11-04", new \DateTimeZone($this->timezone)), $this->locale));
    }
}
