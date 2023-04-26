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

namespace Yasumi\tests;

/**
 * This interface class defines the standard functions that any holiday provider PHPUnit test case needs to define.
 */
interface ProviderTestCase
{
    /**
     * Tests whether the expected number of sources are actually defined.
     */
    public function testSources(): void;
}
