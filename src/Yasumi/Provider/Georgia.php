<?php

declare(strict_types=1);
/*
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 - 2021 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <me@sachatelgenhof.com>
 */

namespace Yasumi\Provider;

use Yasumi\Holiday;

/**
 * Provider for all holidays in Georgia.
 *
 * @author  Zurab Sardarov <zurab.sardarov@gmail.com>
 */
class Georgia extends AbstractProvider
{
    use CommonHolidays;
    use ChristianHolidays;

    public const PROCLAMATION_OF_INDEPENDENCE_YEAR = 1918;

    public const APRIL_NINE_TRAGEDY_YEAR = 1989;

    /**
     * Code to identify this Holiday Provider. Typically this is the ISO3166 code corresponding to the respective
     * country or sub-region.
     */
    public const ID = 'GE';

    /**
     * Initialize holidays for Georgia.
     *
     * @throws \InvalidArgumentException
     * @throws \Exception
     */
    public function initialize(): void
    {
        $this->timezone = 'Asia/Tbilisi';

        $this->addHoliday($this->newYearsDay($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->internationalWomensDay($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->easter($this->year, $this->timezone, $this->locale));

        $this->addSecondNewYearDay();
        $this->addOrthodoxChristmasDay();
        $this->addIndependenceDay();
        $this->addMothersDay();
        $this->addUnityDay();
        $this->addVictoryDay();
        $this->addStAndrewsDay();
        $this->addOrthodoxEpiphanyDay();
        $this->addMtskhetobaDay();
        $this->addStMarysDay();
        $this->addStGeorgesDay();
    }

    /**
     * @throws \Exception
     */
    public function calculateEaster(int $year, string $timezone): \DateTime
    {
        return $this->calculateOrthodoxEaster($year, $timezone);
    }

    /**
     * @throws \InvalidArgumentException
     * @throws \Exception
     */
    private function addOrthodoxChristmasDay(): void
    {
        $date = new \DateTime("$this->year-01-07", new \DateTimeZone($this->timezone));

        $this->addHoliday(new Holiday('orthodoxChristmasDay', [
            'en' => 'Orthodox Christmas Day',
            'ka' => 'ქრისტეს შობა',
        ], $date, $this->locale));
    }

    /**
     * @throws \InvalidArgumentException
     * @throws \Exception
     */
    private function addIndependenceDay(): void
    {
        if ($this->year >= self::PROCLAMATION_OF_INDEPENDENCE_YEAR) {
            $date = new \DateTime("$this->year-05-26", new \DateTimeZone($this->timezone));

            $this->addHoliday(new Holiday('independenceDay', [
                'en' => 'Independence Day',
                'ka' => 'საქართველოს დამოუკიდებლობის დღე',
            ], $date, $this->locale));
        }
    }

    /**
     * @throws \InvalidArgumentException
     * @throws \Exception
     */
    private function addUnityDay(): void
    {
        if ($this->year >= self::APRIL_NINE_TRAGEDY_YEAR) {
            $date = new \DateTime("$this->year-04-09", new \DateTimeZone($this->timezone));

            $this->addHoliday(new Holiday('unityDay', [
                'en' => 'National Unity Day',
                'ka' => 'ეროვნული ერთიანობის დღე',
            ], $date, $this->locale));
        }
    }

    /**
     * @throws \InvalidArgumentException
     * @throws \Exception
     */
    private function addMothersDay(): void
    {
        $date = new \DateTime("$this->year-03-03", new \DateTimeZone($this->timezone));

        $this->addHoliday(new Holiday('mothersDay', [
            'en' => 'Mothers Day',
            'ka' => 'დედის დღე',
        ], $date, $this->locale));
    }

    /**
     * @throws \InvalidArgumentException
     * @throws \Exception
     */
    private function addVictoryDay(): void
    {
        $date = new \DateTime("$this->year-05-09", new \DateTimeZone($this->timezone));

        $this->addHoliday(new Holiday('victoryDay', [
            'en' => 'Day of Victory over Fascism',
            'ka' => 'ფაშიზმზე გამარჯვების დღე',
        ], $date, $this->locale));
    }

    /**
     * @throws \InvalidArgumentException
     * @throws \Exception
     */
    private function addStAndrewsDay(): void
    {
        $date = new \DateTime("$this->year-05-12", new \DateTimeZone($this->timezone));

        $this->addHoliday(new Holiday('stAndrewsDay', [
            'en' => 'Saint Andrew the First-Called Day',
            'ka' => 'წმინდა ანდრია პირველწოდებულის ხსენების დღე',
        ], $date, $this->locale));
    }

    /**
     * @throws \InvalidArgumentException
     * @throws \Exception
     */
    private function addOrthodoxEpiphanyDay(): void
    {
        $date = new \DateTime("$this->year-01-19", new \DateTimeZone($this->timezone));

        $this->addHoliday(new Holiday('orthodoxEpiphanyDay', [
            'en' => 'Orthodox Epiphany Day',
            'ka' => 'ნათლისღება',
        ], $date, $this->locale));
    }

    /**
     * @throws \InvalidArgumentException
     * @throws \Exception
     */
    private function addStMarysDay(): void
    {
        $date = new \DateTime("$this->year-08-28", new \DateTimeZone($this->timezone));

        $this->addHoliday(new Holiday('stMarysDay', [
            'en' => 'Saint Marys Day',
            'ka' => 'მარიამობა',
        ], $date, $this->locale));
    }

    /**
     * @throws \InvalidArgumentException
     * @throws \Exception
     */
    private function addMtskhetobaDay(): void
    {
        $date = new \DateTime("$this->year-10-14", new \DateTimeZone($this->timezone));

        $this->addHoliday(new Holiday('mtskhetobaDay', [
            'en' => 'Day of Svetitskhoveli Cathedral',
            'ka' => 'მცხეთობა',
        ], $date, $this->locale));
    }

    /**
     * @throws \InvalidArgumentException
     * @throws \Exception
     */
    private function addStGeorgesDay(): void
    {
        $date = new \DateTime("$this->year-11-23", new \DateTimeZone($this->timezone));

        $this->addHoliday(new Holiday('stGeorgesDay', [
            'en' => 'Saint Georges Day',
            'ka' => 'გიორგობა',
        ], $date, $this->locale));
    }

    /**
     * @throws \InvalidArgumentException
     * @throws \Exception
     */
    private function addSecondNewYearDay(): void
    {
        $date = new \DateTime("$this->year-01-02", new \DateTimeZone($this->timezone));

        $this->addHoliday(new Holiday('secondDayOfNewYear', [
            'en' => 'Second day of the New Year',
            'ka' => 'ბედობა',
        ], $date, $this->locale));
    }
}
