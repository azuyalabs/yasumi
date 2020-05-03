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
use Yasumi\Provider\Canada;

/**
 * Provider for all holidays in Ontario (Canada).
 *
 * Ontario is a province of Canada.
 *
 * @link https://en.wikipedia.org/wiki/Ontario
 */
class Ontario extends Canada
{
    /**
     * Code to identify this Holiday Provider. Typically this is the ISO3166 code corresponding to the respective
     * country or sub-region.
     */
    public const ID = 'CA-ON';

    /**
     * Initialize holidays for Ontario (Canada).
     *
     * @throws InvalidDateException
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    public function initialize(): void
    {
        parent::initialize();
        
        $this->timezone = 'America/Toronto';
        
        $this->calculateCivicHoliday();
        $this->calculateFamilyDay();
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

    /**
     * Family Day.
     *
     * @link https://en.wikipedia.org/wiki/Family_Day_(Canada)
     *
     * @throws InvalidDateException
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    protected function calculateFamilyDay(): void
    {
        if ($this->year < 2009) {
            return;
        }

        $this->addHoliday(new Holiday(
            'familyDay',
            ['en' => 'Family Day'],
            new DateTime("third monday of february $this->year", new \DateTimeZone($this->timezone)),
            $this->locale
        ));
    }
}
