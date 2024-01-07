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

namespace Yasumi\Provider\Austria;

use Yasumi\Exception\UnknownLocaleException;
use Yasumi\Provider\Austria;

/**
 * Provider for all holidays in Vorarlberg (Austria).
 *
 * @see https://en.wikipedia.org/wiki/Vorarlberg
 */
class Vorarlberg extends Austria
{
    /**
     * Code to identify this Holiday Provider. Typically, this is the ISO3166 code corresponding to the respective
     * country or sub-region.
     */
    public const ID = 'AT-8';

    /**
     * Initialize holidays for Vorarlberg (Austria).
     *
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    public function initialize(): void
    {
        parent::initialize();

        // Add custom Common holidays.
        $this->addHoliday($this->stJosephsDay($this->year, $this->timezone, $this->locale));
    }
}
