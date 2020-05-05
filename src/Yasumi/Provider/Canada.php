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
 * Provider for all holidays in Canada.
 */
class Canada extends AbstractProvider
{
    use CommonHolidays, ChristianHolidays;

    /**
     * Code to identify this Holiday Provider. Typically this is the ISO3166 code corresponding to the respective
     * country or sub-region.
     */
    public const ID = 'CA';

    /**
     * Initialize holidays for Canada.
     *
     * @throws InvalidDateException
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
        $this->addHoliday($this->secondChristmasDay($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->goodFriday($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->easterMonday($this->year, $this->timezone, $this->locale));

        // Calculate other holidays
        $this->calculateCanadaDay();
        $this->calculateLabourDay();
        $this->calculateThanksgivingDay();
        $this->calculateRemembranceDay();
    }

    /**
     * Family Day.
     *
     * @link https://en.wikipedia.org/wiki/Family_Day_(Canada)
     *
     * @throws InvalidDateException
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
            new DateTime("third monday of february $this->year", DateTimeZoneFactory::getDateTimeZone($this->timezone)),
            $this->locale
        ));
    }

    /**
     * Victoria Day.
     *
     * @link https://en.wikipedia.org/wiki/Victoria_Day
     *
     * @throws InvalidDateException
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
            new DateTime("last monday front of $this->year-05-25", DateTimeZoneFactory::getDateTimeZone($this->timezone)),
            $this->locale
        ));
    }

    /**
     * National Indigenous Peoples Day.
     *
     * @link https://www.rcaanc-cirnac.gc.ca/eng/1100100013248/1534872397533
     *
     * @throws InvalidDateException
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
            new DateTime("$this->year-06-21", DateTimeZoneFactory::getDateTimeZone($this->timezone)),
            $this->locale
        ));
    }

    /**
     * Canada Day.
     *
     * @link https://en.wikipedia.org/wiki/Canada_Day
     *
     * @throws InvalidDateException
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    protected function calculateCanadaDay(): void
    {
        if ($this->year < 1983) {
            return;
        }

        $this->addHoliday(new Holiday(
            'canadaDay',
            [],
            new DateTime($this->year . '-07-01', DateTimeZoneFactory::getDateTimeZone($this->timezone)),
            $this->locale
        ));
    }

    /**
     * Civic Holiday.
     *
     * @link https://en.wikipedia.org/wiki/Civic_Holiday
     *
     * @throws InvalidDateException
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
            new DateTime("first monday of august $this->year", DateTimeZoneFactory::getDateTimeZone($this->timezone)),
            $this->locale
        ));
    }

    /**
     * Labour Day.
     *
     * @link https://en.wikipedia.org/wiki/Labour_Day
     *
     * @throws InvalidDateException
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    private function calculateLabourDay(): void
    {
        if ($this->year < 1894) {
            return;
        }

        $this->addHoliday(new Holiday(
            'labourDay',
            [],
            new DateTime("first monday of september $this->year", DateTimeZoneFactory::getDateTimeZone($this->timezone)),
            $this->locale
        ));
    }

    /**
     * Thanksgiving.
     *
     * @link https://en.wikipedia.org/wiki/Thanksgiving_(Canada)
     *
     * @throws InvalidDateException
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    protected function calculateThanksgivingDay(): void
    {
        if ($this->year < 1879) {
            return;
        }

        $this->addHoliday(new Holiday(
            'thanksgivingDay',
            [],
            new DateTime("second monday of october $this->year", DateTimeZoneFactory::getDateTimeZone($this->timezone)),
            $this->locale
        ));
    }

    /**
     * Remembrance Day.
     *
     * @link https://en.wikipedia.org/wiki/Remembrance_Day_(Canada)
     *
     * @throws InvalidDateException
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
            new DateTime("$this->year-11-11", DateTimeZoneFactory::getDateTimeZone($this->timezone)),
            $this->locale
        ));
    }
}
