<?php declare(strict_types=1);
/**
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 - 2020 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <me@sachatelgenhof.com>
 */

namespace Yasumi\Provider\Canada;

use DateTime;
use Yasumi\Exception\InvalidDateException;
use Yasumi\Exception\UnknownLocaleException;
use Yasumi\Holiday;
use Yasumi\Provider\DateTimeZoneFactory;
use Yasumi\Provider\Canada;
use Yasumi\SubstituteHoliday;

/**
 * Provider for all holidays in Nunavut (Canada).
 *
 * Nunavut is a territory of Canada.
 *
 * @link https://en.wikipedia.org/wiki/Nunavut
 */
class Nunavut extends Canada
{
    /**
     * Code to identify this Holiday Provider. Typically this is the ISO3166 code corresponding to the respective
     * country or sub-region.
     */
    public const ID = 'CA-NU';

    /**
     * Initialize holidays for Nunavut (Canada).
     *
     * @throws InvalidDateException
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    public function initialize(): void
    {
        parent::initialize();
        
        $this->calculateCivicHoliday();
        $this->calculateVictoriaDay();
    }

    /**
     * Victoria Day.
     *
     * @link https://en.wikipedia.org/wiki/Victoria_Day
     *
     * @throws InvalidDateException
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    private function calculateVictoriaDay(): void
    {
        if ($this->year < 1845) {
            return;
        }

        $this->addHoliday(new Holiday(
            'victoriaDay',
            ['en' => 'Victoria Day', 'fr' => 'Fête de la Reine'],
            new DateTime("last monday front of $this->year-05-25", new \DateTimeZone($this->timezone)),
            $this->locale
        ));
    }

    /**
     * Civic Holiday.
     *
     * @link https://en.wikipedia.org/wiki/Civic_Holiday
     *
     * @throws InvalidDateException
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    protected function calculateCivicHoliday(): void
    {
        if ($this->year < 1879) {
            return;
        }

        $this->addHoliday(new Holiday(
            'civicHoliday',
            ['en' => 'Civic Holiday', 'fr' => 'Premier lundi d\'août'],
            new DateTime("first monday of august $this->year", new \DateTimeZone($this->timezone)),
            $this->locale
        ));
    }
}
