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
use Yasumi\Provider\DateTimeZoneFactory;

/**
 * Provider for all holidays in Yukon (Canada).
 *
 * Manitoba is a territory of Canada.
 *
 * @link https://en.wikipedia.org/wiki/Yukon
 */
class Yukon extends Canada
{
    /**
     * Code to identify this Holiday Provider. Typically this is the ISO3166 code corresponding to the respective
     * country or sub-region.
     */
    public const ID = 'CA-YT';

    /**
     * Initialize holidays for Yukon (Canada).
     *
     * @throws InvalidDateException
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    public function initialize(): void
    {
        parent::initialize();
        
        $this->timezone = 'America/Whitehorse';
        
        $this->calculateDiscoveryDay();
        $this->calculateHeritageDay();
        $this->calculateNationalIndigenousPeoplesDay();
        $this->calculateVictoriaDay();
    }

    /**
     * Discovery Day.
     *
     * @link https://en.wikipedia.org/wiki/Civic_Holiday
     *
     * @throws InvalidDateException
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    protected function calculateDiscoveryDay(): void
    {
        if ($this->year < 1897) {
            return;
        }

        $this->addHoliday(new Holiday(
            'discoveryDay',
            [],
            new DateTime("third monday of august $this->year", DateTimeZoneFactory::getDateTimeZone($this->timezone)),
            $this->locale
        ));
    }

    /**
     * Yukon Heritage Day.
     *
     * @link https://en.wikipedia.org/wiki/Family_Day_(Canada)
     *
     * @throws InvalidDateException
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    protected function calculateHeritageDay(): void
    {
        if ($this->year < 2009) {
            return;
        }

        $this->addHoliday(new Holiday(
            'yukonHeritageDay',
            [],
            new DateTime("first monday of august $this->year", DateTimeZoneFactory::getDateTimeZone($this->timezone)),
            $this->locale
        ));
    }
}
