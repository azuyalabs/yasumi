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
 * Provider for all holidays in Rhineland-Palatinate (Germany).
 *
 * Rhineland-Palatinate is one of the 16 states of the Federal Republic of Germany. It has an area of 19,846 square
 * kilometres (7,663 sq mi) and about four million inhabitants. The city of Mainz functions as the state capital.
 *
 * @link https://en.wikipedia.org/wiki/Rhineland-Palatinate
 */
class RhinelandPalatinate extends Germany
{
    use ChristianHolidays;

    /**
     * Initialize holidays for Rhineland-Palatinate (Germany).
     */
    public function initialize()
    {
        parent::initialize();

        // Add holidays
        $this->addHoliday($this->corpusChristi($this->year, $this->timezone, $this->locale, Holiday::TYPE_OBSERVANCE));
        $this->addHoliday($this->allSaintsDay($this->year, $this->timezone, $this->locale, Holiday::TYPE_OBSERVANCE));
    }
}
