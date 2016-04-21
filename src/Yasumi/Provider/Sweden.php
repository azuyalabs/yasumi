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

namespace Yasumi\Provider;

use DateTime;
use DateTimeZone;
use Yasumi\Holiday;

/**
 * Provider for all holidays in Sweden.
 */
class Sweden extends AbstractProvider
{
    use CommonHolidays, ChristianHolidays;

    /**
     * Initialize holidays for Sweden.
     */
    public function initialize()
    {
        $this->timezone = 'Europe/Stockholm';

        // Add common holidays
        $this->addHoliday($this->newYearsDay($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->internationalWorkersDay($this->year, $this->timezone, $this->locale));

        // Add common Christian holidays (common in Sweden)
        $this->addHoliday($this->epiphany($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->goodFriday($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->easter($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->easterMonday($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->ascensionDay($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->pentecost($this->year, $this->timezone, $this->locale));
        $this->calculatestJohnsDay(); // aka Midsummer's Day
        $this->addHoliday($this->allSaintsDay($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->christmasEve($this->year, $this->timezone, $this->locale, Holiday::TYPE_NATIONAL));
        $this->addHoliday($this->christmasDay($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->secondChristmasDay($this->year, $this->timezone, $this->locale));

        // Calculate other holidays
        $this->calculateNationalDay();
    }

    /**
     * St. John's Day / Midsummer.
     *
     * Midsummer, also known as St John's Day, is the period of time centred upon the summer solstice, and more
     * specifically the Northern European celebrations that accompany the actual solstice or take place on a day
     * between June 19 and June 25 and the preceding evening. The exact dates vary between different cultures.
     * The Christian Church designated June 24 as the feast day of the early Christian martyr St John the Baptist, and
     * the observance of St John's Day begins the evening before, known as St John's Eve.
     *
     * In Sweden the holiday has always been on a Saturday (between June 20 and June 26). Many of the celebrations of
     * midsummer take place on midsummer eve, when many workplaces are closed and shops must close their doors at noon.
     *
     * @link https://en.wikipedia.org/wiki/Midsummer#Sweden
     */
    public function calculatestJohnsDay()
    {
        $translation = ['sv_SE' => 'midsommardagen'];
        $shortName = 'stJohnsDay';
        $date = new DateTime("$this->year-6-24", new DateTimeZone($this->timezone)); // Default date

        // Check between the 20th and 26th day which one is a Saturday
        for ($d = 20; $d <= 26; ++$d) {
            $date->setDate($this->year, 6, $d);
            if ($date->format('l') === 'Saturday') {
                break;
            }
        }

        $this->addHoliday(new Holiday($shortName, $translation, $date, $this->locale));
    }

    /*
     * National Day
     *
     * National Day of Sweden (Sveriges nationaldag) is a national holiday observed in Sweden on 6 June every year.
     * Prior to 1983, the day was celebrated as Svenska flaggans dag (Swedish flag day). At that time, the day was
     * renamed to the national day by the Riksdag. The tradition of celebrating this date began 1916 at the Stockholm
     * Olympic Stadium, in honour of the election of King Gustav Vasa in 1523, as this was considered the foundation of
     * modern Sweden.
     */
    public function calculateNationalDay()
    {
        // Prior to 1983, the day was celebrated as Svenska flaggans dag
        if ($this->year >= 1916 and $this->year < 1983) {
            $this->addHoliday(new Holiday('nationalDay', ['sv_SE' => 'Svenska flaggans dag'],
                new DateTime("$this->year-6-6", new DateTimeZone($this->timezone)), $this->locale));
        }

        // Since 1983 this day was named 'Sveriges nationaldag'
        if ($this->year >= 1983) {
            $this->addHoliday(new Holiday('nationalDay', ['sv_SE' => 'Sveriges nationaldag'],
                new DateTime("$this->year-6-6", new DateTimeZone($this->timezone)), $this->locale));
        }
    }
}
