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

namespace Yasumi\Provider\Canada;

use DateTime;
use Yasumi\Exception\InvalidDateException;
use Yasumi\Exception\UnknownLocaleException;
use Yasumi\Holiday;
use Yasumi\Provider\Canada;
use Yasumi\Provider\DateTimeZoneFactory;

/**
 * Provider for all holidays in Manitoba (Canada).
 *
 * Manitoba is a province of Canada.
 *
 * @see https://en.wikipedia.org/wiki/Manitoba
 */
class Manitoba extends Canada
{
    /**
     * Code to identify this Holiday Provider. Typically this is the ISO3166 code corresponding to the respective
     * country or sub-region.
     */
    public const ID = 'CA-MB';

    /**
     * Initialize holidays for Manitoba (Canada).
     *
     * @throws InvalidDateException
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    public function initialize(): void
    {
        parent::initialize();

        $this->timezone = 'America/Winnipeg';

        $this->calculateCivicHoliday();
        $this->calculateLouisRielDay();
        $this->calculateVictoriaDay();
    }

    /**
     * Civic Holiday.
     *
     * @see https://en.wikipedia.org/wiki/Civic_Holiday
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
            'terryFoxDay',
            [],
            new DateTime("first monday of august $this->year", DateTimeZoneFactory::getDateTimeZone($this->timezone)),
            $this->locale
        ));
    }

    /**
     * Louis Riel Day.
     *
     * @see https://en.wikipedia.org/wiki/Family_Day_(Canada)
     *
     * @throws InvalidDateException
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    protected function calculateLouisRielDay(): void
    {
        if ($this->year < 2008) {
            return;
        }

        $this->addHoliday(new Holiday(
            'louisRielDay',
            [],
            new DateTime("third monday of february $this->year", DateTimeZoneFactory::getDateTimeZone($this->timezone)),
            $this->locale
        ));
    }
}
