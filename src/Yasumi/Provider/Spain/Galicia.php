<?php

declare(strict_types=1);
/*
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 - 2021 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <me@sachatelgenhof.com>
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
 * Provider for all holidays in Galicia (Spain).
 *
 * Galicia is an autonomous community in northwest Spain, with the official status of a historic nationality.
 * It comprises the provinces of A Coruña, Lugo, Ourense and Pontevedra, being bordered by Portugal to the south, the
 * Spanish autonomous communities of Castile and León and Asturias to the east, and the Atlantic Ocean to the west and
 * the north.
 *
 * @see https://en.wikipedia.org/wiki/Galicia_(Spain)
 */
class Galicia extends Spain
{
    use ChristianHolidays;

    /**
     * Code to identify this Holiday Provider. Typically this is the ISO3166 code corresponding to the respective
     * country or sub-region.
     */
    public const ID = 'ES-GA';

    /**
     * Initialize holidays for Galicia (Spain).
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
        $this->addHoliday($this->stJosephsDay($this->year, $this->timezone, $this->locale, Holiday::TYPE_OBSERVANCE));
        $this->addHoliday($this->maundyThursday($this->year, $this->timezone, $this->locale, Holiday::TYPE_OBSERVANCE));

        // Calculate other holidays
        $this->calculateGalicianLiteratureDay();
        $this->calculateStJamesDay();
    }

    /**
     * Calculates the Galician Literature Day.
     *
     * Galician Literature Day is a public holiday observed in Galicia, Spain. It is a celebration of the Galician
     * language and its literature which was inaugurated by the Royal Galician Academy in 1963. This celebration has
     * taken place on May 17 each year since 1963. In the year 1991 Galician Literature Day was declared a public
     * holiday in all Galicia.
     *
     * @see https://en.wikipedia.org/wiki/Galician_Literature_Day
     *
     * @throws InvalidDateException
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    private function calculateGalicianLiteratureDay(): void
    {
        if ($this->year >= 1991) {
            $this->addHoliday(new Holiday('galicianLiteratureDay', [
                'es' => 'Día de las Letras Gallegas',
                'gl' => 'Día das Letras Galegas',
            ], new DateTime("$this->year-5-17", DateTimeZoneFactory::getDateTimeZone($this->timezone)), $this->locale));
        }
    }

    /**
     * Calculates the day of St. James.
     *
     * Many people in Spain celebrate the life and deeds of James, son of Zebedee, on Saint James' Day
     * (Santiago Apostol), which is on July 25. Saint James was one of Jesus' first disciples. Some Christians believe
     * that his remains are buried in Santiago de Compostela in Spain.
     *
     * Regional or local authorities may move the public holiday to a different date, particularly if July 25 falls on a
     * Sunday. If July 25 falls on a Tuesday or Thursday, many businesses and organizations are also closed on Monday,
     * July 24, or Friday, July 26. In the rest of Spain, July 25 is not a public holiday.
     *
     * @see https://www.timeanddate.com/holidays/spain/santiago-apostle
     *
     * @throws InvalidDateException
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    private function calculateStJamesDay(): void
    {
        if ($this->year >= 2000) {
            $this->addHoliday(new Holiday('stJamesDay', [
                'es' => 'Santiago Apostol',
            ], new DateTime("$this->year-7-25", DateTimeZoneFactory::getDateTimeZone($this->timezone)), $this->locale));
        }
    }
}
