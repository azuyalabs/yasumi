<?php
/**
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 - 2017 AzuyaLabs
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
 * Provider for all holidays in Catalonia (Spain).
 *
 * Catalonia is an autonomous community of Spain, and designated a "historical nationality" by its Statute of Autonomy.
 * Catalonia comprises four provinces: Barcelona, Girona, Lleida, and Tarragona. The capital and largest city is
 * Barcelona, the second largest city in Spain, and the centre of one of the largest metropolitan areas in Europe, and
 * it comprises most of the territory of the former Principality of Catalonia, with the remainder now part of France.
 * Catalonia is bordered by France and Andorra to the north, the Mediterranean Sea to the east, and the Spanish regions
 * of Aragon and the Valencian Community to west and south respectively.
 *
 * @link http://en.wikipedia.org/wiki/Catalonia
 */
class Catalonia extends Spain
{
    use ChristianHolidays;

    /**
     * Code to identify this Holiday Provider. Typically this is the ISO3166 code corresponding to the respective
     * country or sub-region.
     */
    const ID = 'ES-CT';

    /**
     * Initialize holidays for Catalonia (Spain).
     *
     * @throws \InvalidArgumentException
     * @throws \Yasumi\Exception\UnknownLocaleException
     */
    public function initialize()
    {
        parent::initialize();

        // Add custom Christian holidays
        $this->addHoliday($this->easterMonday($this->year, $this->timezone, $this->locale, Holiday::TYPE_OBSERVANCE));
        $this->addHoliday($this->stJohnsDay($this->year, $this->timezone, $this->locale, Holiday::TYPE_OBSERVANCE));
        $this->addHoliday($this->stStephensDay($this->year, $this->timezone, $this->locale, Holiday::TYPE_OBSERVANCE));

        // Calculate other holidays
        $this->calculateNationalDayOfCatalonia();
    }

    /**
     * Calculates the National Day of Catalonia.
     *
     * The National Day of Catalonia (Catalan: Diada Nacional de Catalunya) is a day-long festival in Catalonia. It
     * commemorates the defeat of Catalonia during the War of the Spanish Succession. The holiday was first celebrated
     * on 11 September 1886, was suppressed by the Franco dictatorship in 1939 and reinstated in 1980 by the autonomous
     * government of Catalonia, the Generalitat de Catalunya, upon its restoration after the Franco dictatorship.
     *
     * @link https://en.wikipedia.org/wiki/National_Day_of_Catalonia
     *
     * @throws \InvalidArgumentException
     * @throws \Yasumi\Exception\UnknownLocaleException
     */
    public function calculateNationalDayOfCatalonia()
    {
        if ($this->year >= 1886) {
            $this->addHoliday(new Holiday(
                'nationalCataloniaDay',
                ['es_ES' => 'Diada Nacional de Catalunya'],
                new DateTime("$this->year-9-11", new DateTimeZone($this->timezone)),
                $this->locale
            ));
        }
    }
}
