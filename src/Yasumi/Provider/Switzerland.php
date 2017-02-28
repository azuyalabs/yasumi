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

namespace Yasumi\Provider;

use DateInterval;
use DateTime;
use DateTimeZone;
use Yasumi\Holiday;

/**
 * Provider for all holidays in Switzerland.
 */
class Switzerland extends AbstractProvider
{
    use CommonHolidays, ChristianHolidays;

    /**
     * Code to identify this Holiday Provider. Typically this is the ISO3166 code corresponding to the respective
     * country or sub-region.
     */
    const ID = 'CH';

    /**
     * Initialize holidays for Switzerland.
     */
    public function initialize()
    {
        $this->timezone = 'Europe/Zurich';

        $this->calculateNationalDay();
    }

    /**
     * Swiss National Day.
     *
     * The Swiss National Day is set on 1 August. It has been an official national holiday
     * since 1994 only, although the day had been used for the celebration of the foundation
     * of the Swiss Confederacy for the first time in 1891, and than repeated annually since 1899.
     *
     * @link https://en.wikipedia.org/wiki/Swiss_National_Day
     */
    public function calculateNationalDay()
    {
        $translations = [
            'en_US' => 'National Day',
            'fr_FR' => 'Jour de la fête nationale',
            'fr_CH' => 'Jour de la fête nationale',
            'de_DE' => 'Bundesfeiertag',
            'de_CH' => 'Bundesfeiertag',
            'it_IT' => 'Giorno festivo federale',
            'it_CH' => 'Giorno festivo federale',
            'rm_CH' => 'Fiasta naziunala',
        ];
        if ($this->year >= 1994) {
            $this->addHoliday(new Holiday('swissNationalDay', $translations, new DateTime($this->year.'-08-01', new DateTimeZone($this->timezone)), $this->locale, Holiday::TYPE_NATIONAL));
        } elseif ($this->year >= 1899 || $this->year == 1891) {
            $this->addHoliday(new Holiday('swissNationalDay', $translations, new DateTime($this->year.'-08-01', new DateTimeZone($this->timezone)), $this->locale, Holiday::TYPE_OBSERVANCE));
        }
    }

    /**
     * Berchtoldstag
     *
     * Berchtoldstag is an Alemannic holiday, known in Switzerland and Liechtenstein. It is near
     * New Year's Day, during the Rauhnächte, in Switzerland nearly always on 2 January,
     * with the status of a public holiday in a number of cantons
     *
     * @link https://en.wikipedia.org/wiki/Berchtoldstag
     */
    public function calculateBerchtoldsTag()
    {
        $this->addHoliday(new Holiday('berchtoldsTag', [
            'de_DE' => 'Berchtoldstag',
            'de_CH' => 'Berchtoldstag',
            'fr_FR' => 'Jour de la Saint-Berthold',
            'fr_CH' => 'Jour de la Saint-Berthold',
            'en_US' => 'Berchtoldstag',
        ], new DateTime($this->year.'-01-02', new DateTimeZone($this->timezone)), $this->locale, Holiday::TYPE_OTHER));
    }

    /**
     * Federal Day of Thanksgiving, Repentance and Prayer
     *
     * The Federal Day of Thanksgiving, Repentance and Prayer is a public holiday in Switzerland.
     * It is an interfaith feast observed by Roman Catholic dioceses, the Old Catholic Church,
     * the Jewish congregations and the Reformed church bodies as well as other Christian denominations.
     * The subsequent Monday (Lundi du Jeûne) is a public holiday in the canton of Vaud and Neuchâtel.
     *
     * @link https://en.wikipedia.org/wiki/Federal_Day_of_Thanksgiving,_Repentance_and_Prayer
     */
    public function calculateBettagsMontag()
    {
        if ($this->year >= 1832) {
            // Find third Sunday of September
            $date = new DateTime('Third Sunday of '.$this->year.'-09', new DateTimeZone($this->timezone));
            // Go to next Thursday
            $date->add(new DateInterval('P1D'));

            $this->addHoliday(new Holiday('bettagsMontag', [
                'fr_FR' => 'Jeûne fédéral',
                'fr_CH' => 'Jeûne fédéral',
                'de_DE' => 'Eidgenössischer Dank-, Buss- und Bettag',
                'de_CH' => 'Eidgenössischer Dank-, Buss- und Bettag',
                'it_IT' => 'Festa federale di ringraziamento, pentimento e preghiera',
                'it_CH' => 'Festa federale di ringraziamento, pentimento e preghiera',
            ], $date, $this->locale, Holiday::TYPE_OTHER));
        }
    }
}
