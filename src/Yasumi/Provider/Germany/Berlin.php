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
 * Provider for all holidays in Berlin (Germany).
 *
 * Berlin is the capital of Germany and one of its 16 states. With a population of approximately 3.5 million people,
 * Berlin is the second most populous city proper and the seventh most populous urban area in the European Union.
 * Located in northeastern Germany on the banks of Rivers Spree and Havel, it is the centre of the Berlin-Brandenburg
 * Metropolitan Region, which has about six million residents from over 180 nations.
 *
 * @link https://en.wikipedia.org/wiki/Berlin
 */
class Berlin extends Germany
{
    /**
     * Code to identify this Holiday Provider. Typically this is the ISO3166 code corresponding to the respective
     * country or sub-region.
     */
    const ID = 'DE-BE';
}
