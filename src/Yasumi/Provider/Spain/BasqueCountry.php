<?php
/**
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 - 2018 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <stelgenhof@gmail.com>
 */

namespace Yasumi\Provider\Spain;

use DateTime;
use DateTimeZone;
use Yasumi\Holiday;
use Yasumi\Provider\ChristianHolidays;
use Yasumi\Provider\Spain;

/**
 * Provider for all holidays in Basque Country (Spain).
 *
 * The Basque Country is an autonomous community of northern Spain. It includes the Basque provinces of Álava, Biscay
 * and Gipuzkoa, also called Historical Territories.
 *
 * @link http://en.wikipedia.org/wiki/Basque_Country_(autonomous_community)
 */
class BasqueCountry extends Spain
{
    use ChristianHolidays;

    /**
     * Code to identify this Holiday Provider. Typically this is the ISO3166 code corresponding to the respective
     * country or sub-region.
     */
    const ID = 'ES-PV';

    /**
     * Initialize holidays for Basque Country (Spain).
     *
     * @throws \Yasumi\Exception\InvalidDateException
     * @throws \InvalidArgumentException
     * @throws \Yasumi\Exception\UnknownLocaleException
     * @throws \Exception
     */
    public function initialize()
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
     * @link http://www.officeholidays.com/countries/spain/basque_community_day.php
     *
     * @throws \Yasumi\Exception\InvalidDateException
     * @throws \InvalidArgumentException
     * @throws \Yasumi\Exception\UnknownLocaleException
     */
    public function calculateBasqueCountryDay()
    {
        if ($this->year >= 2011 && $this->year <= 2013) {
            $this->addHoliday(new Holiday(
                'basqueCountryDay',
                ['es_ES' => 'Euskadi Eguna'],
                new DateTime("$this->year-10-25", new DateTimeZone($this->timezone)),
                $this->locale
            ));
        }
    }
}
