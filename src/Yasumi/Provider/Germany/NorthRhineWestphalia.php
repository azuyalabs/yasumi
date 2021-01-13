<?php

declare(strict_types=1);
/*
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 - 2021 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <me@sachatelgenhof.com>
 */

namespace Yasumi\Provider\Germany;

use Yasumi\Exception\InvalidDateException;
use Yasumi\Exception\UnknownLocaleException;
use Yasumi\Holiday;
use Yasumi\Provider\Germany;

/**
 * Provider for all holidays in North Rhine-Westphalia (Germany).
 *
 * North Rhine-Westphalia (German: Nordrhein-Westfalen), commonly shortened NRW) is the most populous state of Germany,
 * with a population of approximately 18 million, and the fourth largest by area. Its capital is Düsseldorf; the biggest
 * city is Cologne. Four of Germany's ten biggest cities—Cologne, Düsseldorf, Dortmund, and Essen—are located within the
 * state, as well as the biggest metropolitan area of the European continent, Rhine-Ruhr.
 *
 * @see https://en.wikipedia.org/wiki/North_Rhine-Westphalia
 */
class NorthRhineWestphalia extends Germany
{
    /**
     * Code to identify this Holiday Provider. Typically this is the ISO3166 code corresponding to the respective
     * country or sub-region.
     */
    public const ID = 'DE-NW';

    /**
     * Initialize holidays for North Rhine-Westphalia (Germany).
     *
     * @throws InvalidDateException
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    public function initialize(): void
    {
        parent::initialize();

        // Add custom Christian holidays
        $this->addHoliday($this->corpusChristi($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->allSaintsDay($this->year, $this->timezone, $this->locale, Holiday::TYPE_OTHER));
    }
}
