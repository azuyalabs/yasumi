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

namespace Yasumi\Provider;

use Yasumi\Holiday;

class Bulgaria extends AbstractProvider
{
    use CommonHolidays;
    use ChristianHolidays;

    public const ID = 'BG';

    public function initialize(): void
    {
        $this->timezone = 'Europe/Sofia';

        // Add common holidays
        $this->addHoliday($this->newYearsDay($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->internationalWorkersDay($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->stGeorgesDay($this->year, $this->timezone, $this->locale));

        // Add Christian holidays
        $this->addHoliday($this->christmasEve($this->year, $this->timezone, $this->locale, Holiday::TYPE_OFFICIAL));
        $this->addHoliday($this->christmasDay($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->secondChristmasDay($this->year, $this->timezone, $this->locale));

        // Add other holidays
        $this->calculateEducationCultureSlavonicLiteratureDay();
        $this->calculateIndependenceDay();
        $this->calculateLiberationDay();
        $this->calculateOrthodoxEasterHolidays();
        $this->calculateStGeorgesDay();
        $this->calculateUnificationDay();
    }

    public function getSources(): array
    {
        return [
            'https://en.wikipedia.org/wiki/Public_holidays_in_Bulgaria',
            'https://bg.wikipedia.org/wiki/%D0%9E%D1%84%D0%B8%D1%86%D0%B8%D0%B0%D0%BB%D0%BD%D0%B8_%D0%BF%D1%80%D0%B0%D0%B7%D0%BD%D0%B8%D1%86%D0%B8_%D0%B2_%D0%91%D1%8A%D0%BB%D0%B3%D0%B0%D1%80%D0%B8%D1%8F',
        ];
    }

    private function calculateOrthodoxEasterHolidays(): void
    {
        $orthodoxEaster = $this->calculateOrthodoxEaster($this->year, $this->timezone);

        $this->addHoliday(new Holiday(
            'orthodoxEaster',
            ['en' => 'Orthodox Easter', 'bg' => 'Великден'],
            $orthodoxEaster,
            $this->locale,
            Holiday::TYPE_OFFICIAL
        ));

        $goodFriday = clone $orthodoxEaster;
        $goodFriday->sub(new \DateInterval('P2D'));
        $this->addHoliday(new Holiday(
            'orthodoxGoodFriday',
            ['en' => 'Orthodox Good Friday', 'bg' => 'Разпети петък'],
            $goodFriday,
            $this->locale,
            Holiday::TYPE_OFFICIAL
        ));

        $easterMonday = clone $orthodoxEaster;
        $easterMonday->add(new \DateInterval('P1D'));
        $this->addHoliday(new Holiday(
            'orthodoxEasterMonday',
            ['en' => 'Orthodox Easter Monday', 'bg' => 'Велики понеделник'],
            $easterMonday,
            $this->locale,
            Holiday::TYPE_OFFICIAL
        ));
    }

    /**
     * Liberation Day
     *
     * Liberation Day on March 3 marks the Liberation of Bulgaria from Ottoman rule in 1878.
     * However, it became an official holiday by decree 236 of the Chairman of the State
     * Council on 27 February 1990, coming into effect on 5 March.
     *
     * @throws \Exception
     */
    private function calculateLiberationDay(): void
    {
        if ($this->year >= 1990) {
            $this->addHoliday(new Holiday(
                'liberationDay',
                ['en' => 'Liberation Day', 'bg' => 'Ден на Освобождението на България от османско иго'],
                new \DateTime("{$this->year}-03-03", DateTimeZoneFactory::getDateTimeZone($this->timezone)),
                $this->locale
            ));
        }
    }

    /**
     * Bulgarian Education and Culture and Slavonic Literature Day
     *
     * May 24 celebrates the Bulgarian education, culture, and creation of the Cyrillic alphabet.
     *
     * @see https://en.wikipedia.org/wiki/Bulgarian_Education_and_Culture_and_Slavonic_Literature_Day
     *
     * @throws \Exception
     */
    private function calculateEducationCultureSlavonicLiteratureDay(): void
    {
        if ($this->year >= 1990) {
            $this->addHoliday(new Holiday(
                'educationCultureSlavonicLiteratureDay',
                ['en' => 'Bulgarian Education and Culture and Slavonic Literature Day', 'bg' => 'Ден на българската просвета и култура и на славянската писменост'],
                new \DateTime("{$this->year}-05-24", DateTimeZoneFactory::getDateTimeZone($this->timezone)),
                $this->locale
            ));
        }
    }

    /**
     * Saint George's Day
     *
     * @see https://en.wikipedia.org/wiki/Bulgarian_Armed_Forces_Day
     *
     * @throws \Exception
     */
    private function calculateStGeorgesDay(): void
    {
        $this->addHoliday(new Holiday(
            'stGeorgesDay',
            ['bg' => 'Гергьовден, ден на храбростта и Българската армия'],
            new \DateTime("{$this->year}-05-06", DateTimeZoneFactory::getDateTimeZone($this->timezone)),
            $this->locale
        ));
    }

    /**
     * Unification Day
     *
     * September 6 marks the unification of the Principality of Bulgaria and Eastern Rumelia in 1885.
     *
     * @see https://en.wikipedia.org/wiki/Unification_Day_(Bulgaria)
     * @see https://en.wikipedia.org/wiki/Bulgarian_unification
     *
     * @throws \Exception
     */
    private function calculateUnificationDay(): void
    {
        if ($this->year >= 1885) {
            $this->addHoliday(new Holiday(
                'unificationDay',
                ['en' => 'Unification Day', 'bg' => 'Ден на Съединението'],
                new \DateTime("{$this->year}-09-06", DateTimeZoneFactory::getDateTimeZone($this->timezone)),
                $this->locale
            ));
        }
    }

    /**
     * Independence Day
     *
     * September 22 marks Bulgaria's declaration of independence from the Ottoman Empire in 1908.
     *
     * @see https://en.wikipedia.org/wiki/Bulgarian_Declaration_of_Independence
     *
     * @throws \Exception
     */
    private function calculateIndependenceDay(): void
    {
        if ($this->year >= 1908) {
            $this->addHoliday(new Holiday(
                'independenceDay',
                ['en' => 'Independence Day', 'bg' => 'Ден на Независимостта на България'],
                new \DateTime("{$this->year}-09-22", DateTimeZoneFactory::getDateTimeZone($this->timezone)),
                $this->locale
            ));
        }
    }
}
