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
 * Provider for all holidays in Asturias (Spain).
 *
 * Asturias, officially the Principality of Asturias, is an autonomous community in north-west Spain. It is coextensive
 * with the province of Asturias, and contains most of the territory that was part of the Kingdom of Asturias in the
 * Middle Ages. Divided into eight comarcas (counties), the autonomous community of Asturias is bordered by Cantabria to
 * the east, by Castile and León to the south, by Galicia to the west, and by the Bay of Biscay to the north.
 *
 * @see https://en.wikipedia.org/wiki/Asturias
 */
class Asturias extends Spain
{
    use ChristianHolidays;

    /**
     * Code to identify this Holiday Provider. Typically, this is the ISO3166 code corresponding to the respective
     * country or sub-region.
     */
    public const ID = 'ES-AS';

    /**
     * Initialize holidays for Asturias (Spain).
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

        // Calculate other holidays
        $this->calculateAsturiasDay();
    }

    /**
     * Calculates the Day of Asturias.
     *
     * The Day of Asturias (Día de Asturias) is a public holiday in Asturias in Spain on September 8 each year. It marks
     * the birth of Mary, mother of Jesus. The law declaring September 8 to be the Day of Asturias was enacted on
     * June 28, 1984. This date was chosen as it is the day on which the birth of Mary is traditionally celebrated.
     * The public holiday was first observed on September 8, 1984.
     *
     * @see https://www.timeanddate.com/holidays/spain/asturias-day
     *
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    private function calculateAsturiasDay(): void
    {
        if ($this->year >= 1984) {
            $this->addHoliday(new Holiday(
                'asturiasDay',
                ['es' => 'Día de Asturias'],
                new \DateTime("{$this->year}-9-8", DateTimeZoneFactory::getDateTimeZone($this->timezone)),
                $this->locale
            ));
        }
    }
}
