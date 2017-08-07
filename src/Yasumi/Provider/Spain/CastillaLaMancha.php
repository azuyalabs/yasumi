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
 * Provider for all holidays in Castilla-La Mancha (Spain).
 *
 * Castilla-La Mancha is an autonomous community of Spain. Castilla–La Mancha is bordered by Castilla y León, Madrid,
 * Aragon, Valencia, Murcia, Andalusia, and Extremadura. It is one of the most sparsely populated of Spain's autonomous
 * communities. Albacete is the largest and most populous city. Its capital city is Toledo, and its judicial capital
 * city is Albacete.
 *
 * @link http://en.wikipedia.org/wiki/Castilla-La_Mancha
 */
class CastillaLaMancha extends Spain
{
    use ChristianHolidays;

    /**
     * Code to identify this Holiday Provider. Typically this is the ISO3166 code corresponding to the respective
     * country or sub-region.
     */
    const ID = 'ES-CM';

    /**
     * Initialize holidays for Castilla-La Mancha (Spain).
     *
     * @throws \InvalidArgumentException
     * @throws \Yasumi\Exception\UnknownLocaleException
     */
    public function initialize()
    {
        parent::initialize();

        // Add custom Christian holidays
        $this->addHoliday($this->stJosephsDay($this->year, $this->timezone, $this->locale, Holiday::TYPE_OBSERVANCE));
        $this->addHoliday($this->maundyThursday($this->year, $this->timezone, $this->locale, Holiday::TYPE_OBSERVANCE));

        // Calculate other holidays
        $this->calculateCastillaLaManchaDay();
    }

    /**
     * Calculates Castilla-La Mancha Day (Día de la Región Castilla-La Mancha).
     *
     * The Day of the Region of Castilla-La Mancha (Día de la Región Castilla-La Mancha) commemorates when Castilla-La
     * Mancha's first regional courts were opened. It is an annual public holiday in this community on May 31.
     *
     * The statue of autonomy of Castile-La Mancha came into force on August 16, 1982. The regional courts sat for the
     * first time on May 31, 1983. The Day of Castilla-La Mancha was a public holiday for the first time on
     * May 31, 1984.
     *
     * @link http://www.timeanddate.com/holidays/spain/castile-la-mancha-day
     *
     * @throws \InvalidArgumentException
     * @throws \Yasumi\Exception\UnknownLocaleException
     */
    public function calculateCastillaLaManchaDay()
    {
        if ($this->year >= 1984) {
            $this->addHoliday(new Holiday(
                'castillaLaManchaDay',
                ['es_ES' => 'Día de la Región Castilla-La Mancha'],
                new DateTime("$this->year-5-31", new DateTimeZone($this->timezone)),
                $this->locale
            ));
        }
    }
}
