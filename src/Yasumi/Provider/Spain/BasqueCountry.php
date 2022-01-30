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

namespace Yasumi\Provider\Spain;

use DateTime;
use Yasumi\Exception\InvalidDateException;
use Yasumi\Exception\UnknownLocaleException;
use Yasumi\Holiday;
use Yasumi\Provider\ChristianHolidays;
use Yasumi\Provider\DateTimeZoneFactory;
use Yasumi\Provider\Spain;

/**
 * Provider for all holidays in Basque Country (Spain).
 *
 * The Basque Country is an autonomous community of northern Spain. It includes the Basque provinces of Álava, Biscay
 * and Gipuzkoa, also called Historical Territories.
 *
 * @see https://en.wikipedia.org/wiki/Basque_Country_(autonomous_community)
 */
class BasqueCountry extends Spain
{
    use ChristianHolidays;

    /**
     * Code to identify this Holiday Provider. Typically, this is the ISO3166 code corresponding to the respective
     * country or sub-region.
     */
    public const ID = 'ES-PV';

    /**
     * Initialize holidays for Basque Country (Spain).
     *
     * @throws InvalidDateException
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    public function initialize(): void
    {
        parent::initialize();

        // Add custom Christian holidays
        $this->addHoliday($this->maundyThursday($this->year, $this->timezone, $this->locale, Holiday::TYPE_OBSERVANCE));
        $this->addHoliday($this->easterMonday($this->year, $this->timezone, $this->locale, Holiday::TYPE_OBSERVANCE));

        // Calculate other holidays
        $this->calculateBasqueCountryDay();
    }

    /**
     * Calculates the Basque Country Day.
     *
     * Celebrated annually on 25 October, this is a public holiday in the Basque country region of Spain. The day
     * commemorates a referendum that was held and approved on 25 October 1979, which defined the political structure of
     * the Basque region as an autonomous community. The creation of the holiday of the Day of the Basque Country was
     * approved by the Basque Parliament on 22 April 2010 and it became a holiday in 2011. However was annulled in 2013.
     *
     * In 2016, this holiday is replaced by the Day of the First Constitiution of the Basque Country.
     *
     * @see https://www.officeholidays.com/holidays/day-of-the-basque-country
     *
     * @throws InvalidDateException
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    private function calculateBasqueCountryDay(): void
    {
        if ($this->year >= 2011 && $this->year <= 2013) {
            $this->addHoliday(new Holiday(
                'basqueCountryDay',
                ['es' => 'Euskadi Eguna'],
                new DateTime("$this->year-10-25", DateTimeZoneFactory::getDateTimeZone($this->timezone)),
                $this->locale
            ));
        }
    }
}
