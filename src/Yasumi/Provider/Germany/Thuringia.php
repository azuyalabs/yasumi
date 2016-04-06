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
use Yasumi\Provider\Germany;
use \DateTime;
use \DateTimeZone;

/**
 * Provider for all holidays in Thuringia (Germany).
 *
 * The Free State of Thuringia is a federal state of Germany, located in the central part of the country.
 * It has an area of 16,171 square kilometres (6,244 sq mi) and 2.29 million inhabitants, making it the sixth smallest
 * by area and the fifth smallest by population of Germany's sixteen states. Most of Thuringia is within the watershed
 * of the Saale, a left tributary of the Elbe. Its capital is Erfurt.
 *
 * @link https://en.wikipedia.org/wiki/Thuringia
 */
class Thuringia extends Germany
{
    /**
     * Initialize holidays for Thuringia (Germany).
     */
    public function initialize()
    {
        parent::initialize();

        // Calculate other holidays
        $this->calculateReformationDay();
    }

    /**
     * Calculates the day of the reformation.
     *
     * Reformation Day is a religious holiday celebrated on October 31, alongside All Hallows' Eve, in remembrance
     * of the Reformation. It is celebrated among various Protestants, especially by Lutheran and Reformed church
     * communities.

     * It is a civic holiday in the German states of Brandenburg, Mecklenburg-Vorpommern, Saxony, Saxony-Anhalt and
     * Thuringia. Slovenia celebrates it as well due to the profound contribution of the Reformation to that nation's
     * cultural development, although Slovenes are mainly Roman Catholics. With the increasing influence of
     * Protestantism in Latin America (particularly newer groups such as various Evangelical Protestants, Pentecostals
     * or Charismatics), it has been declared a national holiday in Chile in 2009.
     *
     * @link https://en.wikipedia.org/wiki/Reformation_Day
     */
    public function calculateReformationDay()
    {
        $this->addHoliday(new Holiday('reformationDay', [
            'de_DE' => 'Reformationstag',
        ], new DateTime("$this->year-10-31", new DateTimeZone($this->timezone)), $this->locale));
    }
}
