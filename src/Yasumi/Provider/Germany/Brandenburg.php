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

namespace Yasumi\Provider\Germany;

use Yasumi\Provider\Germany;

/**
 * Provider for all holidays in Brandenburg (Germany).
 *
 * Brandenburg is one of the sixteen federated states of Germany. It lies in the northeast of the country covering an
 * area of 29,478 square kilometers and has 2.45 million inhabitants. The capital and largest city is Potsdam.
 * Brandenburg surrounds but does not include the national capital and city-state Berlin forming a metropolitan area.
 *
 * @link https://en.wikipedia.org/wiki/Brandenburg
 */
class Brandenburg extends Germany
{
    /**
     * Code to identify this Holiday Provider. Typically this is the ISO3166 code corresponding to the respective
     * country or sub-region.
     */
    const ID = 'DE-BB';

    /**
     * Initialize holidays for Brandenburg (Germany).
     */
    public function initialize()
    {
        parent::initialize();

        // Add custom Christian holidays
        $this->calculateReformationDay();
    }

    /**
     * For the German state of Brandenburg, Reformation Day was celebrated since 1517.
     * Note: In 2017 all German states will celebrate Reformation Day for its 500th anniversary.
     */
    private function calculateReformationDay()
    {
        if ($this->year < 1517) {
            return;
        }

        $this->addHoliday($this->reformationDay($this->year, $this->timezone, $this->locale));
    }
}
