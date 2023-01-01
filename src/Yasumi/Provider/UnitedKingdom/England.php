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

namespace Yasumi\Provider\UnitedKingdom;

use Yasumi\Provider\UnitedKingdom;

/**
 * Provider for all holidays in England (United Kingdom).
 *
 * England is a country that is part of the United Kingdom. It covers an area of 130,279 square kilometres
 * (50,301 sq mi), and has a population of 5,619,400. London, England's capital, is also the capital of
 * and the largest city in the United Kingdom.
 *
 * @see https://en.wikipedia.org/wiki/England
 */
class England extends UnitedKingdom
{
    /**
     * Code to identify this Holiday Provider. Typically, this is the ISO3166 code corresponding to the respective
     * country or sub-region.
     */
    public const ID = 'GB-ENG';
}
