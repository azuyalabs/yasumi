<?php

declare(strict_types=1);
/*
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 - 2023 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <me at sachatelgenhof dot com>
 */

namespace Yasumi\Provider\Germany;

use Yasumi\Exception\UnknownLocaleException;
use Yasumi\Holiday;
use Yasumi\Provider\Germany;

/**
 * Provider for all holidays in Saarland (Germany).
 *
 * The Saarland (German: das Saarland) is one of the sixteen federal states (or Bundesländer) of Germany. With its
 * capital at Saarbrücken, it has an area of 2,570 km² and its population (as of 30 April 2012) is approximately
 * 1,012,000. In terms of both area and population size – apart from the city-states of Berlin, Bremen and Hamburg – it
 * is Germany's smallest federal state.
 *
 * @see https://en.wikipedia.org/wiki/Saarland
 */
class Saarland extends Germany
{
    /**
     * Code to identify this Holiday Provider. Typically, this is the ISO3166 code corresponding to the respective
     * country or sub-region.
     */
    public const ID = 'DE-SL';

    /**
     * Initialize holidays for Saarland (Germany).
     *
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    public function initialize(): void
    {
        parent::initialize();

        // Add custom Christian holidays
        $this->addHoliday($this->corpusChristi($this->year, $this->timezone, $this->locale, Holiday::TYPE_OFFICIAL));
        $this->addHoliday($this->allSaintsDay($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->assumptionOfMary($this->year, $this->timezone, $this->locale, Holiday::TYPE_OTHER));
    }
}
