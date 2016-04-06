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
 * Provider for all holidays in Saxony (Germany).
 *
 * The Free State of Saxony is a landlocked federal state of Germany, bordering the federal states of Brandenburg,
 * Saxony Anhalt, Thuringia, and Bavaria, as well as the countries of Poland and the Czech Republic. Its capital is
 * Dresden, and its largest city is Leipzig.
 *
 * @link https://en.wikipedia.org/wiki/Saxony
 */
class Saxony extends Germany
{
    /**
     * Initialize holidays for Saxony (Germany).
     */
    public function initialize()
    {
        parent::initialize();

        // Calculate other holidays
        $this->calculateDayofPrayerandRepentance();
    }

    /**
     * Calculates the Day of Prayer and Repentance.
     *
     * Der Buß- und Bettag in Deutschland ist ein Feiertag der evangelischen Kirche, der auf Notzeiten zurückgeht.
     * Im Lauf der Geschichte wurden Buß- und Bettage immer wieder aus aktuellem Anlass angesetzt. Angesichts von
     * Notständen und Gefahren wurde die ganze Bevölkerung zu Umkehr und Gebet aufgerufen. Seit Ende des
     * 19. Jahrhunderts wird ein allgemeiner Buß- und Bettag am Mittwoch vor dem Ewigkeitssonntag, dem letzten Sonntag
     * des Kirchenjahres, begangen, also elf Tage vor dem ersten Adventssonntag bzw. am Mittwoch vor dem 23. November.
     *
     * @link https://de.wikipedia.org/wiki/Bu%C3%9F-_und_Bettag
     */
    public function calculateDayofPrayerandRepentance()
    {
        $this->addHoliday(new Holiday('dayofPrayerandRepentance', [
            'de_DE' => 'Buß- und Bettag',
        ], new DateTime("last wednesday $this->year-11-23", new DateTimeZone($this->timezone)), $this->locale));
    }
}
