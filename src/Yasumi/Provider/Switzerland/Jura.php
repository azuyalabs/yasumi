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
 * Provider for all holidays in Jura (Switzerland).
 *
 * @link https://en.wikipedia.org/wiki/Canton_of_Jura
 */
class Jura extends Switzerland
{
    use ChristianHolidays;

    /**
     * Code to identify this Holiday Provider. Typically this is the ISO3166 code corresponding to the respective
     * country or sub-region.
     */
    const ID = 'CH-JU';

    /**
     * Initialize holidays for Jura (Switzerland).
     */
    public function initialize()
    {
        parent::initialize();

        $this->addHoliday($this->goodFriday($this->year, $this->timezone, $this->locale, Holiday::TYPE_OTHER));
        $this->addHoliday($this->internationalWorkersDay($this->year, $this->timezone, $this->locale, Holiday::TYPE_OTHER));
        $this->addHoliday($this->corpusChristi($this->year, $this->timezone, $this->locale, Holiday::TYPE_OTHER));
        $this->addHoliday($this->assumptionOfMary($this->year, $this->timezone, $this->locale, Holiday::TYPE_OTHER));
        $this->addHoliday($this->allSaintsDay($this->year, $this->timezone, $this->locale, Holiday::TYPE_OTHER));
        $this->addHoliday($this->newYearsDay($this->year, $this->timezone, $this->locale, Holiday::TYPE_OTHER));
        $this->addHoliday($this->christmasDay($this->year, $this->timezone, $this->locale, Holiday::TYPE_OTHER));
        $this->addHoliday($this->ascensionDay($this->year, $this->timezone, $this->locale, Holiday::TYPE_OTHER));
        $this->addHoliday($this->easterMonday($this->year, $this->timezone, $this->locale, Holiday::TYPE_OTHER));
        $this->addHoliday($this->pentecostMonday($this->year, $this->timezone, $this->locale, Holiday::TYPE_OTHER));

        $this->calculateBerchtoldsTag();
        $this->calculatePlebisciteJurassien();
    }

    /**
     * Plébiscite jurassien
     *
     * @link https://fr.wikipedia.org/wiki/Pl%C3%A9biscite_jurassien
     */
    public function calculatePlebisciteJurassien()
    {
        if ($this->year > 1974) {
            $this->addHoliday(new Holiday('plebisciteJurassien', [
                'fr_FR' => 'Commémoration du plébiscite jurassien',
                'fr_CH' => 'Commémoration du plébiscite jurassien',
            ], new DateTime($this->year.'-06-23', new DateTimeZone($this->timezone)), $this->locale, Holiday::TYPE_OTHER));
        }
    }
}
