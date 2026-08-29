<?php

declare(strict_types = 1);

/**
 * This file is part of the 'Yasumi' package.
 *
 * The easy PHP Library for calculating holidays.
 *
 * Copyright (c) 2015 - 2026 AzuyaLabs
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
 * Provider for all holidays in Canada.
 */
class Canada extends AbstractProvider
{
    use CommonHolidays;
    use ChristianHolidays;

    /**
     * Code to identify this Holiday Provider. Typically, this is the ISO3166 code corresponding to the respective
     * country or sub-region.
     */
    public const ID = 'CA';

    /**
     * Initialize holidays for Canada.
     *
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    public function initialize(): void
    {
        $this->timezone = 'America/Toronto';

        // Add common holidays
        $this->addHoliday($this->newYearsDay($this->year, $this->timezone, $this->locale));

        // Add Christian holidays
        $this->addHoliday($this->christmasDay($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->goodFriday($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->easterMonday($this->year, $this->timezone, $this->locale));

        // Calculate other holidays
        $this->calculateBoxingDay();
        $this->calculateCanadaDay();
        $this->calculateVictoriaDay();
        $this->calculateLabourDay();
        $this->calculateThanksgivingDay();
        $this->calculateRemembranceDay();
        $this->calculateNationalDayForTruthAndReconciliation();
    }

    public function getSources(): array
    {
        return [
            'https://en.wikipedia.org/wiki/Public_holidays_in_Canada',
            'https://www.canada.ca/en/services/jobs/workplace/federal-labour-standards/vacations-holidays.html',
        ];
    }

    /**
     * Boxing Day.
     *
     * @see https://en.wikipedia.org/wiki/Boxing_Day
     *
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    protected function calculateBoxingDay(): void
    {
        if ($this->year < 1879) {
            return;
        }

        $this->addHoliday(new Holiday(
            'boxingDay',
            [
                'en' => 'Boxing Day',
                'fr' => 'Lendemain de Noël',
            ],
            new \DateTime("{$this->year}-12-26", DateTimeZoneFactory::getDateTimeZone($this->timezone)),
            $this->locale
        ));
    }

    /**
     * Family Day.
     *
     * @see https://en.wikipedia.org/wiki/Family_Day_(Canada)
     *
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    protected function calculateFamilyDay(): void
    {
        if ($this->year < 2009) {
            return;
        }

        $this->addHoliday(new Holiday(
            'familyDay',
            [],
            new \DateTime("third monday of february {$this->year}", DateTimeZoneFactory::getDateTimeZone($this->timezone)),
            $this->locale
        ));
    }

    /**
     * Victoria Day.
     *
     * @see https://en.wikipedia.org/wiki/Victoria_Day
     *
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    protected function calculateVictoriaDay(): void
    {
        if ($this->year < 1845) {
            return;
        }

        $this->addHoliday(new Holiday(
            'victoriaDay',
            [],
            new \DateTime("last monday front of {$this->year}-05-25", DateTimeZoneFactory::getDateTimeZone($this->timezone)),
            $this->locale
        ));
    }

    /**
     * National Indigenous Peoples Day.
     *
     * @see https://www.rcaanc-cirnac.gc.ca/eng/1100100013248/1534872397533
     *
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    protected function calculateNationalIndigenousPeoplesDay(): void
    {
        if ($this->year < 1996) {
            return;
        }

        $this->addHoliday(new Holiday(
            'nationalIndigenousPeoplesDay',
            [],
            new \DateTime("{$this->year}-06-21", DateTimeZoneFactory::getDateTimeZone($this->timezone)),
            $this->locale
        ));
    }

    /**
     * Civic Holiday.
     *
     * @see https://en.wikipedia.org/wiki/Civic_Holiday
     *
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    protected function calculateCivicHoliday(): void
    {
        if ($this->year < 1879) {
            return;
        }

        $this->addHoliday(new Holiday(
            'civicHoliday',
            [],
            new \DateTime("first monday of august {$this->year}", DateTimeZoneFactory::getDateTimeZone($this->timezone)),
            $this->locale
        ));
    }

    /**
     * Canada Day.
     *
     * @see https://en.wikipedia.org/wiki/Canada_Day.
     * @see Holidays Act, R.S.C., 1985, c. H-5, https://laws-lois.justice.gc.ca/eng/acts/h-5/page-1.html
     * @see https://www.canada.ca/en/canadian-heritage/campaigns/canada-day/about/dominion-day.html
     *
     * by statute, Canada Day is July 1 if that day is not Sunday, and July 2 if July 1 is a Sunday.
     * The holiday (as Dominion Day) was established in 1879.
     *
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    protected function calculateCanadaDay(): void
    {
        if ($this->year < 1879) {
            return;
        }

        $date = new \DateTime("{$this->year}-07-01", DateTimeZoneFactory::getDateTimeZone($this->timezone));

        // The substitution of July 2 when July 1 is a Sunday was introduced by the 1980-81-82-83, c. 124 amendment.
        // For years 1879-1982, July 1 was always the holiday (as Dominion Day), regardless of the weekday.
        if ($this->year >= 1983 && 7 === (int) $date->format('N')) {
            $date = new \DateTime("{$this->year}-07-02", DateTimeZoneFactory::getDateTimeZone($this->timezone));
        }

        $this->addHoliday(new Holiday(
            'canadaDay',
            [],
            $date,
            $this->locale
        ));
    }

    /**
     * Thanksgiving.
     *
     * @see https://en.wikipedia.org/wiki/Thanksgiving_(Canada)
     * @see https://www.thecanadianencyclopedia.ca/en/article/thanksgiving-day
     *
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    protected function calculateThanksgivingDay(): void
    {
        // The second Monday of October was only fixed by proclamation on January 31, 1957. Prior to that the date was
        // set annually by proclamation (between 1921 and 1931 it was even combined with Armistice Day), so no fixed
        // rule applies to earlier years.
        if ($this->year < 1957) {
            return;
        }

        $this->addHoliday(new Holiday(
            'thanksgivingDay',
            [],
            new \DateTime("second monday of october {$this->year}", DateTimeZoneFactory::getDateTimeZone($this->timezone)),
            $this->locale
        ));
    }

    /**
     * Remembrance Day.
     *
     * @see https://en.wikipedia.org/wiki/Remembrance_Day_(Canada)
     *
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    protected function calculateRemembranceDay(): void
    {
        if ($this->year < 1919) {
            return;
        }

        $this->addHoliday(new Holiday(
            'remembranceDay',
            [],
            new \DateTime("{$this->year}-11-11", DateTimeZoneFactory::getDateTimeZone($this->timezone)),
            $this->locale
        ));
    }

    /**
     * Labour Day.
     *
     * @see https://en.wikipedia.org/wiki/Labour_Day
     *
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    protected function calculateLabourDay(): void
    {
        if ($this->year < 1894) {
            return;
        }

        $this->addHoliday(new Holiday(
            'labourDay',
            [],
            new \DateTime("first monday of september {$this->year}", DateTimeZoneFactory::getDateTimeZone($this->timezone)),
            $this->locale
        ));
    }

    /**
     * National Day For Truth And Reconciliation.
     *
     * @see https://parl.ca/Content/Bills/432/Government/C-5/C-5_4/C-5_4.PDF, S. C. 2021, C.11.
     *
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    protected function calculateNationalDayForTruthAndReconciliation(): void
    {
        if ($this->year < 2021) {
            return;
        }

        $this->addHoliday(new Holiday(
            'truthAndReconciliationDay',
            [],
            new \DateTime("last day of september {$this->year}", DateTimeZoneFactory::getDateTimeZone($this->timezone)),
            $this->locale
        ));
    }
}
