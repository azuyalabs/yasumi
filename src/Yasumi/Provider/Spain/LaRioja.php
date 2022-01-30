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
 * Provider for all holidays in La Rioja (Spain).
 *
 * La Rioja is an autonomous community and a province in Spain, located in the north of the Iberian Peninsula. Its
 * capital is Logroño. Other cities and towns in the province include Calahorra, Arnedo, Alfaro, Haro, Santo Domingo de
 * la Calzada, and Nájera. It has an estimated population of 322,415 inhabitants.
 *
 * @see https://en.wikipedia.org/wiki/La_Rioja_(Spain)
 */
class LaRioja extends Spain
{
    use ChristianHolidays;

    /**
     * Code to identify this Holiday Provider. Typically, this is the ISO3166 code corresponding to the respective
     * country or sub-region.
     */
    public const ID = 'ES-RI';

    /**
     * Initialize holidays for La Rioja (Spain).
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
        $this->calculateLaRiojaDay();
    }

    /**
     * Calculates the day of La Rioja.
     *
     * The Day of La Rioja (Día de La Rioja) is an annual public holiday in the Spanish autonomous community of
     * La Rioja, on June 9. It marks the anniversary of when the autonomous community of La Rioja's statute was approved
     * on June 9, 1982. The Day of La Rioja was first observed on June 9, 1983.
     *
     * @see https://www.timeanddate.com/holidays/spain/rioja-day
     *
     * @throws InvalidDateException
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    private function calculateLaRiojaDay(): void
    {
        if ($this->year >= 1983) {
            $this->addHoliday(new Holiday('laRiojaDay', [
                'es' => 'Día de La Rioja',
            ], new DateTime("$this->year-6-9", DateTimeZoneFactory::getDateTimeZone($this->timezone)), $this->locale));
        }
    }
}
