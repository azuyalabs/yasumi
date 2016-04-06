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

use Yasumi\Holiday;
use Yasumi\Provider\ChristianHolidays;
use Yasumi\Provider\Germany;

/**
 * Provider for all holidays in Saarland (Germany).
 *
 * The Saarland is one of the sixteen federal states of Germany. With its capital at Saarbrücken, it has an area
 * of 2,570 km² and its population (as of 30 April 2012) is approximately 1,012,000. In terms of both area and
 * population size – apart from the city-states of Berlin, Bremen and Hamburg – it is Germany's smallest federal state.
 * The wealth of its coal deposits and their large-scale industrial exploitation, coupled with its location on the
 * border between France and Germany, have given the Saarland a unique history in modern times.
 *
 * @link https://en.wikipedia.org/wiki/Saarland
 */
class Saarland extends Germany
{
    use ChristianHolidays;

    /**
     * Initialize holidays for Saarland (Germany).
     */
    public function initialize()
    {
        parent::initialize();

        // Add holidays
        $this->addHoliday($this->corpusChristi($this->year, $this->timezone, $this->locale, Holiday::TYPE_OBSERVANCE));
        $this->addHoliday($this->assumptionOfMary($this->year, $this->timezone, $this->locale, Holiday::TYPE_OBSERVANCE));
        $this->addHoliday($this->allSaintsDay($this->year, $this->timezone, $this->locale, Holiday::TYPE_OBSERVANCE));
    }
}
