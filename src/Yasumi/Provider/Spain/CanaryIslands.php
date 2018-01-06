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
 * Provider for all holidays in the Canary Islands (Spain).
 *
 * The Canary Islands, also known as the Canaries (Spanish: Canarias), are a Spanish archipelago located just off the
 * southern coast of Morocco, 100 kilometres (62 miles) west of its southern border. The Canaries constitute one of
 * Spain's 17 autonomous communities and are among the outermost regions of the European Union proper. The main islands
 * are (from largest to smallest) Tenerife, Fuerteventura, Gran Canaria, Lanzarote, La Palma, La Gomera and El Hierro.
 *
 * @link http://en.wikipedia.org/wiki/Canary_Islands
 */
class CanaryIslands extends Spain
{
    use ChristianHolidays;

    /**
     * Code to identify this Holiday Provider. Typically this is the ISO3166 code corresponding to the respective
     * country or sub-region.
     */
    const ID = 'ES-CN';

    /**
     * Initialize holidays for Canary Islands (Spain).
     *
     * @throws \InvalidArgumentException
     * @throws \Yasumi\Exception\UnknownLocaleException
     */
    public function initialize()
    {
        parent::initialize();
        $this->timezone = 'Atlantic/Canary';

        // Add custom Christian holidays
        $this->addHoliday($this->maundyThursday($this->year, $this->timezone, $this->locale, Holiday::TYPE_OBSERVANCE));

        // Calculate other holidays
        $this->calculateCanaryIslandsDay();
    }

    /**
     * Calculates the Day of the Canary Islands.
     *
     * The Day of the Canary Islands (Día de las Canarias) is a public holiday the Canary Islands, Spain, on May 30 each
     * year. This event celebrates the islands' culture and people. It also marks the anniversary of the autonomous
     * Canary Islands Parliament's first session, which was on May 30, 1983.
     *
     * @link http://www.timeanddate.com/holidays/spain/canaries-day-observed
     *
     * @throws \InvalidArgumentException
     * @throws \Yasumi\Exception\UnknownLocaleException
     */
    public function calculateCanaryIslandsDay()
    {
        if ($this->year >= 1984) {
            $this->addHoliday(new Holiday(
                'canaryIslandsDay',
                ['es_ES' => 'Día de las Canarias'],
                new DateTime("$this->year-5-30", new DateTimeZone($this->timezone)),
                $this->locale
            ));
        }
    }
}
