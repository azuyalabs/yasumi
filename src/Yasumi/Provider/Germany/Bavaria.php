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

namespace Yasumi\Provider\Germany;

use Yasumi\Holiday;
use Yasumi\Provider\Germany;

/**
 * Provider for all holidays in Bavaria (Germany).
 *
 * Bavaria is a federal state of Germany. In the southeast of the country with an area of 70,548 square kilometres
 * (27,200 sq mi), it is the largest state, making up almost a fifth of the total land area of Germany, and, with 12.6
 * million inhabitants, Germany's second most populous state. Munich, Bavaria's capital and largest city, is the third
 * largest city in Germany.
 *
 * @link https://en.wikipedia.org/wiki/Bavaria
 */
class Bavaria extends Germany
{
    /**
     * Code to identify this Holiday Provider. Typically this is the ISO3166 code corresponding to the respective
     * country or sub-region.
     */
    const ID = 'DE-BY';

    /**
     * Initialize holidays for Bavaria (Germany).
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
        $this->addHoliday($this->epiphany($this->year, $this->timezone, $this->locale, Holiday::TYPE_OTHER));
        $this->addHoliday($this->corpusChristi($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->allSaintsDay($this->year, $this->timezone, $this->locale, Holiday::TYPE_OTHER));
    }
}
