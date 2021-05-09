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

use Yasumi\Exception\InvalidDateException;
use Yasumi\Exception\UnknownLocaleException;
use Yasumi\Provider\Canada;

/**
 * Provider for all holidays in British Columbia (Canada).
 *
 * British Columbia is a province of Canada.
 *
 * @see https://en.wikipedia.org/wiki/British_Columbia
 */
class BritishColumbia extends Canada
{
    /**
     * Code to identify this Holiday Provider. Typically this is the ISO3166 code corresponding to the respective
     * country or sub-region.
     */
    public const ID = 'CA-BC';

    /**
     * Initialize holidays for British Columbia (Canada).
     *
     * @throws InvalidDateException
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    public function initialize(): void
    {
        parent::initialize();

        $this->timezone = 'America/Vancouver';

        $this->calculateCivicHoliday();
        $this->calculateFamilyDay();
        $this->calculateVictoriaDay();
    }
}
