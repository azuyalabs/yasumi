<?php
/**
 *  This file is part of the Yasumi package.
 *
 *  Copyright (c) 2015 - 2016 AzuyaLabs
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 *
 *  @author Sacha Telgenhof <stelgenhof@gmail.com>
 */

namespace Yasumi\Provider\Germany;

use Yasumi\Provider\ChristianHolidays;
use Yasumi\Provider\Germany;
use Yasumi\Holiday;
use DateTimeZone;
use DateTime;

/**
 * Provider for all holidays in Saxony (Germany).
 *
 * The Free State of Saxony (German: Freistaat Sachsen) is a landlocked federal state of Germany, bordering the federal
 * states of Brandenburg, Saxony Anhalt, Thuringia, and Bavaria, as well as the countries of Poland and the Czech 
 * Republic. Its capital is Dresden, and its largest city is Leipzig.
 *
 * @link https://en.wikipedia.org/wiki/Saxony
 */
class Saxony extends Germany
{
    /**
     * Code to identify this Holiday Provider. Typically this is the ISO3166 code corresponding to the respective
     * country or subregion.
     */
    const ID = 'DE_SN';

    /**
     * Initialize holidays for Saxony (Germany).
     */
    public function initialize()
    {
        parent::initialize();

        // Add custom Christian holidays
        $this->calculateReformationDay();
        $this->calculateRepentanceAndPrayerDay();
    }

    public function calculateRepentanceAndPrayerDay()
    {
        if ($this->year >= 1995) {
            $this->addHoliday(new Holiday('repentanceAndPrayerDay', ['de_DE' => 'Buß- und Bettag'],
                new DateTime("next wednesday $this->year-11-15", new DateTimeZone($this->timezone)), $this->locale));
        }
    }
}
