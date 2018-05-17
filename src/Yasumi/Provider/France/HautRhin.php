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

namespace Yasumi\Provider\France;

use Yasumi\Provider\ChristianHolidays;
use Yasumi\Provider\France;

/**
 * Provider for all holidays in Haut-Rhin (France).
 *
 * Haut-Rhin is a department in the Alsace-Champagne-Ardenne-Lorraine region of France, named after the Rhine river.
 * Its name means Upper Rhine. Haut-Rhin is the smaller and less populated of the two departments of the traditional
 * Alsace region, although it is still densely populated compared to the rest of France.
 *
 * @link https://en.wikipedia.org/wiki/Haut-Rhin
 */
class HautRhin extends France
{
    use ChristianHolidays;

    /**
     * Code to identify this Holiday Provider. Typically this is the ISO3166 code corresponding to the respective
     * country or sub-region.
     */
    const ID = 'FR-68';

    /**
     * Initialize holidays for Haut-Rhin (France).
     *
     * @throws \Yasumi\Exception\InvalidDateException
     * @throws \InvalidArgumentException
     * @throws \Yasumi\Exception\UnknownLocaleException
     * @throws \Exception
     */
    public function initialize()
    {
        parent::initialize();

        // Add custom Christian holidays
        $this->addHoliday($this->goodFriday($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->stStephensDay($this->year, $this->timezone, $this->locale));
    }
}
