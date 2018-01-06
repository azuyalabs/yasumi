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
 * Provider for all holidays in Extremadura (Spain).
 *
 * Extremadura is an autonomous community of western Spain whose capital city is Mérida. Its component provinces are
 * Cáceres and Badajoz. It is bordered by Portugal to the west. To the north it borders Castile and León (provinces of
 * Salamanca and Ávila); to the south, it borders Andalusia (provinces of Huelva, Seville, and Córdoba); and to the
 * east, it borders Castile–La Mancha (provinces of Toledo and Ciudad Real).
 *
 * @link http://en.wikipedia.org/wiki/Extremadura
 */
class Extremadura extends Spain
{
    use ChristianHolidays;

    /**
     * Code to identify this Holiday Provider. Typically this is the ISO3166 code corresponding to the respective
     * country or sub-region.
     */
    const ID = 'ES-EX';

    /**
     * Initialize holidays for Extremadura (Spain).
     *
     * @throws \InvalidArgumentException
     * @throws \Yasumi\Exception\UnknownLocaleException
     */
    public function initialize()
    {
        parent::initialize();

        // Add custom Christian holidays
        $this->addHoliday($this->maundyThursday($this->year, $this->timezone, $this->locale, Holiday::TYPE_OBSERVANCE));

        // Calculate other holidays
        $this->calculateDayOfExtremadura();
    }

    /**
     * Calculates the Day of Extremadura.
     *
     * The Day of Extremadura (Día de Extremadura) is an annual public holiday in the Spanish autonomous community of
     * Extremadura on September 8. It marks the anniversary of the birth of Mary, mother of Jesus.
     *
     * A law enacted on June 3, 1985, proclaimed September 8 to be a public holiday known as the Day of Extremadura.
     * The public holiday was first observed on September 8, 1985.
     *
     * @link http://www.timeanddate.com/holidays/spain/extremadura-day
     *
     * @throws \InvalidArgumentException
     * @throws \Yasumi\Exception\UnknownLocaleException
     */
    public function calculateDayOfExtremadura()
    {
        if ($this->year >= 1985) {
            $this->addHoliday(new Holiday(
                'extremaduraDay',
                ['es_ES' => 'Día de Extremadura'],
                new DateTime("$this->year-9-8", new DateTimeZone($this->timezone)),
                $this->locale
            ));
        }
    }
}
