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

use DateTime;
use Yasumi\Exception\InvalidDateException;
use Yasumi\Exception\UnknownLocaleException;
use Yasumi\Holiday;

/**
 * Provider for all holidays in Poland.
 */
class Poland extends AbstractProvider
{
    use CommonHolidays;
    use ChristianHolidays;

    /**
     * Code to identify this Holiday Provider. Typically this is the ISO3166 code corresponding to the respective
     * country or sub-region.
     */
    public const ID = 'PL';

    /**
     * Initialize holidays for Poland.
     *
     * @throws InvalidDateException
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    public function initialize(): void
    {
        $this->timezone = 'Europe/Warsaw';

        // Add common holidays
        $this->addHoliday($this->newYearsDay($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->internationalWorkersDay($this->year, $this->timezone, $this->locale));

        // Add Christian holidays
        $this->addHoliday($this->allSaintsDay($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->assumptionOfMary($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->christmasDay($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->corpusChristi($this->year, $this->timezone, $this->locale, Holiday::TYPE_OFFICIAL));
        $this->addHoliday($this->easter($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->easterMonday($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->epiphany($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->pentecost($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->secondChristmasDay($this->year, $this->timezone, $this->locale));

        // Add other holidays
        $this->calculateIndependenceDay();
        $this->calculateConstitutionDay();
    }

    /**
     * Constitution Day.
     *
     * 3rd May National Holiday (also May 3rd Constitution Day; Polish: Święto Konstytucji 3 Maja) is a Polish national
     * and public holiday that takes place on 3rd May. The holiday celebrates the declaration of the Constitution of
     * May 3, 1791. Festivities date back to the Duchy of Warsaw early in the 19th century, but it became an official
     * holiday only in 1919 in the Second Polish Republic.
     *
     * @see https://en.wikipedia.org/wiki/May_3rd_Constitution_Day
     *
     * @throws InvalidDateException
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    private function calculateIndependenceDay(): void
    {
        if ($this->year < 1918) {
            return;
        }

        $this->addHoliday(new Holiday('independenceDay', [
            'en' => 'Independence Day',
            'pl' => 'Narodowe Święto Niepodległości',
        ], new DateTime("$this->year-11-11", DateTimeZoneFactory::getDateTimeZone($this->timezone)), $this->locale));
    }

    /**
     * Independence Day.
     *
     * National Independence Day (Polish: Narodowe Święto Niepodległości) is a national day in Poland celebrated on
     * 11 November to commemorate the anniversary of the restoration of Poland's sovereignty as the Second Polish
     * Republic in 1918, after 123 years of partition by the Russian Empire, the Kingdom of Prussia and the Habsburg
     * Empire.
     *
     * @see https://en.wikipedia.org/wiki/National_Independence_Day_(Poland)
     *
     * @throws InvalidDateException
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    private function calculateConstitutionDay(): void
    {
        if ($this->year < 1791) {
            return;
        }

        $this->addHoliday(new Holiday('constitutionDay', [
            'en' => 'Constitution Day',
            'pl' => 'Święto Narodowe Trzeciego Maja',
        ], new DateTime("$this->year-5-3", DateTimeZoneFactory::getDateTimeZone($this->timezone)), $this->locale));
    }
}
