<?php

declare(strict_types = 1);

/**
 * This file is part of the 'Yasumi' package.
 *
 * The easy PHP Library for calculating holidays.
 *
 * Copyright (c) 2015 - 2025 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <me at sachatelgenhof dot com>
 */

namespace Yasumi\Provider\UnitedKingdom;

use Yasumi\Holiday;
use Yasumi\Provider\UnitedKingdom;

/**
 * Provider for all holidays in Wales (United Kingdom).
 *
 * Wales is a country that is part of the United Kingdom. It covers an area of 20,779 square kilometres
 * (8,023 sq mi), and has a population of 3,125,000. Cardiff, Wales's capital and largest city, is the
 * eleventh largest city in the United Kingdom.
 *
 * @see https://en.wikipedia.org/wiki/Wales
 */
class Wales extends UnitedKingdom
{
    /**
     * Code to identify this Holiday Provider. Typically, this is the ISO3166 code corresponding to the respective
     * country or sub-region.
     */
    public const ID = 'GB-WLS';

    /**
     * Initialize holidays for Wales (United Kingdom).
     */
    public function initialize(): void
    {
        parent::initialize();

        $this->addHoliday($this->easterMonday($this->year, $this->timezone, $this->locale, Holiday::TYPE_BANK));
    }

    public function getSources(): array
    {
        return [
            'https://en.wikipedia.org/wiki/Holidays_in_Wales',
        ];
    }
}
