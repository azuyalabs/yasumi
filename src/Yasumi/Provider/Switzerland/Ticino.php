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

namespace Yasumi\Provider\Switzerland;

use DateInterval;
use DateTime;
use DateTimeZone;
use Yasumi\Holiday;
use Yasumi\Provider\ChristianHolidays;
use Yasumi\Provider\Switzerland;

/**
 * Provider for all holidays in Ticino (Switzerland).
 *
 * @link https://en.wikipedia.org/wiki/Ticino
 */
class Ticino extends Switzerland
{
    use ChristianHolidays;

    /**
     * Code to identify this Holiday Provider. Typically this is the ISO3166 code corresponding to the respective
     * country or sub-region.
     */
    const ID = 'CH-TI';

    /**
     * Initialize holidays for Ticino (Switzerland).
     */
    public function initialize()
    {
        parent::initialize();

        $this->addHoliday($this->corpusChristi($this->year, $this->timezone, $this->locale, Holiday::TYPE_OTHER));
        $this->addHoliday($this->assumptionOfMary($this->year, $this->timezone, $this->locale, Holiday::TYPE_OTHER));
        $this->addHoliday($this->allSaintsDay($this->year, $this->timezone, $this->locale, Holiday::TYPE_OTHER));
        $this->addHoliday($this->immaculateConception($this->year, $this->timezone, $this->locale, Holiday::TYPE_OTHER));
        $this->addHoliday($this->stStephensDay($this->year, $this->timezone, $this->locale, Holiday::TYPE_OTHER));
        $this->addHoliday($this->newYearsDay($this->year, $this->timezone, $this->locale, Holiday::TYPE_OTHER));
        $this->addHoliday($this->christmasDay($this->year, $this->timezone, $this->locale, Holiday::TYPE_OTHER));
        $this->addHoliday($this->ascensionDay($this->year, $this->timezone, $this->locale, Holiday::TYPE_OTHER));
        $this->addHoliday($this->easterMonday($this->year, $this->timezone, $this->locale, Holiday::TYPE_OTHER));
        $this->addHoliday($this->pentecostMonday($this->year, $this->timezone, $this->locale, Holiday::TYPE_OTHER));
        $this->addHoliday($this->epiphany($this->year, $this->timezone, $this->locale, Holiday::TYPE_OTHER));
        $this->addHoliday($this->stJosephsDay($this->year, $this->timezone, $this->locale, Holiday::TYPE_OTHER));
        $this->addHoliday($this->internationalWorkersDay($this->year, $this->timezone, $this->locale, Holiday::TYPE_OTHER));

        $this->calculateStPeterPaul();
    }

    /**
     * Feast of Saints Peter and Paul
     *
     * @link https://en.wikipedia.org/wiki/Feast_of_Saints_Peter_and_Paul
     */
    public function calculateStPeterPaul()
    {
        $this->addHoliday(new Holiday('stPeterPaul', [
            'it_IT' => 'Santi Pietro e Paolo',
            'it_CH' => 'Santi Pietro e Paolo',
            'en_US' => 'Feast of Saints Peter and Paul',
            'fr_FR' => 'Solennité des saints Pierre et Paul',
            'fr_CH' => 'Solennité des saints Pierre et Paul',
            'de_DE' => 'St. Peter und Paul',
            'de_CH' => 'St. Peter und Paul',
        ], new DateTime($this->year.'-06-29', new DateTimeZone($this->timezone)), $this->locale, Holiday::TYPE_OTHER));
    }
}
