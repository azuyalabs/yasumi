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
 * Provider for all holidays in the Region of Murcia (Spain).
 *
 * The Region of Murcia is an autonomous community of Spain located in the southeast of the state, between Andalusia and
 * Valencian Community, on the Mediterranean coast. The city of Murcia is the capital of the region and seat of
 * government organs, except for the parliament, the Regional Assembly of Murcia, which is located in Cartagena.
 *
 * @link http://en.wikipedia.org/wiki/Region_of_Murcia
 */
class RegionOfMurcia extends Spain
{
    use ChristianHolidays;

    /**
     * Code to identify this Holiday Provider. Typically this is the ISO3166 code corresponding to the respective
     * country or sub-region.
     */
    const ID = 'ES-MC';

    /**
     * Initialize holidays for the Region of Murcia (Spain).
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
        $this->calculateDayOfMurcia();
    }

    /**
     * Calculates the day of Murcia.
     *
     * The Day of the Region of Murcia (Día de la Región de Murcia) is an annual public holiday in the autonomous
     * community of Murcia, Spain, on June 9. It marks the anniversary of the approval of the statute of autonomy of
     * Murcia on June 9, 1982. The Day of the Region of Murcia was first celebrated on June 9, 1983.
     *
     * @link http://www.timeanddate.com/holidays/spain/murcia-day
     *
     * @throws \InvalidArgumentException
     * @throws \Yasumi\Exception\UnknownLocaleException
     */
    public function calculateDayOfMurcia()
    {
        if ($this->year >= 1983) {
            $this->addHoliday(new Holiday('murciaDay', [
                'es_ES' => 'Día de la Región de Murcia',
            ], new DateTime("$this->year-6-9", new DateTimeZone($this->timezone)), $this->locale));
        }
    }
}
