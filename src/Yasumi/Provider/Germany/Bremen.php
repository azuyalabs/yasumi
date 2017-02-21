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
 * Provider for all holidays in Bremen (Germany).
 *
 * The Free Hanseatic City of Bremen is the smallest of Germany's 16 states. A more informal name, but used in some
 * official contexts, is Land Bremen ('State of Bremen'). The state consists of two enclaves with two cities (Bremen
 * and Bremerhaven) in the North of Germany, surrounded by the larger state of Lower Saxony.
 *
 * @link https://en.wikipedia.org/wiki/Bremen_(state)
 */
class Bremen extends Germany
{
    /**
     * Code to identify this Holiday Provider. Typically this is the ISO3166 code corresponding to the respective
     * country or sub-region.
     */
    const ID = 'DE-HB';
}
