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
use Yasumi\Provider\Canada;

/**
 * Provider for all holidays in Northwest Territories (Canada).
 *
 * Northwest Territories is a province of Canada.
 *
 * @see https://en.wikipedia.org/wiki/Northwest_Territories
 */
class NorthwestTerritories extends Canada
{
    /**
     * Code to identify this Holiday Provider. Typically, this is the ISO3166 code corresponding to the respective
     * country or sub-region.
     */
    public const ID = 'CA-NT';

    /**
     * Initialize holidays for Northwest Territories (Canada).
     *
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    public function initialize(): void
    {
        parent::initialize();

        $this->timezone = 'America/Yellowknife';

        $this->calculateCivicHoliday();
        $this->calculateNationalIndigenousPeoplesDay();
        $this->calculateVictoriaDay();
    }
}
