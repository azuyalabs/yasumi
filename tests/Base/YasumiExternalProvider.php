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

namespace Yasumi\tests\Base;

use Yasumi\Provider\AbstractProvider;

class YasumiExternalProvider extends AbstractProvider
{
    public function initialize(): void
    {
        // We don't actually have to do anything here.
    }

    public function getSources(): array
    {
        return [];
    }
}
