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

namespace Yasumi\Provider\France;

use Yasumi\Provider\ChristianHolidays;
use Yasumi\Provider\France;

/**
 * Provider for all holidays in Bas-Rhin (France).
 *
 * Bas-Rhin is a department in the Alsace-Champagne-Ardenne-Lorraine region of France. The name means "Lower Rhine".
 * It is the more populous and densely populated of the two departments of the traditional Alsace region, with 1,109,460
 * inhabitants in 2013. The prefecture and the General Council are based in Strasbourg.
 *
 * @link https://en.wikipedia.org/wiki/Bas-Rhin
 */
class BasRhin extends France
{
    use ChristianHolidays;

    /**
     * Initialize holidays for Bas-Rhin (France).
     */
    public function initialize()
    {
        parent::initialize();

        // Add custom Christian holidays
        $this->addHoliday($this->goodFriday($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->stStephensDay($this->year, $this->timezone, $this->locale));
    }
}
