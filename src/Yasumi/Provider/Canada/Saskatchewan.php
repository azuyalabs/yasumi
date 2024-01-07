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

namespace Yasumi\Provider\Canada;

use Yasumi\Exception\UnknownLocaleException;
use Yasumi\Holiday;
use Yasumi\Provider\Canada;
use Yasumi\Provider\DateTimeZoneFactory;

/**
 * Provider for all holidays in Saskatchewan (Canada).
 *
 * Saskatchewan is a province of Canada.
 *
 * @see https://en.wikipedia.org/wiki/Saskatchewan
 */
class Saskatchewan extends Canada
{
    /**
     * Code to identify this Holiday Provider. Typically, this is the ISO3166 code corresponding to the respective
     * country or sub-region.
     */
    public const ID = 'CA-SK';

    /**
     * Initialize holidays for Saskatchewan (Canada).
     *
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    public function initialize(): void
    {
        parent::initialize();

        $this->timezone = 'America/Regina';

        $this->calculateSaskatchewanDay();
        $this->calculateFamilyDay();
        $this->calculateVictoriaDay();
    }

    /**
     * Civic Holiday.
     *
     * @see https://en.wikipedia.org/wiki/Civic_Holiday
     *
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    private function calculateSaskatchewanDay(): void
    {
        if ($this->year < 1879) {
            return;
        }

        $this->addHoliday(new Holiday(
            'saskatchewanDay',
            [],
            new \DateTime("first monday of august {$this->year}", DateTimeZoneFactory::getDateTimeZone($this->timezone)),
            $this->locale
        ));
    }
}
