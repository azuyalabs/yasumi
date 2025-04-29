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

namespace Yasumi\tests\Bulgaria;

use PHPUnit\Framework\TestCase;
use Yasumi\tests\YasumiBase;

abstract class BulgariaBaseTestCase extends TestCase
{
    use YasumiBase;

    public const REGION = 'Bulgaria';

    public const TIMEZONE = 'Europe/Sofia';

    public const LOCALE = 'bg_BG';
}
