<?php
/**
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 - 2017 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <stelgenhof@gmail.com>
 */

namespace Yasumi\Provider\Germany;

use Yasumi\Provider\Germany;

/**
 * Provider for all holidays in Schleswig-Holstein (Germany).
 *
 * Schleswig-Holstein is the northernmost of the 16 states of Germany, comprising most of the historical duchy of
 * Holstein and the southern part of the former Duchy of Schleswig. Its capital city is Kiel; other notable cities are
 * Lübeck and Flensburg.
 *
 * @link https://en.wikipedia.org/wiki/Schleswig-Holstein
 */
class SchleswigHolstein extends Germany
{
    /**
     * Code to identify this Holiday Provider. Typically this is the ISO3166 code corresponding to the respective
     * country or sub-region.
     */
    const ID = 'DE-SH';
}
