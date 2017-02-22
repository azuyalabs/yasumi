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
use DateTimeZone;
use Yasumi\Holiday;

/**
 * Provider for all holidays in Denmark.
 */
class Denmark extends AbstractProvider
{
    use CommonHolidays, ChristianHolidays;

    /**
     * Code to identify this Holiday Provider. Typically this is the ISO3166 code corresponding to the respective
     * country or sub-region.
     */
    const ID = 'DK';

    /**
     * Initialize holidays for Denmark.
     *
     * @throws \InvalidArgumentException
     * @throws \Yasumi\Exception\UnknownLocaleException
     */
    public function initialize()
    {
        $this->timezone = 'Europe/Copenhagen';

        // Add common holidays
        $this->addHoliday($this->newYearsDay($this->year, $this->timezone, $this->locale));

        // Add common Christian holidays (common in Denmark)
        $this->addHoliday($this->maundyThursday($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->goodFriday($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->easter($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->easterMonday($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->ascensionDay($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->pentecost($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->pentecostMonday($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->christmasDay($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->secondChristmasDay($this->year, $this->timezone, $this->locale));

        // Calculate other holidays
        $this->calculateGreatPrayerDay();
    }

    /**
     * Great Prayer Day
     *
     * Store Bededag, translated literally as Great Prayer Day or more loosely as General Prayer Day, "All Prayers" Day,
     * Great Day of Prayers or Common Prayer Day, is a Danish holiday celebrated on the 4th Friday after Easter. It is a
     * collection of minor Christian holy days consolidated into one day. The day was introduced in the Church of
     * Denmark in 1686 by King Christian V as a consolidation of several minor (or local) Roman Catholic holidays which
     * the Church observed that had survived the Reformation.
     *
     * @link https://en.wikipedia.org/wiki/Store_Bededag
     *
     * @throws \InvalidArgumentException
     * @throws \Yasumi\Exception\UnknownLocaleException
     */
    public function calculateGreatPrayerDay()
    {
        $easter = $this->calculateEaster($this->year, $this->timezone)->format('Y-m-d');

        if ($this->year >= 1686) {
            $this->addHoliday(new Holiday('greatPrayerDay', ['da_DK' => 'Store Bededag'],
                new DateTime("fourth friday $easter", new DateTimeZone($this->timezone)), $this->locale));
        }
    }
}
