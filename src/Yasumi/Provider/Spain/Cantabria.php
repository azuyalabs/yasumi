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
 * Provider for all holidays in Cantabria (Spain).
 *
 * Cantabria is a Spanish historical community and autonomous community with Santander as its capital city. It is
 * bordered on the east by the Basque Autonomous Community (province of Biscay), on the south by Castile and León
 * (provinces of León, Palencia and Burgos), on the west by the Principality of Asturias, and on the north by the
 * Cantabrian Sea (Bay of Biscay).
 *
 * @see https://en.wikipedia.org/wiki/Cantabria
 */
class Cantabria extends Spain
{
    use ChristianHolidays;

    /**
     * Code to identify this Holiday Provider. Typically, this is the ISO3166 code corresponding to the respective
     * country or sub-region.
     */
    public const ID = 'ES-CB';

    /**
     * Initialize holidays for Cantabria (Spain).
     *
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    public function initialize(): void
    {
        parent::initialize();

        // Add custom Christian holidays
        $this->addHoliday($this->maundyThursday($this->year, $this->timezone, $this->locale, Holiday::TYPE_OBSERVANCE));

        // Calculate other holidays
        $this->calculateCantabriaDay();
    }

    /**
     * Calculates the Cantabria Day.
     *
     * The Day of Cantabria (Día de Cantabria) celebrates the history, culture and language of the Cantabrian region of
     * Spain. It is on the second Sunday of August, but is not a public holiday.
     *
     * The mayor of Cabezón de la Sal originally proposed that the Day of Mountains (Día de La Montaña) should celebrate
     * the culture and history of Cantabria on the second Sunday in August. Following from this proposal, the day was
     * first celebrated in 1967. The Day of Mountains was declared an event of "National Tourist Interest" in 1971 and
     * "Special Regional Interest" in 1983. Following the establishment of the autonomous community of Cantabria in
     * 1982, the event became known as the Day of Cantabria.
     *
     * @see https://www.timeanddate.com/holidays/spain/cantabria-day
     *
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    private function calculateCantabriaDay(): void
    {
        if ($this->year >= 1967) {
            $this->addHoliday(new Holiday(
                'cantabriaDay',
                ['es' => 'Día de Cantabria'],
                new \DateTime("second sunday of august {$this->year}", DateTimeZoneFactory::getDateTimeZone($this->timezone)),
                $this->locale
            ));
        }
    }
}
