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
 * Provider for all holidays in France.
 */
class France extends AbstractProvider
{
    use CommonHolidays, ChristianHolidays;

    /**
     * Initialize holidays for France.
     */
    public function initialize()
    {
        $this->timezone = 'Europe/Paris';

        // Add common holidays
        $this->addHoliday($this->newYearsDay($this->year, $this->timezone, $this->locale));

        if ($this->year >= 1945) {
            $this->addHoliday($this->victoryInEuropeDay($this->year, $this->timezone, $this->locale));
        }

        // Add Christian holidays
        $this->addHoliday($this->easterMonday($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->internationalWorkersDay($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->ascensionDay($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->pentecostMonday($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->assumptionOfMary($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->allSaintsDay($this->year, $this->timezone, $this->locale));

        if ($this->year >= 1919) {
            $this->addHoliday($this->armisticeDay($this->year, $this->timezone, $this->locale));
        }

        $this->addHoliday($this->christmasDay($this->year, $this->timezone, $this->locale));

        // Calculate other holidays
        $this->calculateBastilleDay();
    }

    /*
     * French National Day.
     *
     * The French National Day commemorates the beginning of the French Revolution with the Storming of the Bastille
     * on 14 July 1789,as well as the Fête de la Fédération which celebrated the unity of the French people on 14
     * July 1790. Celebrations are held throughout France. The oldest and largest regular military parade in Europe
     * is held on the morning of 14 July, on the Champs-Élysées in Paris in front of the President of the Republic,
     * French officials and foreign guests.
     *
     * @link http://en.wikipedia.org/wiki/Bastille_Day
     */
    public function calculateBastilleDay()
    {
        if ($this->year >= 1790) {
            $this->addHoliday(new Holiday('bastilleDay', [
                'en_US' => 'Bastille Day',
                'fr_FR' => 'La Fête nationale',
            ], new DateTime("$this->year-7-14", new DateTimeZone($this->timezone)), $this->locale));
        }
    }
}
