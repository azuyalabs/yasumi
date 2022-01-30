<?php

declare(strict_types=1);

/*
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 - 2022 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <me at sachatelgenhof dot com>
 */

namespace Yasumi\Provider\Spain;

use DateTime;
use Yasumi\Exception\InvalidDateException;
use Yasumi\Exception\UnknownLocaleException;
use Yasumi\Holiday;
use Yasumi\Provider\ChristianHolidays;
use Yasumi\Provider\DateTimeZoneFactory;
use Yasumi\Provider\Spain;

/**
 * Provider for all holidays in Castile and León (Spain).
 *
 * Castile and León is an autonomous community in north-western Spain. It was constituted in 1983, although it existed
 * for the first time during the First Spanish Republic in the 19th century (León and the Kingdom of León appeared in
 * 910 of the Kingdom of Castile appears in 1230 and again in 1230. It is the largest autonomous community in Spain and
 * the third largest region of the European Union
 *
 * @see https://en.wikipedia.org/wiki/Castile_and_León
 */
class CastileAndLeon extends Spain
{
    use ChristianHolidays;

    /**
     * Code to identify this Holiday Provider. Typically, this is the ISO3166 code corresponding to the respective
     * country or sub-region.
     */
    public const ID = 'ES-CL';

    /**
     * Initialize holidays for Castile and León (Spain).
     *
     * @throws InvalidDateException
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
        $this->calculateCastileAndLeonDay();
    }

    /**
     * Calculates Castile and León Day.
     *
     * Castile and León Day is a holiday celebrated on April 23 in the autonomous community of Castile and León, a
     * subdivision of Spain. The date is the anniversary of the Battle of Villalar, in which Castilian rebels called
     * Comuneros were dealt a crushing defeat by the royalist forces of King Charles I in the Revolt of the Comuneros on
     * April 23, 1521.
     *
     * @see https://en.wikipedia.org/wiki/Castile_and_León_Day
     *
     * @throws InvalidDateException
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    private function calculateCastileAndLeonDay(): void
    {
        if ($this->year >= 1976) {
            $this->addHoliday(new Holiday(
                'castileAndLeonDay',
                ['es' => 'Día de Castilla y León'],
                new DateTime("$this->year-4-23", DateTimeZoneFactory::getDateTimeZone($this->timezone)),
                $this->locale
            ));
        }
    }
}
