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
 * Provider for all holidays in Mecklenburg-Vorpommern (Germany).
 *
 * Mecklenburg-Vorpommern is a federated state in northern Germany. The capital city is Schwerin. The state was
 * formed through the merger of the historic regions of Mecklenburg and Vorpommern after the Second World War, dissolved
 * in 1952 and recreated at the time of the German reunification in 1990.
 *
 * @link https://en.wikipedia.org/wiki/Mecklenburg-Vorpommern
 */
class MecklenburgVorpommern extends Germany
{
    use ChristianHolidays;

    /**
     * Initialize holidays for Mecklenburg-Vorpommern (Germany).
     */
    public function initialize()
    {
        parent::initialize();

        // Add holidays
        $this->addHoliday($this->corpusChristi($this->year, $this->timezone, $this->locale, Holiday::TYPE_OBSERVANCE));
        $this->addHoliday($this->assumptionOfMary($this->year, $this->timezone, $this->locale, Holiday::TYPE_OBSERVANCE));
        $this->addHoliday($this->allSaintsDay($this->year, $this->timezone, $this->locale, Holiday::TYPE_OBSERVANCE));

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
