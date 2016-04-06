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
 * Provider for all holidays in North Rhine-Westphalia (Germany).
 *
 * North Rhine-Westphalia is the most populous state of Germany, as well as the fourth largest by area. Its capital
 * is Düsseldorf; the biggest city is Cologne. Four of Germany's ten biggest cities—Cologne, Düsseldorf, Dortmund,
 * and Essen—are located within the state, as well as the biggest metropolitan area of the European continent,
 * Rhine-Ruhr, with a population of approximately 18 million.
 *
 * @link https://en.wikipedia.org/wiki/North_Rhine-Westphalia
 */
class NorthRhineWestphalia extends Germany
{
    use ChristianHolidays;

    /**
     * Initialize holidays for North Rhine-Westphalia (Germany).
     */
    public function initialize()
    {
        parent::initialize();

        // Add holidays
        $this->addHoliday($this->corpusChristi($this->year, $this->timezone, $this->locale, Holiday::TYPE_OBSERVANCE));
        $this->addHoliday($this->allSaintsDay($this->year, $this->timezone, $this->locale, Holiday::TYPE_OBSERVANCE));
    }
}
