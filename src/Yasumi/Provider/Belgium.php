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
 * Provider for all holidays in Belgium.
 */
class Belgium extends AbstractProvider
{
    use CommonHolidays;
    use ChristianHolidays;

    /**
     * Code to identify this Holiday Provider. Typically this is the ISO3166 code corresponding to the respective
     * country or sub-region.
     */
    public const ID = 'BE';

    /**
     * Initialize holidays for Belgium.
     *
     * @throws InvalidDateException
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    public function initialize(): void
    {
        $this->timezone = 'Europe/Brussels';

        // Add common holidays
        $this->addHoliday($this->newYearsDay($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->internationalWorkersDay($this->year, $this->timezone, $this->locale));

        // Add Christian holidays
        $this->addHoliday($this->easter($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->easterMonday($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->ascensionDay($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->pentecost($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->pentecostMonday($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->christmasDay($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->allSaintsDay($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->assumptionOfMary($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->armisticeDay($this->year, $this->timezone, $this->locale));

        /*
         * Belgian National Day.
         *
         * Belgian National Day is the National Day of Belgium celebrated on 21 July each year.
         */
        $this->addHoliday(new Holiday('nationalDay', [
            'fr' => 'Fête nationale',
            'en' => 'Belgian National Day',
            'nl' => 'nationale feestdag',
        ], new DateTime("$this->year-7-21", DateTimeZoneFactory::getDateTimeZone($this->timezone)), $this->locale));
    }
}
