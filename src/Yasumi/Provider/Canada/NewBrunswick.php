<?php

declare(strict_types=1);
/*
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 - 2023 AzuyaLabs
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
 * Provider for all holidays in New Brunswick (Canada).
 *
 * New Brunswick is a province of Canada.
 *
 * @see https://en.wikipedia.org/wiki/New_Brunswick
 */
class NewBrunswick extends Canada
{
    /**
     * Code to identify this Holiday Provider. Typically, this is the ISO3166 code corresponding to the respective
     * country or sub-region.
     */
    public const ID = 'CA-NB';

    /**
     * Initialize holidays for New Brunswick (Canada).
     *
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    public function initialize(): void
    {
        parent::initialize();

        $this->timezone = 'America/Halifax';

        $this->calculateCivicHoliday();
        $this->calculateFamilyDay();
        $this->calculateVictoriaDay();
    }
}
