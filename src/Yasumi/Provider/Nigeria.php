<?php

declare(strict_types=1);

/*
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 - 2023 Manomite
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Adeyeye George <manomitehq@gmail.com>
 */

namespace Yasumi\Provider;

use Yasumi\Exception\UnknownLocaleException;
use Yasumi\Holiday;
use Yasumi\SubstituteHoliday;

/**
 * Provider for all holidays in South Africa.
 *
 * Note: South Africa has 12 public holidays as determined by the Public Holidays Act (Act No 36 of 1994). The Act
 * determines whenever any public holiday falls on a Sunday, the Monday following on it shall be a public holiday.
 * Yasumi currently implements all South African holidays based on this act.
 */
class Nigeria extends AbstractProvider
{
    use CommonHolidays;
    use ChristianHolidays;

    /**
     * Code to identify this Holiday Provider. Typically, this is the ISO3166 code corresponding to the respective
     * country or sub-region.
     */
    public const ID = 'NG';

    /**
     * Initialize holidays for South Africa.
     *
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    public function initialize(): void
    {
        $this->timezone = 'Africa/Lagos';

        if ($this->year < 1960) {
            return;
        }

        // Add common holidays
        $this->addHoliday($this->newYearsDay($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->internationalWorkersDay($this->year, $this->timezone, $this->locale));

        $this->addHoliday($this->goodFriday($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->christmasDay($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->secondChristmasDay($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->easterMonday($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->valentinesDay($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->eid($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->labourDay($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->fathersDay($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->internationalWomensDay($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->mothersDay($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->mothersDay($this->year, $this->timezone, $this->locale));
       
        // Calculate other holidays
        $this->calculateIndependenceDay();
       
       
    }

    public function getSources(): array
    {
        return [
            'https://en.wikipedia.org/wiki/Independence_Day_(Nigeria)'
        ];
    }

   /**
     * Independence Day.
     *
     * Independence Day, is a federal holiday in Nigeria
     * States commemorating the adoption of the Declaration of Independence on Oct 1, 1960, declaring independence
     * from Great Britain.
     *
     * @see https://en.wikipedia.org/wiki/Independence_Day_(Nigeria)
     *
     * @throws \Exception
     */
    private function calculateIndependenceDay(): void
    {
        if ($this->year >= 1960) {
            $this->addHoliday(new Holiday('independenceDay', [
                'en' => 'Independence Day',
            ], new DateTime("$this->year-10-1", DateTimeZoneFactory::getDateTimeZone($this->timezone)), $this->locale));
        }
    }
   
}
