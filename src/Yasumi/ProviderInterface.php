<?php
/**
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 - 2018 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <stelgenhof@gmail.com>
 */

namespace Yasumi;

/**
 * Interface ProviderInterface - Holiday provider interface.
 *
 * This interface class defines the standard functions that any country provider needs to define.
 *
 * @see     AbstractProvider
 */
interface ProviderInterface
{
    /**
     * Initialize country holidays.
     */
    public function initialize();
}
