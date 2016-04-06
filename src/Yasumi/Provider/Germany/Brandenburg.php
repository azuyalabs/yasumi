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
use \DateTime;
use \DateTimeZone;

/**
 * Provider for all holidays in Brandenburg (Germany).
 *
 * Brandenburg is one of the sixteen federated states of Germany. It lies in the northeast of the country covering an
 * area of 29,478 square kilometers and has 2.45 million inhabitants. The capital and largest city is Potsdam.
 * Brandenburg surrounds but does not include the national capital and city-state Berlin forming a metropolitan area.
 *
 * Originating in the medieval Northern March, the Margraviate of Brandenburg grew to become the core of the Kingdom
 * of Prussia, which would later become the Free State of Prussia. Brandenburg is one of the federal states that was
 * re-created in 1990 upon the reunification of the former East Germany and West Germany.
 *
 * @link https://en.wikipedia.org/wiki/Brandenburg
 */
class Brandenburg extends Germany
{
    use ChristianHolidays;

    /**
     * Initialize holidays for Brandenburg (Germany).
     */
    public function initialize()
    {
        parent::initialize();

        // Add holidays
        $this->addHoliday($this->easter($this->year, $this->timezone, $this->locale, Holiday::TYPE_OBSERVANCE));
        $this->addHoliday($this->pentecost($this->year, $this->timezone, $this->locale, Holiday::TYPE_OBSERVANCE));

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
