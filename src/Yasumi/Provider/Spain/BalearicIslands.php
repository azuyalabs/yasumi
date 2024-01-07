<?php

declare(strict_types=1);
/*
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 - 2024 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <me at sachatelgenhof dot com>
 */

namespace Yasumi\Provider\Spain;

use Yasumi\Exception\UnknownLocaleException;
use Yasumi\Holiday;
use Yasumi\Provider\ChristianHolidays;
use Yasumi\Provider\DateTimeZoneFactory;
use Yasumi\Provider\Spain;

/**
 * Provider for all holidays in the Balearic Islands (Spain).
 *
 * The Balearic Islands are an archipelago of Spain in the western Mediterranean Sea, near the eastern coast of the
 * Iberian Peninsula. The four largest islands are Majorca, Minorca, Ibiza and Formentera. There are many minor islands
 * and islets in close proximity to the larger islands, including Cabrera, Dragonera and S'Espalmador.
 *
 * @see https://en.wikipedia.org/wiki/Balearic_Islands
 */
class BalearicIslands extends Spain
{
    use ChristianHolidays;

    /**
     * Code to identify this Holiday Provider. Typically, this is the ISO3166 code corresponding to the respective
     * country or sub-region.
     */
    public const ID = 'ES-IB';

    /**
     * Initialize holidays for Balearic Islands (Spain).
     *
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    public function initialize(): void
    {
        parent::initialize();

        // Add custom Christian holidays
        $this->addHoliday($this->stJosephsDay($this->year, $this->timezone, $this->locale, Holiday::TYPE_OBSERVANCE));
        $this->addHoliday($this->maundyThursday($this->year, $this->timezone, $this->locale, Holiday::TYPE_OBSERVANCE));
        $this->addHoliday($this->easterMonday($this->year, $this->timezone, $this->locale, Holiday::TYPE_OBSERVANCE));
        $this->addHoliday($this->stStephensDay($this->year, $this->timezone, $this->locale, Holiday::TYPE_OBSERVANCE));

        // Calculate other holidays
        $this->calculateBalearicIslandsDay();
    }

    /**
     * Calculates the Day of Balearic Islands.
     *
     * The Day of the Balearic Islands (Día de les Illes Balears) is a local public holiday on the Balearic Islands,
     * which are part of Spain, on March 1 each year. This date commemorates when the Balearic Islands' Statute of
     * Autonomy came into effect on March 1, 1983.
     *
     * @see https://www.timeanddate.com/holidays/spain/the-balearic-islands-day
     *
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    private function calculateBalearicIslandsDay(): void
    {
        if ($this->year >= 1983) {
            $this->addHoliday(new Holiday(
                'balearicIslandsDay',
                [
                    'ca' => 'Diada de les Illes Balears',
                    'es' => 'Día de les Illes Balears',
                ],
                new \DateTime("{$this->year}-3-1", DateTimeZoneFactory::getDateTimeZone($this->timezone)),
                $this->locale
            ));
        }
    }
}
