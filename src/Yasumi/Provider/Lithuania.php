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
 * Provider for all holidays in Lithuania.
 *
 * @author Gedas Lukošius <gedas@lukosius.me>
 */
class Lithuania extends AbstractProvider
{
    use CommonHolidays;
    use ChristianHolidays;

    /**
     * Code to identify this Holiday Provider. Typically, this is the ISO3166 code corresponding to the respective
     * country or sub-region.
     */
    public const ID = 'LT';

    /**
     * The year when The Act of Reinstating Independence of Lithuania was signed.
     */
    public const RESTORATION_OF_THE_STATE_YEAR = 1918;

    /**
     * The year when The Act of the Re-Establishment of the State of Lithuania was signed.
     */
    public const RESTORATION_OF_INDEPENDENCE_YEAR = 1990;

    /**
     * A year when Mindaugas was crowned as the only King of Lithuania.
     */
    public const STATEHOOD_YEAR = 1253;

    /**
     * The year when All Souls Day became a holiday.
     */
    public const ALL_SOULS_DAY = 2020;

    /**
     * Initialize holidays for Lithuania.
     *
     * @throws \InvalidArgumentException
     * @throws \Exception
     */
    public function initialize(): void
    {
        $this->timezone = 'Europe/Vilnius';

        // Official
        $this->addHoliday($this->newYearsDay($this->year, $this->timezone, $this->locale));
        $this->addRestorationOfTheStateDay();
        $this->addRestorationOfIndependenceDay();
        $this->addHoliday($this->easter($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->easterMonday($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->internationalWorkersDay($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->stJohnsDay($this->year, $this->timezone, $this->locale));
        $this->addStatehoodDay();
        $this->addHoliday($this->assumptionOfMary($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->allSaintsDay($this->year, $this->timezone, $this->locale));
        $this->addAllSoulsDay();
        $this->addHoliday($this->christmasEve($this->year, $this->timezone, $this->locale, Holiday::TYPE_OFFICIAL));
        $this->addHoliday($this->christmasDay($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->secondChristmasDay($this->year, $this->timezone, $this->locale));
    }

    public function getSources(): array
    {
        return [
            'https://en.wikipedia.org/wiki/Public_holidays_in_Lithuania',
            'https://lt.wikipedia.org/wiki/S%C4%85ra%C5%A1as:Lietuvos_%C5%A1vent%C4%97s',
        ];
    }

    /**
     * The Act of Reinstating Independence of Lithuania was signed on February 16, 1918.
     *
     * @throws \InvalidArgumentException
     * @throws \Exception
     */
    private function addRestorationOfTheStateDay(): void
    {
        if ($this->year >= self::RESTORATION_OF_THE_STATE_YEAR) {
            $this->addHoliday(new Holiday('restorationOfTheStateOfLithuaniaDay', [
                'en' => 'Day of Restoration of the State of Lithuania',
                'lt' => 'Lietuvos valstybės atkūrimo diena',
            ], new \DateTime("$this->year-02-16", new \DateTimeZone($this->timezone))));
        }
    }

    /**
     * The Act of the Re-Establishment of the State of Lithuania was signed on March 11, 1990.
     *
     * @throws \InvalidArgumentException
     * @throws \Exception
     */
    private function addRestorationOfIndependenceDay(): void
    {
        if ($this->year >= self::RESTORATION_OF_INDEPENDENCE_YEAR) {
            $this->addHoliday(new Holiday('restorationOfIndependenceOfLithuaniaDay', [
                'en' => 'Day of Restoration of Independence of Lithuania',
                'lt' => 'Lietuvos nepriklausomybės atkūrimo diena',
            ], new \DateTime("$this->year-03-11", new \DateTimeZone($this->timezone))));
        }
    }

    /**
     * Statehood Day is an annual public holiday in Lithuania celebrated on July 6 to commemorate
     * the coronation in 1253 of Mindaugas as the only King of Lithuania.
     *
     * @throws \InvalidArgumentException
     * @throws \Exception
     */
    private function addStatehoodDay(): void
    {
        if ($this->year >= self::STATEHOOD_YEAR) {
            $this->addHoliday(new Holiday('statehoodDay', [
                'en' => 'Statehood Day (Lithuania)',
                'lt' => 'Valstybės (Lietuvos karaliaus Mindaugo karūnavimo) diena',
            ], new \DateTime("$this->year-07-06", new \DateTimeZone($this->timezone)), $this->locale));
        }
    }

    /**
     * All Souls Day, also known as the Commemoration of All the Faithful Departed and the Day of the Dead.
     *
     * @throws \InvalidArgumentException
     * @throws \Exception
     */
    private function addAllSoulsDay(): void
    {
        if ($this->year >= self::ALL_SOULS_DAY) {
            $this->addHoliday(new Holiday(
                'allSoulsDay',
                [],
                new \DateTime("$this->year-11-02", DateTimeZoneFactory::getDateTimeZone($this->timezone)),
                $this->locale
            ));
        }
    }
}
