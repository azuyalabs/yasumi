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
 * Provider for all holidays in Russia.
 *
 * @author Gedas Lukošius <gedas@lukosius.me>
 */
class Russia extends AbstractProvider
{
    use CommonHolidays;

    const DEFENCE_OF_THE_FATHERLAND_START_YEAR = 1919;

    const RUSSIA_DAY_START_YEAR = 1990;

    const UNITY_DAY_START_YEAR = 2005;

    /**
     * Code to identify this Holiday Provider. Typically this is the ISO3166 code corresponding to the respective
     * country or sub-region.
     */
    const ID = 'RU';

    /**
     * Initialize holidays for Russia.
     *
     * @throws \InvalidArgumentException
     */
    public function initialize()
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

    /**
     * @throws \InvalidArgumentException
     */
    private function addNewYearsHolidays()
    {
        $holidayDays = [2, 3, 4, 5, 6, 8];

        foreach ($holidayDays as $day) {
            $this->addHoliday(new Holiday(
                'newYearHolidaysDay' . $day,
                [
                    'en_US' => 'New Year\'s holidays',
                    'ru_RU' => 'Новогодние каникулы'
                ],
                new \DateTime("{$this->year}-01-{$day}", new \DateTimeZone($this->timezone))
            ));
        }
    }

    /**
     * @throws \InvalidArgumentException
     */
    private function addOrthodoxChristmasDay()
    {
        $this->addHoliday(new Holiday(
            'orthodoxChristmasDay',
            [
                'en_US' => 'Orthodox Christmas Day',
                'ru_RU' => 'Рождество'
            ],
            new \DateTime("{$this->year}-01-07", new \DateTimeZone($this->timezone))
        ));
    }

    /**
     * @throws \InvalidArgumentException
     */
    private function addDefenceOfTheFatherlandDay()
    {
        if ($this->year < self::DEFENCE_OF_THE_FATHERLAND_START_YEAR) {
            return;
        }

        $this->addHoliday(new Holiday(
            'defenceOfTheFatherlandDay',
            [
                'en_US' => 'Defence of the Fatherland Day',
                'ru_RU' => 'День защитника Отечества'
            ],
            new \DateTime("{$this->year}-02-23", new \DateTimeZone($this->timezone))
        ));
    }

    /**
     * @throws \InvalidArgumentException
     */
    private function addInternationalWomensDay()
    {
        $this->addHoliday(new Holiday(
            'internationalWomensDay',
            [
                'en_US' => 'International Women\'s Day',
                'ru_RU' => 'Международный женский день'
            ],
            new \DateTime("{$this->year}-03-08", new \DateTimeZone($this->timezone))
        ));
    }

    /**
     * @throws \InvalidArgumentException
     */
    private function addSpringAndLabourDay()
    {
        $this->addHoliday(new Holiday(
            'springAndLabourDay',
            [
                'en_US' => 'Spring and Labour Day',
                'ru_RU' => 'Праздник Весны и Труда'
            ],
            new \DateTime("{$this->year}-05-01", new \DateTimeZone($this->timezone))
        ));
    }

    /**
     * @throws \InvalidArgumentException
     */
    private function addVictoryDay()
    {
        $this->addHoliday(new Holiday(
            'victoryDay',
            [
                'en_US' => 'Victory Day',
                'ru_RU' => 'День Победы'
            ],
            new \DateTime("{$this->year}-05-09", new \DateTimeZone($this->timezone))
        ));
    }

    /**
     * @throws \InvalidArgumentException
     */
    private function addRussiaDay()
    {
        if ($this->year < self::RUSSIA_DAY_START_YEAR) {
            return;
        }

        $this->addHoliday(new Holiday(
            'russiaDay',
            [
                'en_US' => 'Russia Day',
                'ru_RU' => 'День России'
            ],
            new \DateTime("{$this->year}-06-12", new \DateTimeZone($this->timezone))
        ));
    }

    /**
     * @throws \InvalidArgumentException
     */
    private function addUnityDay()
    {
        if ($this->year < self::UNITY_DAY_START_YEAR) {
            return;
        }

        $this->addHoliday(new Holiday(
            'unityDay',
            [
                'en_US' => 'Unity Day',
                'ru_RU' => 'День народного единства'
            ],
            new \DateTime("{$this->year}-11-04", new \DateTimeZone($this->timezone))
        ));
    }
}
