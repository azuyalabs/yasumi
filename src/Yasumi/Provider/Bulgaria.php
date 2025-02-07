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

use Yasumi\Exception\UnknownLocaleException;
use Yasumi\Holiday;

/**
 * Provider for all holidays in Bulgaria.
 *
 * Class Bulgaria
 */
class Bulgaria extends AbstractProvider
{
    use CommonHolidays;
    use ChristianHolidays;

    /**
     * Code to identify this Holiday Provider.
     * Typically, this is the ISO3166 code corresponding to the respective country or sub-region.
     */
    public const ID = 'BG';

    /**
     * Initialize holidays for Bulgaria.
     *
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    public function initialize(): void
    {
        $this->timezone = 'Europe/Sofia';

        // Add common holidays
        $this->addHoliday($this->newYearsDay($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->internationalWorkersDay($this->year, $this->timezone, $this->locale));

        // Add Orthodox Christian holidays
        $this->addHoliday($this->easter($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->easterMonday($this->year, $this->timezone, $this->locale));
        $this->calculateGoodFriday();
        $this->calculateHolySaturday();
        $this->calculateChristmasEve();
        $this->addHoliday($this->christmasDay($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->secondChristmasDay($this->year, $this->timezone, $this->locale));

        // Add other holidays
        $this->calculateLiberationDay();
        $this->calculateStGeorgesDay();
        $this->calculateCultureDay();
        $this->calculateUnificationDay();
        $this->calculateIndependenceDay();
        $this->calculateAwakenersDay();
    }

    public function getSources(): array
    {
        return [
            'https://en.wikipedia.org/wiki/Public_holidays_in_Bulgaria',
            'https://bg.wikipedia.org/wiki/Официални_празници_в_България',
        ];
    }

    /**
     * @return \DateTime|\DateTimeImmutable
     *
     * @throws \Exception
     */
    protected function calculateEaster(int $year, string $timezone): \DateTimeInterface
    {
        return $this->calculateOrthodoxEaster($year, $timezone);
    }

    /**
     * Good Friday.
     *
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    protected function calculateGoodFriday(): void
    {
        $easter = $this->calculateEaster($this->year, $this->timezone);
        $goodFriday = clone $easter;
        $goodFriday->sub(new \DateInterval('P2D'));

        $this->addHoliday(new Holiday('goodFriday', [
            'en' => 'Good Friday',
            'bg' => 'Разпети петък',
        ], $goodFriday, $this->locale));
    }

    /**
     * Holy Saturday.
     *
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    protected function calculateHolySaturday(): void
    {
        $easter = $this->calculateEaster($this->year, $this->timezone);
        $holySaturday = clone $easter;
        $holySaturday->sub(new \DateInterval('P1D'));

        $this->addHoliday(new Holiday('holySaturday', [
            'en' => 'Holy Saturday',
            'bg' => 'Велика събота',
        ], $holySaturday, $this->locale));
    }

    /**
     * Christmas Eve.
     *
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    protected function calculateChristmasEve(): void
    {
        $this->addHoliday(new Holiday('christmasEve', [
            'en' => 'Christmas Eve',
            'bg' => 'Бъдни вечер',
        ], new \DateTime("{$this->year}-12-24", DateTimeZoneFactory::getDateTimeZone($this->timezone)), $this->locale));
    }

    /**
     * Liberation Day.
     *
     * Liberation Day is celebrated on March 3rd.
     * This day marks the liberation of Bulgaria from Ottoman rule in 1878.
     *
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    protected function calculateLiberationDay(): void
    {
        if ($this->year >= 1878) {
            $this->addHoliday(new Holiday('liberationDay', [
                'en' => 'Liberation Day',
                'bg' => 'Ден на Освобождението на България от османско иго',
            ], new \DateTime("{$this->year}-03-03", DateTimeZoneFactory::getDateTimeZone($this->timezone)), $this->locale));
        }
    }

    /**
     * St. George's Day and Bulgarian Army Day.
     *
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    protected function calculateStGeorgesDay(): void
    {
        $this->addHoliday(new Holiday('stGeorgesDay', [
            'en' => 'St. George’s Day and Bulgarian Army Day',
            'bg' => 'Гергьовден и Ден на храбростта и Българската армия',
        ], new \DateTime("{$this->year}-05-06", DateTimeZoneFactory::getDateTimeZone($this->timezone)), $this->locale));
    }

    /**
     * Day of Bulgarian Education and Culture and Slavonic Literature.
     *
     * Celebrated on May 24th, this holiday honors the creators of the Cyrillic alphabet.
     *
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    protected function calculateCultureDay(): void
    {
        if ($this->year >= 1851) {  // First celebrated in 1851 in Plovdiv
            $this->addHoliday(new Holiday('cultureDay', [
                'en' => 'Day of Bulgarian Education and Culture and Slavonic Literature',
                'bg' => 'Ден на българската просвета и култура и на славянската писменост',
            ], new \DateTime("{$this->year}-05-24", DateTimeZoneFactory::getDateTimeZone($this->timezone)), $this->locale));
        }
    }

    /**
     * Unification Day.
     *
     * Celebrated on September 6th, commemorating the unification of Eastern Rumelia with Bulgaria in 1885.
     *
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    protected function calculateUnificationDay(): void
    {
        if ($this->year >= 1885) {
            $this->addHoliday(new Holiday('unificationDay', [
                'en' => 'Unification Day',
                'bg' => 'Ден на Съединението',
            ], new \DateTime("{$this->year}-09-06", DateTimeZoneFactory::getDateTimeZone($this->timezone)), $this->locale));
        }
    }

    /**
     * Independence Day.
     *
     * Celebrated on September 22nd, marking Bulgaria's declaration of independence from the Ottoman Empire in 1908.
     *
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    protected function calculateIndependenceDay(): void
    {
        if ($this->year >= 1908) {
            $this->addHoliday(new Holiday('independenceDay', [
                'en' => 'Independence Day',
                'bg' => 'Ден на Независимостта на България',
            ], new \DateTime("{$this->year}-09-22", DateTimeZoneFactory::getDateTimeZone($this->timezone)), $this->locale));
        }
    }

    /**
     * Day of the National Awakeners.
     *
     * Celebrated on November 1st, honoring the Bulgarian enlighteners, revolutionaries and scholars.
     * This is a holiday for all educational institutions.
     *
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    protected function calculateAwakenersDay(): void
    {
        if ($this->year >= 1922) {  // First celebrated in 1922
            $this->addHoliday(new Holiday('awakenersDay', [
                'en' => 'Day of the National Awakeners (Holiday for educational institutions)',
                'bg' => 'Ден на народните будители (Празник за всички учебни заведения)',
            ], new \DateTime("{$this->year}-11-01", DateTimeZoneFactory::getDateTimeZone($this->timezone)), $this->locale, Holiday::TYPE_OBSERVANCE));
        }
    }
}
