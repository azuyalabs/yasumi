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

use DateTime;
use Yasumi\Holiday;

/**
 * Provider for all holidays in Czech republic.
 *
 * Class CzechRepublic
 * @package Yasumi\Provider
 * @author  Dennis Fridrich <fridrich.dennis@gmail.com>
 */
class CzechRepublic extends AbstractProvider
{
    use CommonHolidays, ChristianHolidays;

    /**
     * Code to identify this Holiday Provider. Typically this is the ISO3166 code corresponding to the respective
     * country or sub-region.
     */
    const ID = 'CZ';

    /**
     * Initialize holidays for the Czech Republic.
     *
     * @throws \InvalidArgumentException
     * @throws \Yasumi\Exception\UnknownLocaleException
     */
    public function initialize()
    {
        $this->timezone = 'Europe/Prague';

        $this->addHoliday($this->newYearsDay($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->goodFriday($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->easterMonday($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->internationalWorkersDay($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->victoryInEuropeDay($this->year, $this->timezone, $this->locale));
        $this->calculateSaintsCyrilAndMethodiusDay();
        $this->calculateJanHusDay();
        $this->calculateCzechStatehoodDay();
        $this->calculateIndependentCzechoslovakStateDay();
        $this->calculateStruggleForFreedomAndDemocracyDay();
        $this->addHoliday($this->christmasEve($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->christmasDay($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->secondChristmasDay($this->year, $this->timezone, $this->locale));
    }

    /**
     * Saints Cyril and Methodius Day
     *
     * Saints Cyril and Methodius were two Byzantine Christian theologians and Christian missionaries who were brothers.
     * Through their work they influenced the cultural development of all Slavs, for which they received the title
     * "Apostles to the Slavs". They are credited with devising the Glagolitic alphabet, the first alphabet used
     * to transcribe Old Church Slavonic.
     *
     * After their deaths, their pupils continued their missionary work among other Slavs. Both brothers are venerated
     * in the Orthodox Church as saints with the title of "equal-to-apostles". In 1880, Pope Leo XIII introduced their
     * feast into the calendar of the Roman Catholic Church. In 1980, Pope John Paul II declared them co-patron saints
     * of Europe, together with Benedict of Nursia.
     *
     * @see https://en.wikipedia.org/wiki/Saints_Cyril_and_Methodius
     * @see https://en.wikipedia.org/wiki/Public_holidays_in_the_Czech_Republic
     *
     * @throws \InvalidArgumentException
     * @throws \Yasumi\Exception\UnknownLocaleException
     */
    public function calculateSaintsCyrilAndMethodiusDay()
    {
        $this->addHoliday(new Holiday('saintsCyrilAndMethodiusDay',
            ['cs_CZ' => 'Den slovanských věrozvěstů Cyrila a Metoděje', 'en_US' => 'Saints Cyril and Methodius Day'],
            new DateTime($this->year . '-07-5', new \DateTimeZone($this->timezone)), $this->locale));
    }

    /**
     * Jan Hus Day
     *
     * Jan Hus, often referred to in English as John Hus or John Huss, was a Czech priest, philosopher, early Christian
     * reformer and Master at Charles University in Prague. After John Wycliffe, the theorist of ecclesiastical
     * Reformation, Hus is considered the first Church reformer, as he lived before Luther, Calvin and Zwingli.
     *
     * @see https://en.wikipedia.org/wiki/Jan_Hus
     * @see https://en.wikipedia.org/wiki/Public_holidays_in_the_Czech_Republic
     *
     * @throws \InvalidArgumentException
     * @throws \Yasumi\Exception\UnknownLocaleException
     */
    public function calculateJanHusDay()
    {
        $this->addHoliday(new Holiday('janHusDay',
            ['cs_CZ' => 'Den upálení mistra Jana Husa', 'en_US' => 'Jan Hus Day'],
            new DateTime($this->year . '-07-6', new \DateTimeZone($this->timezone)), $this->locale));
    }

    /**
     * St. Wenceslas Day (Czech Statehood Day)
     *
     * Wenceslaus I, Wenceslas I, or Vaclav the Good was the duke of Bohemia from 921 until his assassination in 935,
     * in a plot by his brother, Boleslav the Cruel.
     *
     * His martyrdom, and the popularity of several biographies, quickly gave rise to a reputation for heroic goodness,
     * resulting in his being elevated to sainthood, posthumously declared king, and seen as the patron saint
     * of the Czech state. He is the subject of "Good King Wenceslas", a Saint Stephen's Day carol.
     *
     * @see https://en.wikipedia.org/wiki/Wenceslaus_I,_Duke_of_Bohemia
     * @see https://en.wikipedia.org/wiki/Public_holidays_in_the_Czech_Republic
     *
     * @throws \InvalidArgumentException
     * @throws \Yasumi\Exception\UnknownLocaleException
     */
    public function calculateCzechStatehoodDay()
    {
        $this->addHoliday(new Holiday('czechStateHoodDay',
            ['cs_CZ' => 'Den české státnosti', 'en_US' => 'St. Wenceslas Day (Czech Statehood Day)'],
            new DateTime($this->year . '-09-28', new \DateTimeZone($this->timezone)), $this->locale));
    }

    /**
     * Independent Czechoslovak State Day
     *
     * @see https://en.wikipedia.org/wiki/Public_holidays_in_the_Czech_Republic
     *
     * @throws \InvalidArgumentException
     * @throws \Yasumi\Exception\UnknownLocaleException
     */
    public function calculateIndependentCzechoslovakStateDay()
    {
        $this->addHoliday(new Holiday('independentCzechoslovakStateDay', [
            'cs_CZ' => 'Den vzniku samostatného československého státu',
            'en_US' => 'Independent Czechoslovak State Day'
        ], new DateTime($this->year . '-10-28', new \DateTimeZone($this->timezone)), $this->locale));
    }

    /**
     * Struggle for Freedom and Democracy Day
     *
     * @see https://en.wikipedia.org/wiki/Public_holidays_in_the_Czech_Republic
     *
     * @throws \InvalidArgumentException
     * @throws \Yasumi\Exception\UnknownLocaleException
     */
    public function calculateStruggleForFreedomAndDemocracyDay()
    {
        $this->addHoliday(new Holiday('struggleForFreedomAndDemocracyDay',
            ['cs_CZ' => 'Den boje za svobodu a demokracii', 'en_US' => 'Struggle for Freedom and Democracy Day'],
            new DateTime($this->year . '-11-17', new \DateTimeZone($this->timezone)), $this->locale));
    }
}
