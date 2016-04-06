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
 * Provider for all holidays in Baden-Württemberg (Germany).
 *
 * Baden-Württemberg is a state of Germany located in the southwest, east of the Upper Rhine. It is Germany’s third
 * largest state in terms of size and population, with an area of 36,410 square kilometres (14,060 sq mi) and 10.7
 * million inhabitants. The state capital and largest city is Stuttgart.
 *
 * @link https://en.wikipedia.org/wiki/Baden-W%C3%BCrttemberg
 */
class BadenWurttemberg extends Germany
{
    use ChristianHolidays;

    /**
     * Initialize holidays for Baden-Württemberg (Germany).
     */
    public function initialize()
    {
        parent::initialize();

        // Add holidays
        $this->addHoliday($this->epiphany($this->year, $this->timezone, $this->locale, Holiday::TYPE_OBSERVANCE));
        $this->addHoliday($this->corpusChristi($this->year, $this->timezone, $this->locale, Holiday::TYPE_OBSERVANCE));
        $this->addHoliday($this->allSaintsDay($this->year, $this->timezone, $this->locale, Holiday::TYPE_OBSERVANCE));
    }
}
