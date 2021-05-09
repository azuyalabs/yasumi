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

namespace Yasumi\Provider\Spain;

use Yasumi\Exception\InvalidDateException;
use Yasumi\Exception\UnknownLocaleException;
use Yasumi\Holiday;
use Yasumi\Provider\ChristianHolidays;
use Yasumi\Provider\Spain;

/**
 * Provider for all holidays in Aragon (Spain).
 *
 * Aragon is an autonomous community in Spain, coextensive with the medieval Kingdom of Aragon. Located in northeastern
 * Spain, the Aragonese autonomous community comprises three provinces (from north to south): Huesca, Zaragoza, and
 * Teruel. Its capital is Zaragoza (also called Saragossa in English). The current Statute of Autonomy declares Aragon a
 * nationality of Spain.
 *
 * @see https://en.wikipedia.org/wiki/Aragon
 */
class Aragon extends Spain
{
    use ChristianHolidays;

    /**
     * Code to identify this Holiday Provider. Typically this is the ISO3166 code corresponding to the respective
     * country or sub-region.
     */
    public const ID = 'ES-AR';

    /**
     * Initialize holidays for Aragon (Spain).
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
        $this->addHoliday($this->stGeorgesDay($this->year, $this->timezone, $this->locale, Holiday::TYPE_OBSERVANCE));
    }
}
