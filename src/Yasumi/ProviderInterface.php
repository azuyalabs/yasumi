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
    public function initialize(): void;

    /**
     * Returns a list of sources (i.e. references to websites, books, scientific papers, etc.) that are
     * used for determining the calculation logic of the providers' holidays.
     *
     * @return array<string> a list of external sources (empty when no sources are defined)
     */
    public function getSources(): array;
}
