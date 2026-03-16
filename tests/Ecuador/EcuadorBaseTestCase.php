<?php

declare(strict_types = 1);

/**
 * This file is part of the 'Yasumi' package.
 *
 * The easy PHP Library for calculating holidays.
 *
 * Copyright (c) 2015 - 2026 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <me at sachatelgenhof dot com>
 */

namespace Yasumi\tests\Ecuador;

use PHPUnit\Framework\TestCase;
use Yasumi\tests\YasumiBase;

abstract class EcuadorBaseTestCase extends TestCase
{
    use YasumiBase;

    public const REGION = 'Ecuador';
    public const TIMEZONE = 'America/Guayaquil';
    public const LOCALE = 'es';
}
